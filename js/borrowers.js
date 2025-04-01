$(document).ready(function () {
    var swiper;

    function loadLendingTermsData() {
        Promise.all([
            $.ajax({
            url: 'functions/load-borrowers-lending-terms-card.php',
            type: 'GET',
            cache: false
        }),])
        .then(function (response) {
            if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                console.error('Unexpected HTML response (possible redirect).');
                return;
            }
            $('#lenderCardContainer').html(response);

			if (!swiper) {
                swiper = new Swiper('#lenderSlide .slide-content', {
                    slidesPerView: 1,
                    spaceBetween: 25,
                    slidesPerGroup: 1,
                    centerSlide: 'true',
                    fade: 'true',
                    grabCursor: 'true',
                    loopFillGroupWithBlank: false,
                    pagination: {
                        el: '#lenderSlide .swiper-pagination',
                        clickable: true,
                        dynamicBullets: true,
                    },
                    navigation: {
                        nextEl: '#lenderSlide .swiper-button-next',
                        prevEl: '#lenderSlide .swiper-button-prev',
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 1,
                        },
                        520: {
                            slidesPerView: 1,
                        },
                        950: {
                            slidesPerView: 1,
                        },
                    },
                });
            } else {
                swiper.update();
            }
        })
        .catch(function () {
            $('#lenderCardContainer').html('<p class="empty" id="loading"><span class="animated-dots">Loading Lending terms<span class="dots"></span></span></p>');
        });
    }

    loadLendingTermsData();
    setInterval(loadLendingTermsData, 90000);
});

function showLenderForm() {
	localStorage.setItem('activeBorrowersTab', 'lenderFormButton');
	document.getElementById('lenderFormButton').classList.add('active');
	document.getElementById('userLenderForm').classList.add('active');
	document.getElementById('applicationManagerButton').classList.remove('active');
	document.getElementById('userApplicationManager').classList.remove('active');
}

function showApplicationManager() {
	localStorage.setItem('activeBorrowersTab', 'applicationManagerButton');
	document.getElementById('lenderFormButton').classList.remove('active');
	document.getElementById('userLenderForm').classList.remove('active');
	document.getElementById('applicationManagerButton').classList.add('active');
	document.getElementById('userApplicationManager').classList.add('active');
}

document.addEventListener('DOMContentLoaded', function() {
    var activeTab = localStorage.getItem('activeBorrowersTab');
    if (activeTab === 'lenderFormButton') {
        showLenderForm();
    } else if (activeTab === 'applicationManagerButton') {
        showApplicationManager();
    }
})

function showApplyCard(id) {
	document.getElementById('overlayBg').classList.add('active');
	document.getElementById('applyCard' + id).classList.add('active');
}

function hideApplyCard(id) {
	document.getElementById('overlayBg').classList.remove('active');
	document.getElementById('applyCard' + id).classList.remove('active');
}

$(document).ready(function () {
    function loadBorrowersApplicationCard() {
		
        let activeapplicationCardIds = [];
        $('.application-card.active').each(function () {
            activeapplicationCardIds.push($(this).attr('id'));
        });

        const fileInputsState = {};
        const errorMessagesState = {};
        const emptyMessagesState = {};

        $('.file').each(function () {
            const cardId = $(this).attr('id')?.split('-')[1];
            if (cardId) {
                fileInputsState[cardId] = this.files.length ? this.files[0] : null;
            }
        });

        $('.collateral-error').each(function () {
            const cardId = $(this).attr('id')?.split('-')[1];
            if (cardId) {
                errorMessagesState[cardId] = $(this).html();
            }
        });

        $('.apply-empty-error').each(function () {
            const cardId = $(this).attr('id')?.split('-')[1];
            if (cardId) {
                emptyMessagesState[cardId] = $(this).html();
            }
        });

        $.ajax({
            url: 'functions/load-borrowers-application-card.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#applicationCardContainer').html(response);

                activeapplicationCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });

                for (const cardId in fileInputsState) {
                    if (fileInputsState[cardId]) {
                        const fileInput = document.getElementById(`collateral-${cardId}`);
                        if (fileInput) {
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(fileInputsState[cardId]);
                            fileInput.files = dataTransfer.files;
                        }
                    }
                }

                for (const cardId in errorMessagesState) {
                    const errorElement = document.getElementById(`collateral-error-${cardId}`);
                    if (errorElement) {
                        errorElement.innerHTML = errorMessagesState[cardId];
                    }
                }

                for (const cardId in emptyMessagesState) {
                    const errorElement = document.getElementById(`apply-empty-error-${cardId}`);
                    if (errorElement) {
                        errorElement.innerHTML = emptyMessagesState[cardId];
                    }
                }

                initializeEventListeners();
				
            },
            error: function () {
                $('#applicationCardContainer').html('<p class="error-message"></p>');
            }
        });
    }

    function initializeEventListeners() {
        $('.file').off('input').on('input', function () {
            const cardId = $(this).attr('id')?.split('-')[1];
            if (cardId) {
                validateApplyFormDynamically(cardId);
            }
        });

        $('.application-card form').off('submit').on('submit', function (e) {
            const form = $(this);
            const cardId = form.find('.file').attr('id')?.split('-')[1];
            if (cardId) {
                const isFormValid = validateApplyFormDynamically(cardId);
                if (!isFormValid) {
                    e.preventDefault();
                }
            }
        });
    }

    loadBorrowersApplicationCard();

    setInterval(loadBorrowersApplicationCard, 90000);
});

function showLendingInfo(id) {
	document.getElementById('overlayBg').classList.add('active');
	document.getElementById('lendingInfo').classList.add('active');
}

function hideLendingInfo(id) {
	document.getElementById('overlayBg').classList.remove('active');
	document.getElementById('lendingInfo').classList.remove('active');
}

$(document).ready(function () {
	
    function loadLendingInfo() {
		
		let activeLendingInfoCardIds = [];
        $('.lending-info.active').each(function () {
            activeLendingInfoCardIds.push($(this).attr('id'));
        });
		
        $.ajax({
            url: 'functions/load-borrowers-lending-info.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#lendingInfoContainer').html(response);
				
				 activeLendingInfoCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				
            },
            error: function () {
                $('#lendingInfoContainer').html('<p class="error-message"></p>');
            }
        });
    }

    loadLendingInfo();

    setInterval(loadLendingInfo, 30000);
});

function validateCollateral(cardId) {
    const fileInput = document.getElementById(`collateral-${cardId}`);
    const error = document.getElementById(`collateral-error-${cardId}`);
    const allowedFormats = ["image/jpeg", "image/png", "image/gif"];
    const maxSize = 2 * 1024 * 1024;

    if (!fileInput || fileInput.files.length === 0) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please insert a collateral to upload!</p>";
        error.style.display = 'block';
        return false;
    }

    const file = fileInput.files[0];

    if (!allowedFormats.includes(file.type)) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Invalid file format! Only JPG, PNG, and GIF are allowed.</p>";
        error.style.display = 'block';
        return false;
    }

    if (file.size > maxSize) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please insert a collateral image below 2MB!</p>";
        error.style.display = 'block';
        return false;
    }

    error.style.display = 'none';
    return true;
}

function validateApplyFormDynamically(cardId) {
    const error = document.getElementById(`apply-empty-error-${cardId}`);
    let isValid = true;

    const fileInput = document.getElementById(`collateral-${cardId}`);
    if (fileInput && fileInput.files.length === 0) {
        isValid = false;
    }

    const isCollateralValid = validateCollateral(cardId);

    if (!isValid) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are empty fields, please fill in all fields!</p>";
        error.style.display = 'block';
    } else if (!isCollateralValid) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are incorrect fields, please adjust them properly.</p>";
        error.style.display = 'block';
        isValid = false;
    } else {
        error.innerHTML = "";
        error.style.display = 'none';
    }

    return isValid && isCollateralValid;
}

document.addEventListener("DOMContentLoaded", () => {
    const forms = document.querySelectorAll('.application-card form');

    forms.forEach((form) => {
        const cardId = form.querySelector('.file').id.split('-')[1];
        const fileInput = document.getElementById(`collateral-${cardId}`);
        const submitButton = form.querySelector('button[type="submit"]');

        fileInput.addEventListener('input', () => validateApplyFormDynamically(cardId));

        form.addEventListener('submit', (e) => {
            const isFormValid = validateApplyFormDynamically(cardId);
            if (!isFormValid) {
                e.preventDefault();
            }
        });
    });
});

$(document).ready(function () {
    function loadApplicationHistory() {
        $.ajax({
            url: 'functions/load-borrowers-application-history.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#applicationManagerHistory').html(response);
            },
            error: function () {
                $('#applicationManagerHistory').html('<p class="empty"></p>');
            }
        });
    }

    loadApplicationHistory();

    setInterval(loadApplicationHistory, 30000);
});

$(document).ready(function () {
    function loadApplicationManagerNotification() {
        $.ajax({
            url: 'functions/load-borrowers-notification.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#applicationManagerNotification').html(response);
            },
            error: function () {
                $('#applicationManagerNotification').html('<p class="error-message"></p>');
            }
        });
    }

    loadApplicationManagerNotification();

    setInterval(loadApplicationManagerNotification, 30000);
});

function showLenderCard(id) {
	document.getElementById('overlayBg').classList.add('active');
	document.getElementById('lendingTermsApplicationsCard' + id).classList.add('active');
}

function hideLenderCard(id) {
	document.getElementById('overlayBg').classList.remove('active');
	document.getElementById('lendingTermsApplicationsCard' + id).classList.remove('active');
}

function showLenderCard(id) {
	document.getElementById('overlayBg').classList.add('active');
	document.getElementById('lendingTermsApplicationsCard' + id).classList.add('active');
}

function hideLenderCard(id) {
	document.getElementById('overlayBg').classList.remove('active');
	document.getElementById('lendingTermsApplicationsCard' + id).classList.remove('active');
}

function showCredit(id) {
	document.getElementById('lendingApplicationCardBg' + id).classList.add('active');
	document.getElementById('lendingApplicationCard' + id).classList.add('active');
}

function hideCredit(id) {
	document.getElementById('lendingApplicationCardBg' + id).classList.remove('active');
	document.getElementById('lendingApplicationCard' + id).classList.remove('active');
}

function showCollateral(id) {
	document.getElementById('overlayLendingCollateral' + id).classList.add('active');
	document.getElementById('lendingCollateralPicture' + id).classList.add('active');
}

function hideCollateral(id) {
	document.getElementById('overlayLendingCollateral' + id).classList.remove('active');
	document.getElementById('lendingCollateralPicture' + id).classList.remove('active');
}

function showUpdatedAt(id) {
	document.getElementById('updatedAtBg' + id).classList.add('active');
	document.getElementById('updatedAt' + id).classList.add('active');
	document.getElementById('hideUpdatedAt' + id).classList.add('active');
}

function hideUpdatedAt(id) {
	document.getElementById('updatedAtBg' + id).classList.remove('active');
	document.getElementById('updatedAt' + id).classList.remove('active');
	document.getElementById('hideUpdatedAt' + id).classList.remove('active');
}

function showCancel(id) {
	document.getElementById('lendingApplicationCardBg' + id).classList.add('active');
	document.getElementById('approveCard' + id).classList.add('active');
}

function hideCancel(id) {
	document.getElementById('lendingApplicationCardBg' + id).classList.remove('active');
	document.getElementById('approveCard' + id).classList.remove('active');
}

function showAgreementCard(id) {
	document.getElementById('overlayAgreement' + id).classList.add('active');
	document.getElementById('agreementCard' + id).classList.add('active');
}

function hideAgreementCard(id) {
	document.getElementById('overlayAgreement' + id).classList.remove('active');
	document.getElementById('agreementCard' + id).classList.remove('active');
}


$(document).ready(function () {
	
	function saveScrollPositions() {
		$('.lending-credit-history-content').each(function () {
			var contentId = $(this).attr('id');
			var scrollPosition = $(this).scrollTop();
			localStorage.setItem(contentId, scrollPosition);
		});
	}

	function restoreScrollPositions() {
		$('.lending-credit-history-content').each(function () {
			var contentId = $(this).attr('id');
			var savedPosition = localStorage.getItem(contentId);
			if (savedPosition !== null) {
			$(this).scrollTop(savedPosition);
			}
		});
	}
	
    function loadLendingTermsApplicationCard() {
		
		saveScrollPositions();
		
		let activeLendingTermsApplicationsCardIds = [];
        $('.lending-card.active').each(function () {
            activeLendingTermsApplicationsCardIds.push($(this).attr('id'));
        });
		
		let activeLendingApplicationsCardIds = [];
        $('.lending-application-card.active').each(function () {
            activeLendingApplicationsCardIds.push($(this).attr('id'));
        });
		
		let activeOverlayConfirmCardIds = [];
        $('.lendingapplicationcardoverlay.active').each(function () {
            activeOverlayConfirmCardIds.push($(this).attr('id'));
        });
		
		let activeConfirmCardIds = [];
        $('.confirmation-card.active').each(function () {
            activeConfirmCardIds.push($(this).attr('id'));
        });
		
		let activeOverlayAgreeementCardIds = [];
        $('.overlayagreement.active').each(function () {
            activeOverlayAgreeementCardIds.push($(this).attr('id'));
        });
		
		let activeAgreementCardIds = [];
        $('.agreement-card.active').each(function () {
            activeAgreementCardIds.push($(this).attr('id'));
        });
		
        $.ajax({
            url: 'functions/load-borrowers-lending-terms-applications-card.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#lendingTermsApplicationCardContainer').html(response);
				
				restoreScrollPositions();
				
				 activeLendingTermsApplicationsCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeLendingApplicationsCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeOverlayConfirmCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeConfirmCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeOverlayAgreeementCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeAgreementCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
            },
            error: function () {
                $('#lendingTermsApplicationCardContainer').html('<p class="error-message"></p>');
            }
        });
    }

    loadLendingTermsApplicationCard();

    setInterval(loadLendingTermsApplicationCard, 30000);
	
	$(window).on('beforeunload', saveScrollPositions);
});