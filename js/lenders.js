function calculateMonthlyPayment() {
    var lendAmount = parseFloat(document.querySelector('input[name="lend-amount"]:checked')?.value || 0);
	
	var interestRate = parseFloat(document.querySelector('input[name="interest-amount"]:checked')?.value.replace('% Monthly', '') || 0);
	
	var paymentTerm = parseFloat(document.querySelector('input[name="term-amount"]:checked')?.value.replace(' Months', '').replace(' Month', '') || 0);

	 if (lendAmount > 0 && interestRate > 0 && paymentTerm > 0) {
        var interestRatePerMonth = lendAmount * (interestRate / 100);
        var monthlyPayment = (lendAmount / paymentTerm) + interestRatePerMonth;
		
        document.getElementById('monthly').value = formatCurrency(monthlyPayment.toFixed(2));
    } else {
        document.getElementById('monthly').value = '';
    }
}

function formatCurrency(amount) {
    return amount.replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

var swiper = new Swiper("#paymentLendSlide .slide-content", {
	slidesPerView: 1,
	spaceBetween: 25,
	slidesPerGroup: 1,
	centerSlide: 'true',
	fade: 'true',
	grabCursor: 'true',
	loopFillGroupWithBlank: true,
		pagination: {
			el: "#paymentLendSlide .swiper-pagination",
			clickable: true,
			dynamicBullets: true,
		},
		navigation: {
			nextEl: "#paymentLendSlide .swiper-button-next",
			prevEl: "#paymentLendSlide .swiper-button-prev",
		},
		
		breakpoints: {
			0: {
				slidesPerView: 3,
			},
			520: {
				slidesPerView: 3,
			},
			950: {
				slidesPerView: 3,
			},
		},
		
});

var swiper = new Swiper("#paymentTermSlide .slide-content", {
	slidesPerView: 1,
	spaceBetween: 25,
	slidesPerGroup: 1,
	centerSlide: 'true',
	fade: 'true',
	grabCursor: 'true',
	loopFillGroupWithBlank: true,
		pagination: {
			el: "#paymentTermSlide .swiper-pagination",
			clickable: true,
			dynamicBullets: true,
		},
		navigation: {
			nextEl: "#paymentTermSlide .swiper-button-next",
			prevEl: "#paymentTermSlide .swiper-button-prev",
		},
		
		breakpoints: {
			0: {
				slidesPerView: 3,
			},
			520: {
				slidesPerView: 3,
			},
			950: {
				slidesPerView: 3,
			},
		},
});

function showLendForm() {
	localStorage.setItem('activeLendersTab', 'lendFormButton');
	document.getElementById('lendFormButton').classList.add('active');
	document.getElementById('userLendForm').classList.add('active');
	document.getElementById('lendManagerButton').classList.remove('active');
	document.getElementById('userLendManager').classList.remove('active');
}

function showLendManager() {
	localStorage.setItem('activeLendersTab', 'lendManagerButton');
	document.getElementById('lendFormButton').classList.remove('active');
	document.getElementById('userLendForm').classList.remove('active');
	document.getElementById('lendManagerButton').classList.add('active');
	document.getElementById('userLendManager').classList.add('active');
}

document.addEventListener('DOMContentLoaded', function() {
    var activeTab = localStorage.getItem('activeLendersTab');
    if (activeTab === 'lendFormButton') {
        showLendForm();
    } else if (activeTab === 'lendManagerButton') {
        showLendManager();
    }
})

function toggleFirstTerm(show) {
    const firstTermSection = document.querySelectorAll('.first-term');
    const secondTermSection = document.querySelectorAll('.second-term');

    if (show) {
        secondTermSection.forEach(card => {
            card.classList.remove('active');
            const input = card.querySelector('input');
            input.disabled = true;
            input.checked = false;
        });
        firstTermSection.forEach(card => {
            card.classList.add('active');
            card.querySelector('input').disabled = false;
        });
    }
	
}

function toggleSecondTerm(show) {
    const firstTermSection = document.querySelectorAll('.first-term');
    const secondTermSection = document.querySelectorAll('.second-term');

    if (show) {
        firstTermSection.forEach(card => {
            card.classList.remove('active');
            const input = card.querySelector('input');
            input.disabled = true;
            input.checked = false;
        });
        secondTermSection.forEach(card => {
            card.classList.add('active');
            card.querySelector('input').disabled = false;
        });
    }

}

function validateLendButtons() {
	const lendRadios = document.getElementsByName('lend-amount');
	const lendError = document.getElementById('lend-amount-error');
	
	let isLendValid = false;
	
	for (let radio of lendRadios) {
        if (radio.checked) {
            isLendValid = true;
            break;
        }
    }
	
	if (!isLendValid) {
        lendError.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please choose an Amount.</p>";
        lendError.style.display = 'block';
    } else {
        lendError.style.display = 'none';
    }

	return isLendValid;
}

function validateInterestButtons() {
	const interestRadios = document.getElementsByName('interest-amount');
	const interestError = document.getElementById('interest-amount-error');
	
	let isInterestValid = false;
	
	for (let radio of interestRadios) {
        if (radio.checked) {
            isInterestValid = true;
            break;
        }
    }
	
	if (!isInterestValid) {
        interestError.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please choose an Interest Rate.</p>";
        interestError.style.display = 'block';
    } else {
        interestError.style.display = 'none';
    }

	return isInterestValid;
}

function validateCollateralButtons() {
	const collateralRadios = document.getElementsByName('collateral-amount');
	const collateralError = document.getElementById('collateral-amount-error');
	
	let isCollateralValid = false;
	
	for (let radio of collateralRadios) {
        if (radio.checked) {
            isCollateralValid = true;
            break;
        }
    }
	
	if (!isCollateralValid) {
        collateralError.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please choose a Collateral.</p>";
        collateralError.style.display = 'block';
    } else {
        collateralError.style.display = 'none';
    }

	return isCollateralValid;
}

function validateTermButtons() {
	const termRadios = document.getElementsByName('term-amount');
	const termError = document.getElementById('term-amount-error');
	
	let isTermValid = false;
	
	for (let radio of termRadios) {
        if (radio.checked) {
            isTermValid = true;
            break;
        }
    }
	
	if (!isTermValid) {
        termError.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please choose a Payment Term.</p>";
        termError.style.display = 'block';
    } else {
        termError.style.display = 'none';
    }

	return isTermValid;
}


function validateLendFormDynamically() {
    const requiredFields = ['lend-amount', 'interest-amount', 'collateral-amount', 'term-amount'];
    const error = document.getElementById('empty-amount-error');
    let isValid = true;
	
	requiredFields.forEach((fieldName) => {
        const field = document.getElementsByName(fieldName);
        let isFieldValid = false;
	
	for (let radio of field) {
            if (radio.checked) {
                isFieldValid = true;
                break;
            }
        }

        if (!isFieldValid) {
            isValid = false;
        }
    });

	const isLendButtonsValid = validateLendButtons();
	const isInterestButtonsValid = validateInterestButtons();
	const isCollateralButtonsValid = validateCollateralButtons();
	const isTermButtonsValid = validateTermButtons();

    if (!isValid) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are empty fields, please fill in all fields!</p>";
        error.style.display = 'block';
    } else {
        error.style.display = 'none';
    }

    return isValid && isLendButtonsValid && isCollateralButtonsValid && isInterestButtonsValid && isTermButtonsValid;
}

document.addEventListener("DOMContentLoaded", () => {
    const formFields = document.querySelectorAll('#user-lend-form input');
    const form = document.getElementById('user-lend-form');

    formFields.forEach((field) => {
        field.addEventListener('input', validateLendFormDynamically);
    });

	form.addEventListener('submit', (e) => {
        const isFormValid = validateLendFormDynamically();
        if (!isFormValid) {
            e.preventDefault();
        }
    });
});

function showLend() {
	document.getElementById('overlayLend').classList.add('active');
	document.getElementById('lending-terms').classList.add('active');
}

function hideLend() {
	document.getElementById('overlayLend').classList.remove('active');
	document.getElementById('lending-terms').classList.remove('active');
}

$(document).ready(function () {
    var lendingswiper;
	
	function saveScrollPositions() {
		$('.applicants-content').each(function () {
			var contentId = $(this).attr('id');
			var scrollPosition = $(this).scrollTop();
			localStorage.setItem(contentId, scrollPosition);
		});
	}

	function restoreScrollPositions() {
		$('.applicants-content').each(function () {
			var contentId = $(this).attr('id');
			var savedPosition = localStorage.getItem(contentId);
			if (savedPosition !== null) {
			$(this).scrollTop(savedPosition);
			}
		});
	}

    function loadLendingTermsData() {
		
		saveScrollPositions();

        Promise.all([$.ajax({
            url: 'functions/load-lenders-lending-terms-card.php',
            type: 'GET',
            cache: false
        })])
        .then(function (response) {
            if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                console.error('Unexpected HTML response (possible redirect).');
                return;
            }
            $('#lendingTermsCardContainer').html(response);
			
			 restoreScrollPositions();

            if (!lendingswiper) {
                lendingswiper = new Swiper('#lendingSlide .slide-content', {
                    slidesPerView: 1,
                    spaceBetween: 25,
                    slidesPerGroup: 1,
                    centerSlide: 'true',
                    fade: 'true',
                    grabCursor: 'true',
                    loopFillGroupWithBlank: false,
                    pagination: {
                        el: '#lendingSlide .swiper-pagination',
                        clickable: true,
                        dynamicBullets: true,
                    },
                    navigation: {
                        nextEl: '#lendingSlide .swiper-button-next',
                        prevEl: '#lendingSlide .swiper-button-prev',
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
                lendingswiper.update();
            }
        })
        .catch(function () {
            $('#lendingTermsCardContainer').html('<p class="empty" id="loading"><span class="animated-dots">Loading Lending terms<span class="dots"></span></span></p>');
        });
    }

    loadLendingTermsData();
    setInterval(loadLendingTermsData, 30000);
	
	$(window).on('beforeunload', saveScrollPositions);
});

function showApplicationCard(id) {
	document.getElementById('overlayBg').classList.add('active');
	document.getElementById('applicationCard' + id).classList.add('active');
}

function hideApplicationCard(id) {
	document.getElementById('overlayBg').classList.remove('active');
	document.getElementById('applicationCard' + id).classList.remove('active');
}

function showCollateral(id) {
	document.getElementById('overlayCollateral' + id).classList.add('active');
	document.getElementById('collateralPicture' + id).classList.add('active');
}

function hideCollateral(id) {
	document.getElementById('overlayCollateral' + id).classList.remove('active');
	document.getElementById('collateralPicture' + id).classList.remove('active');
}

function showRejectCard(id) {
	document.getElementById('overlayCollateral' + id).classList.add('active');
	document.getElementById('rejectCard' + id).classList.add('active');
}

function hideRejectCard(id) {
	document.getElementById('overlayCollateral' + id).classList.remove('active');
	document.getElementById('rejectCard' + id).classList.remove('active');
}

function showApproveCard(id) {
	document.getElementById('overlayCollateral' + id).classList.add('active');
	document.getElementById('approveCard' + id).classList.add('active');
}

function hideApproveCard(id) {
	document.getElementById('overlayCollateral' + id).classList.remove('active');
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

function showConfirmation(id) {
	document.getElementById('overlayConfirmation' + id).classList.add('active');
	document.getElementById('fundCard' + id).classList.add('active');
}

function hideConfirmation(id) {
	document.getElementById('overlayConfirmation' + id).classList.remove('active');
	document.getElementById('fundCard' + id).classList.remove('active');
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

function showPrint(id) {
	document.getElementById('printoverlay' + id).classList.add('active');
	document.getElementById('printCard' + id).classList.add('active');
}

function hidePrint(id) {
	document.getElementById('printoverlay' + id).classList.remove('active');
	document.getElementById('printCard' + id).classList.remove('active');
}

$(document).ready(function () {
	
	function saveScrollPositions() {
		$('.credit-history-content').each(function () {
			var contentId = $(this).attr('id');
			var scrollPosition = $(this).scrollTop();
			localStorage.setItem(contentId, scrollPosition);
		});
	}

	function restoreScrollPositions() {
		$('.credit-history-content').each(function () {
			var contentId = $(this).attr('id');
			var savedPosition = localStorage.getItem(contentId);
			if (savedPosition !== null) {
			$(this).scrollTop(savedPosition);
			}
		});
	}
	
    function loadApplicationCard() {
		
		saveScrollPositions();
		
		let activeApplicationCardIds = [];
        $('.application-card.active').each(function () {
            activeApplicationCardIds.push($(this).attr('id'));
        });
		
		let activeOverlayCardIds = [];
        $('.overlaycollateral.active').each(function () {
            activeOverlayCardIds.push($(this).attr('id'));
        });
		
		let activeCollateralCardIds = [];
        $('.collateral-picture.active').each(function () {
            activeCollateralCardIds.push($(this).attr('id'));
        });
		
		let activeConfirmationCardIds = [];
        $('.confirmation-card.active').each(function () {
            activeConfirmationCardIds.push($(this).attr('id'));
        });
		
		let activeOverlayAgreeementCardIds = [];
        $('.overlayagreement.active').each(function () {
            activeOverlayAgreeementCardIds.push($(this).attr('id'));
        });
		
		let activeAgreementCardIds = [];
        $('.agreement-card.active').each(function () {
            activeAgreementCardIds.push($(this).attr('id'));
        });
		
		let activeOverlayConfirmationCardIds = [];
        $('.overlayconfirmation.active').each(function () {
            activeOverlayConfirmationCardIds.push($(this).attr('id'));
        });
		
		let activeFundCardIds = [];
        $('.fund-card.active').each(function () {
            activeFundCardIds.push($(this).attr('id'));
        });

        let activeOverlayPrintCardIds = [];
        $('.printoverlay.active').each(function () {
            activeOverlayPrintCardIds.push($(this).attr('id'));
        });
		
		let activePrintCardIds = [];
        $('.print-card.active').each(function () {
            activePrintCardIds.push($(this).attr('id'));
        });
		
        $.ajax({
            url: 'functions/load-lenders-application-card.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#applicationCardContainer').html(response);
				
				restoreScrollPositions();
				
				activeApplicationCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeOverlayCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeCollateralCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeConfirmationCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeOverlayAgreeementCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeAgreementCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeOverlayConfirmationCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeFundCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });

                activeOverlayPrintCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activePrintCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
            },
            error: function () {
                $('#applicationCardContainer').html('<p class="error-message"></p>');
            }
        });
    }

    loadApplicationCard();

    setInterval(loadApplicationCard, 30000);
	
	$(window).on('beforeunload', saveScrollPositions);
});

$(document).ready(function () {
    function loadLendManagerNotification() {
        $.ajax({
            url: 'functions/load-lenders-notification.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#userLendManagerNotification').html(response);
            },
            error: function () {
                $('#userLendManagerNotification').html('<p class="error-message"></p>');
            }
        });
    }

    loadLendManagerNotification();

    setInterval(loadAdminLendManagerNotification, 30000);
});