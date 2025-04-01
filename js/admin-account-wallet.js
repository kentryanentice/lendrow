$(document).ready(function () {
    function loadAdminCashoutNotifications() {
        $.ajax({
            url: 'functions/load-admin-account-wallet-virtual-wallet-history.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#adminVirtualTransactionHistory').html(response);
            },
            error: function () {
                $('#adminVirtualTransactionHistory').html('<p class="empty"></p>');
            }
        });
    }

    loadAdminCashoutNotifications();

    setInterval(loadAdminCashoutNotifications, 30000);
});

$(document).ready(function () {
    function loadAdminCashinRequests() {
        $.ajax({
            url: 'functions/load-admin-account-wallet-cashin-request.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#adminCashinRequests').html(response);
            },
            error: function () {
                $('#adminCashinRequests').html('<p class="empty">No Cash In requests.</p>');
            }
        });
    }

    loadAdminCashinRequests();

    setInterval(loadAdminCashinRequests, 30000);
});

$(document).ready(function () {
    function loadAdminCashinRequests() {
        $.ajax({
            url: 'functions/load-admin-account-wallet-cashout-request.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#adminCashoutRequests').html(response);
            },
            error: function () {
                $('#adminCashoutRequests').html('<p class="empty">No Cash Out requests.</p>');
            }
        });
    }

    loadAdminCashinRequests();

    setInterval(loadAdminCashinRequests, 30000);
});

$(document).ready(function () {
    function loadVirtualMoneyNotifications() {
        $.ajax({
            url: 'functions/load-admin-account-wallet-virtual-money-notification.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#adminVirtualMoneyNotification').html(response);
            },
            error: function () {
                $('#adminVirtualMoneyNotification').html('<p class="empty"></p>');
            }
        });
    }

    loadVirtualMoneyNotifications();

    setInterval(loadVirtualMoneyNotifications, 30000);
});

$(document).ready(function () {
    function loadAdminCashinNotifications() {
        $.ajax({
            url: 'functions/load-admin-account-wallet-cashin-request-notification.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#adminVirtualCashinNotification').html(response);
            },
            error: function () {
                $('#adminVirtualCashinNotification').html('<p class="empty"></p>');
            }
        });
    }

    loadAdminCashinNotifications();

    setInterval(loadAdminCashinNotifications, 30000);
});

$(document).ready(function () {
    function loadAdminCashoutNotifications() {
        $.ajax({
            url: 'functions/load-admin-account-wallet-cashout-request-notification.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#adminVirtualCashoutNotification').html(response);
            },
            error: function () {
                $('#adminVirtualCashoutNotification').html('<p class="empty"></p>');
            }
        });
    }

    loadAdminCashoutNotifications();

    setInterval(loadAdminCashoutNotifications, 30000);
});

$(document).ready(function () {
    function loadAdminVirtualBalance() {
        $.ajax({
            url: 'functions/load-admin-account-wallet-virtual-balance.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#virtualBalance').html(response);
            },
            error: function () {
                $('#virtualBalance').html('<p class="empty"></p>');
            }
        });
    }

    loadAdminVirtualBalance();

    setInterval(loadAdminVirtualBalance, 30000);
});

$(document).ready(function () {
    function loadAdminSystemBalance() {
        $.ajax({
            url: 'functions/load-admin-account-wallet-system-balance.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#systemBalance').html(response);
            },
            error: function () {
                $('#systemBalance').html('<p class="empty"></p>');
            }
        });
    }

    loadAdminSystemBalance();

    setInterval(loadAdminSystemBalance, 30000);
});

$(document).ready(function () {
    function loadAdminCashinRequestCard() {
		
		let activeRequestCardIds = [];
        $('.cashin-card.active').each(function () {
            activeRequestCardIds.push($(this).attr('id'));
        });
		
		let activeOverlayIds = [];
        $('.overlaycashinbg.active').each(function () {
            activeOverlayIds.push($(this).attr('id'));
        });
		
		let activeCashinReceiptCardIds = [];
        $('.cashin-card-receipt.active').each(function () {
            activeCashinReceiptCardIds.push($(this).attr('id'));
        });
		
        $.ajax({
            url: 'functions/load-admin-account-wallet-cashin-request-card.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#cashinRequestCardContainer').html(response);
				
				activeRequestCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeOverlayIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeCashinReceiptCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
            },
            error: function () {
                $('#cashinRequestCardContainer').html('<p class="error-message"></p>');
            }
        });
    }

    loadAdminCashinRequestCard();

    setInterval(loadAdminCashinRequestCard, 30000);
});

$(document).ready(function () {
	
    function loadAdminCashoutRequestCard() {
		
		let activeRequestCardIds = [];
        $('.cashout-card.active').each(function () {
            activeRequestCardIds.push($(this).attr('id'));
        });
		
		let activeOverlayIds = [];
        $('.overlaycashoutbg.active').each(function () {
            activeOverlayIds.push($(this).attr('id'));
        });
		
		let activeCashoutReceiptCardIds = [];
        $('.cashout-card-receipt.active').each(function () {
            activeCashoutReceiptCardIds.push($(this).attr('id'));
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

        $('.receipt-error-message').each(function () {
            const cardId = $(this).attr('id')?.split('-')[1];
            if (cardId) {
                errorMessagesState[cardId] = $(this).html();
            }
        });

        $('.receipt-empty-error').each(function () {
            const cardId = $(this).attr('id')?.split('-')[1];
            if (cardId) {
                emptyMessagesState[cardId] = $(this).html();
            }
        });
		
        $.ajax({
            url: 'functions/load-admin-account-wallet-cashout-request-card.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#cashoutRequestCardContainer').html(response);
				
				activeRequestCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeOverlayIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeCashoutReceiptCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				for (const cardId in fileInputsState) {
                    if (fileInputsState[cardId]) {
                        const fileInput = document.getElementById(`receipt-${cardId}`);
                        if (fileInput) {
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(fileInputsState[cardId]);
                            fileInput.files = dataTransfer.files;
                        }
                    }
                }

                for (const cardId in errorMessagesState) {
                    const errorElement = document.getElementById(`receipt-error-${cardId}`);
                    if (errorElement) {
                        errorElement.innerHTML = errorMessagesState[cardId];
                    }
                }
				
				for (const cardId in emptyMessagesState) {
                    const errorElement = document.getElementById(`receipt-empty-error-${cardId}`);
                    if (errorElement) {
                        errorElement.innerHTML = emptyMessagesState[cardId];
                    }
                }

                initializeEventListeners();
				
            },
            error: function () {
                $('#cashoutRequestCardContainer').html('<p class="error-message"></p>');
            }
        });
    }
	
	function initializeEventListeners() {
        $('.file').off('input').on('input', function () {
            const cardId = $(this).attr('id')?.split('-')[1];
            if (cardId) {
                validateUpdateFormDynamically(cardId);
            }
        });

        $('.cashout-card form').off('submit').on('submit', function (e) {
            const form = $(this);
            const cardId = form.find('.file').attr('id')?.split('-')[1];
            if (cardId) {
                const isFormValid = validateUpdateFormDynamically(cardId);
                if (!isFormValid) {
                    e.preventDefault();
                }
            }
        });
    }
	
    loadAdminCashoutRequestCard();

    setInterval(loadAdminCashoutRequestCard, 30000);
});

$(document).ready(function () {
    function loadAdminVirtualCashInCard() {
		
		let activeVirtualCashinCardIds = [];
        $('.confirm-virtual-cashin-form.active').each(function () {
            activeVirtualCashinCardIds.push($(this).attr('id'));
        });
		
        $.ajax({
            url: 'functions/load-admin-account-wallet-virtual-cashin-card.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#virtualCashInCardContainer').html(response);
				
				activeVirtualCashinCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
            },
            error: function () {
                $('#virtualCashInCardContainer').html('<p class="error-message"></p>');
            }
        });
    }

    loadAdminVirtualCashInCard();

    setInterval(loadAdminVirtualCashInCard, 30000);
});

var swiper = new Swiper("#virtualAmountSlide .slide-content", {
	slidesPerView: 1,
	spaceBetween: 25,
	slidesPerGroup: 1,
	centerSlide: 'true',
	fade: 'true',
	grabCursor: 'true',
	loopFillGroupWithBlank: true,
		pagination: {
			el: "#virtualAmountSlide .swiper-pagination",
			clickable: true,
			dynamicBullets: true,
		},
		navigation: {
			nextEl: "#virtualAmountSlide .swiper-button-next",
			prevEl: "#virtualAmountSlide .swiper-button-prev",
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

function showVirtualMoneyManager() {
	localStorage.setItem('activeManagerTab', 'virtualMoneyManager');
	document.getElementById('virtualMoneyManager').classList.add('active');
	document.getElementById('virtualCashinManager').classList.remove('active');
	document.getElementById('virtualCashoutManager').classList.remove('active');
	document.getElementById('virtualMoneyManagerButton').classList.add('active');
	document.getElementById('virtualCashinManagerButton').classList.remove('active');
	document.getElementById('virtualCashoutManagerButton').classList.remove('active');
}

function showVirtualCashinManager() {
	localStorage.setItem('activeManagerTab', 'virtualCashinManager');
	document.getElementById('virtualMoneyManager').classList.remove('active');
	document.getElementById('virtualCashinManager').classList.add('active');
	document.getElementById('virtualCashoutManager').classList.remove('active');
	document.getElementById('virtualMoneyManagerButton').classList.remove('active');
	document.getElementById('virtualCashinManagerButton').classList.add('active');
	document.getElementById('virtualCashoutManagerButton').classList.remove('active');
}

function showVirtualCashoutManager() {
	localStorage.setItem('activeManagerTab', 'virtualCashoutManager');
	document.getElementById('virtualMoneyManager').classList.remove('active');
	document.getElementById('virtualCashinManager').classList.remove('active');
	document.getElementById('virtualCashoutManager').classList.add('active');
	document.getElementById('virtualMoneyManagerButton').classList.remove('active');
	document.getElementById('virtualCashinManagerButton').classList.remove('active');
	document.getElementById('virtualCashoutManagerButton').classList.add('active');
}

document.addEventListener('DOMContentLoaded', function() {
    var activeTab = localStorage.getItem('activeManagerTab');
    if (activeTab === 'virtualCashinManager') {
        showVirtualCashinManager();
    } else if (activeTab === 'virtualCashoutManager') {
        showVirtualCashoutManager();
    } else {
        showVirtualMoneyManager();
    }
})

function showVirtualBalance() {
	localStorage.setItem('activeBalanceTab', 'virtualBalance');
	document.getElementById('adminVirtualBalance').classList.add('active');
	document.getElementById('adminSystemBalance').classList.remove('active');
}

function showSystemBalance() {
	localStorage.setItem('activeBalanceTab', 'systemBalance');
	document.getElementById('adminVirtualBalance').classList.remove('active');
	document.getElementById('adminSystemBalance').classList.add('active');
}

document.addEventListener('DOMContentLoaded', function() {
    var activeTab = localStorage.getItem('activeBalanceTab');
    if (activeTab === 'virtualBalance') {
        showVirtualBalance();
    } else if (activeTab === 'systemBalance') {
        showSystemBalance();
    }
})

function showVirtualSetUp() {
	document.getElementById('overlayBg').classList.add('active');
	document.getElementById('virtualSetUpForm').classList.add('active');
}

function hideVirtualSetUp() {
	document.getElementById('overlayBg').classList.remove('active');
	document.getElementById('virtualSetUpForm').classList.remove('active');
}

function showVirtualCashInForm() {
	document.getElementById('overlayBg').classList.add('active');
	document.getElementById('virtualCashInForm').classList.add('active');
}

function hideVirtualMoneyForm() {
	document.getElementById('overlayBg').classList.remove('active');
	document.getElementById('virtualCashInForm').classList.remove('active');
}

function viewConfirmVirtualMoney(id) {
	document.getElementById('overlayBg').classList.add('active');
	document.getElementById('confirmVirtualMoney' + id).classList.add('active');
}

function hideConfirmVirtualMoney(id) {
	document.getElementById('overlayBg').classList.remove('active');
	document.getElementById('confirmVirtualMoney' +id).classList.remove('active');
}

function viewCashinInfo(id) {
	document.getElementById('overlayBg').classList.add('active');
	document.getElementById('cashInCard' + id).classList.add('active');
}

function hideCashinInfo(id) {
	document.getElementById('overlayBg').classList.remove('active');
	document.getElementById('cashInCard' +id).classList.remove('active');
}

function showCashinReceipt(id) {
	document.getElementById('overlayCashinBg' + id).classList.add('active');
	document.getElementById('cashInReceipt' + id).classList.add('active');
}

function hideCashinReceipt(id) {
	document.getElementById('overlayCashinBg' + id).classList.remove('active');
	document.getElementById('cashInReceipt' +id).classList.remove('active');
}

function viewCashoutInfo(id) {
	document.getElementById('overlayBg').classList.add('active');
	document.getElementById('cashOutCard' + id).classList.add('active');
}

function hideCashoutInfo(id) {
	document.getElementById('overlayBg').classList.remove('active');
	document.getElementById('cashOutCard' +id).classList.remove('active');
}

function showCashoutReceipt(id) {
	document.getElementById('overlayCashoutBg' + id).classList.add('active');
	document.getElementById('cashOutReceipt' + id).classList.add('active');
}

function hideCashoutReceipt(id) {
	document.getElementById('overlayCashoutBg' + id).classList.remove('active');
	document.getElementById('cashOutReceipt' +id).classList.remove('active');
}

function validateName() {
    const nameInput = document.getElementById('adminWalletName');
    nameInput.value = nameInput.value.trimStart();
    const name = nameInput.value;
    const error = document.getElementById('name-error');
	
    if (/[^a-zA-Z ]/.test(name)) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Account Name! Please use letters only.</p>";
        error.style.display = 'block';
    } else {
        error.style.display = 'none';
		error.innerHTML = "";
    }
}

function validateFormDynamically() {
    const requiredFields = ['adminWalletName'];
    const error = document.getElementById('empty-error');
    let isValid = true;

    requiredFields.forEach((fieldId) => {
        const field = document.getElementById(fieldId);
        if (!field.value.trim()) {
            isValid = false;
        }
    });

   const hasValidationError =
        /[^a-zA-Z ]/.test(document.getElementById('adminWalletName').value);
		
	if (!isValid) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are empty fields, please fill in all fields!";
        error.style.display = 'block';
    } else if (hasValidationError) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are incorrect fields, please adjust them properly.</p>";
        error.style.display = 'block';
        isValid = false;
    } else {
        error.innerHTML = "";
        error.style.display = 'none';
    }

    return isValid;
}

document.addEventListener("DOMContentLoaded", () => {
    const formFields = document.querySelectorAll('#virtualSetUpForm input');
    const form = document.getElementById('virtualSetUpForm');

    formFields.forEach((field) => {
        field.addEventListener('input', validateFormDynamically);
    });

    form.addEventListener('submit', (e) => {
        const isFormValid = validateFormDynamically();
        if (!isFormValid) {
            e.preventDefault();
        }
    });
});

function validateRadioButtons() {
    const amountRadios = document.getElementsByName('admin-cashin-amount');
    const amountError = document.getElementById('amount-error');
    
    let isAmountValid = false;

    for (let radio of amountRadios) {
        if (radio.checked) {
            isAmountValid = true;
            break;
        }
    }

    if (!isAmountValid) {
        amountError.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please choose a Cash In amount.</p>";
        amountError.style.display = 'block';
    } else {
        amountError.style.display = 'none';
        amountError.innerHTML = "";
    }

    return isAmountValid;
}

function validateFormDynamically2() {
    const requiredFields = ['admin-cashin-amount'];
    const error = document.getElementById('virtual-empty-error');
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

    const isRadioButtonsValid = validateRadioButtons();

    if (!isValid) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are empty fields, please fill in all fields!</p>";
        error.style.display = 'block';
    } else if (!isRadioButtonsValid) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are incorrect fields, please adjust them properly.</p>";
        error.style.display = 'block';
        isValid = false;
    } else {
        error.innerHTML = "";
        error.style.display = 'none';
    }

    return isValid;
}

document.addEventListener("DOMContentLoaded", () => {
    const formFields = document.querySelectorAll('#virtual-cashin-form input');
    const form = document.getElementById('virtual-cashin-form');

    formFields.forEach((field) => {
        field.addEventListener('input', validateFormDynamically2);
    });

    form.addEventListener('submit', (e) => {
        const isFormValid = validateFormDynamically2();
        if (!isFormValid) {
            e.preventDefault();
        }
    });
});

function validateReceipt(cardId) {
    const fileInput = document.getElementById(`receipt-${cardId}`);
    const error = document.getElementById(`receipt-error-${cardId}`);
    const allowedFormats = ["image/jpeg", "image/png", "image/gif"];
    const maxSize = 2 * 1024 * 1024;
	
    if (fileInput.files.length === 0) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please insert a receipt to upload!</p>";
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
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please insert a receipt image below 2MB!</p>";
        error.style.display = 'block';
        return false;
    }

    error.style.display = 'none';
    return true;
}

function validateUpdateFormDynamically(cardId) {
    const error = document.getElementById(`receipt-empty-error-${cardId}`);
    let isValid = true;

    const fileInput = document.getElementById(`receipt-${cardId}`);
    if (fileInput && fileInput.files.length === 0) {
        isValid = false;
    }

    const isReceiptValid = validateReceipt(cardId);

    if (!isValid) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are empty fields, please fill in all fields!</p>";
        error.style.display = 'block';
    } else if (!isReceiptValid) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are incorrect fields, please adjust them properly.</p>";
        error.style.display = 'block';
        isValid = false;
    } else {
        error.innerHTML = "";
        error.style.display = 'none';
    }

    return isValid && isReceiptValid;
}

document.addEventListener("DOMContentLoaded", () => {
    const forms = document.querySelectorAll('#cashout-card-form');

    forms.forEach((form) => {
        const cardId = form.querySelector('.file').id.split('-')[1];
        const fileInput = document.getElementById(`receipt-${cardId}`);
        const submitButton = form.querySelector('button[type="submit"]');

        fileInput.addEventListener('input', () => validateUpdateFormDynamically(cardId));

        form.addEventListener('submit', (e) => {
            const isFormValid = validateUpdateFormDynamically(cardId);
            if (!isFormValid) {
                e.preventDefault();
            }
        });
    });
});
