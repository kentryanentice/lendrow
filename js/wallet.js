$(document).ready(function () {
    function loadWalletBalance() {
        $.ajax({
            url: 'functions/load-wallet-balance.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#userWalletBalance').html(response);
            },
            error: function () {
                $('#userWalletBalance').html('<p class="error-message">0.00</p>');
            }
        });
    }

    loadWalletBalance();

    setInterval(loadWalletBalance, 30000);
});

$(document).ready(function () {
    function loadRequestsHistory() {
        $.ajax({
            url: 'functions/load-wallet-request-history.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#userRequestsHistory').html(response);
            },
            error: function () {
                $('#userRequestsHistory').html('<p class="error-message">No requests history.</p>');
            }
        });
    }

    loadRequestsHistory();

    setInterval(loadRequestsHistory, 30000);
});

$(document).ready(function () {
    function loadTransactionsHistory() {
        $.ajax({
            url: 'functions/load-wallet-transaction-history.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#userTransactionsHistory').html(response);
            },
            error: function () {
                $('#userTransactionsHistory').html('<p class="error-message">No transactions history.</p>');
            }
        });
    }

    loadTransactionsHistory();

    setInterval(loadTransactionsHistory, 30000);
});

$(document).ready(function () {
    function loadRequestsHistoryNotifications() {
        $.ajax({
            url: 'functions/load-wallet-request-history-notification.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#userRequestHistoryNotifications').html(response);
            },
            error: function () {
                $('#userRequestHistoryNotifications').html('<p class="error-message">No requests history Notifications.</p>');
            }
        });
    }

    loadRequestsHistoryNotifications();

    setInterval(loadRequestsHistoryNotifications, 30000);
});

$(document).ready(function () {
    function loadWalletRequestCard() {
		
		let activeCardIds = [];
        $('.request-card.active').each(function () {
            activeCardIds.push($(this).attr('id'));
        });
		
		let activeOverlayIds = [];
        $('.overlaycardbg.active').each(function () {
            activeOverlayIds.push($(this).attr('id'));
        });
		
		let activeCashinReceiptCardIds = [];
        $('.card-receipt.active').each(function () {
            activeCashinReceiptCardIds.push($(this).attr('id'));
        });
		
        $.ajax({
            url: 'functions/load-wallet-request-card.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#requestCardContainer').html(response);
				
				activeCardIds.forEach(function (cardId) {
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
                $('#requestCardContainer').html('<p class="error-message"></p>');
            }
        });
    }

    loadWalletRequestCard();

    setInterval(loadWalletRequestCard, 30000);
});

var swiper = new Swiper("#cashinAmountSlide .slide-content", {
	slidesPerView: 1,
	spaceBetween: 25,
	slidesPerGroup: 1,
	centerSlide: 'true',
	fade: 'true',
	grabCursor: 'true',
	loopFillGroupWithBlank: true,
		pagination: {
			el: "#cashinAmountSlide .swiper-pagination",
			clickable: true,
			dynamicBullets: true,
		},
		navigation: {
			nextEl: "#cashinAmountSlide .swiper-button-next",
			prevEl: "#cashinAmountSlide .swiper-button-prev",
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

var swiper = new Swiper("#cashoutAmountSlide .slide-content", {
	slidesPerView: 1,
	spaceBetween: 25,
	slidesPerGroup: 1,
	centerSlide: 'true',
	fade: 'true',
	grabCursor: 'true',
	loopFillGroupWithBlank: true,
		pagination: {
			el: "#cashoutAmountSlide .swiper-pagination",
			clickable: true,
			dynamicBullets: true,
		},
		navigation: {
			nextEl: "#cashoutAmountSlide .swiper-button-next",
			prevEl: "#cashoutAmountSlide .swiper-button-prev",
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

function validateRadioButtons() {
    const paymentMethodRadios = document.getElementsByName('user-cashin-method');
    const amountRadios = document.getElementsByName('user-cashin-amount');
    const paymentMethodError = document.getElementById('payment-method-error');
    const amountError = document.getElementById('payment-amount-error');
    
    let isPaymentMethodValid = false;
    let isAmountValid = false;

    for (let radio of paymentMethodRadios) {
        if (radio.checked) {
            isPaymentMethodValid = true;
            break;
        }
    }

    for (let radio of amountRadios) {
        if (radio.checked) {
            isAmountValid = true;
            break;
        }
    }

    if (!isPaymentMethodValid) {
        paymentMethodError.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please choose a payment method.</p>";
        paymentMethodError.style.display = 'block';
    } else {
        paymentMethodError.style.display = 'none';
        paymentMethodError.innerHTML = "";
    }

    if (!isAmountValid) {
        amountError.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please choose a Cash In amount.</p>";
        amountError.style.display = 'block';
    } else {
        amountError.style.display = 'none';
        amountError.innerHTML = "";
    }

    return isPaymentMethodValid && isAmountValid;
}

function validateReceipt() {
    const fileInput = document.getElementById('receipt');
    const error = document.getElementById('receipt-error');
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

function validateFormDynamically() {
    const requiredFields = ['user-cashin-method', 'user-cashin-amount', 'receipt'];
    const error = document.getElementById('cashin-empty-error');
    let isValid = true;
	
	requiredFields.forEach((fieldName) => {
        const field = document.getElementsByName(fieldName);
        let isFieldValid = false;
		
	if (fieldName === 'receipt') {
		const fileInput = document.getElementById('receipt');
		if (fileInput && fileInput.files.length > 0) {
			isFieldValid = true;
		}
	} else {
	
	for (let radio of field) {
            if (radio.checked) {
                isFieldValid = true;
                break;
            }
        }
	}

        if (!isFieldValid) {
            isValid = false;
        }
    });

    const isRadioButtonsValid = validateRadioButtons();
	const isReceiptValid = validateReceipt();

    if (!isValid) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are empty fields, please fill in all fields!</p>";
        error.style.display = 'block';
    } else if (!isRadioButtonsValid || !isReceiptValid) {
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
    const formFields = document.querySelectorAll('#user-cashin-form input');
    const form = document.getElementById('user-cashin-form');

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

function validateRadioButtons2(radio) {
    const fee = parseFloat(radio.getAttribute('data-fee'));
    const value = parseFloat(radio.getAttribute('data-value'));
    const total = fee + value;
    
    const formatNumber = (num) => (num % 1 === 0 ? parseInt(num, 10) : num.toFixed(2));
    
    const feeElement = document.querySelector('.user-cashout-fee');
    const totalElement = document.querySelector('.user-cashout-total');
    feeElement.textContent = `₱${formatNumber(fee)}`;
    totalElement.textContent = `₱${formatNumber(total)}`;
    
    feeElement.style.opacity = '1';
    feeElement.style.transform = 'scale(90%)';
    feeElement.style.background = 'linear-gradient(to right, #0ef, #02b4c2)';
    totalElement.style.opacity = '1';
    totalElement.style.transform = 'scale(90%)';
    totalElement.style.background = 'linear-gradient(to right, #0ef, #02b4c2)';
}

function validateRadioButtonsForm() {
    const cashoutMethodRadios = document.getElementsByName('user-cashout-method');
    const cashoutAmountRadios = document.getElementsByName('user-cashout-amount');
    const cashoutMethodError = document.getElementById('cashout-method-error');
    const cashoutAmountError = document.getElementById('cashout-amount-error');
    
    let isCashoutMethodValid = false;
    let isCashoutAmountValid = false;

    for (let radio of cashoutMethodRadios) {
        if (radio.checked) {
            isCashoutMethodValid = true;
            break;
        }
    }

    for (let radio of cashoutAmountRadios) {
        if (radio.checked) {
            isCashoutAmountValid = true;
            break;
        }
    }

    if (!isCashoutMethodValid) {
        cashoutMethodError.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please choose a Cash Out method.</p>";
        cashoutMethodError.style.display = 'block';
    } else {
        cashoutMethodError.style.display = 'none';
        cashoutMethodError.innerHTML = "";
    }

    if (!isCashoutAmountValid) {
        cashoutAmountError.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>Please choose a Cash Out amount.</p>";
        cashoutAmountError.style.display = 'block';
    } else {
        cashoutAmountError.style.display = 'none';
        cashoutAmountError.innerHTML = "";
    }

    return isCashoutMethodValid && isCashoutAmountValid;
}

function validateFormDynamically2() {
    const requiredFields = ['user-cashout-method', 'user-cashout-amount'];
    const error = document.getElementById('cashout-empty-error');
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

    const isRadioButtonsValid2 = validateRadioButtonsForm();

    if (!isValid) {
        error.innerHTML = "<i class='bx bxs-error-circle'></i><p class='red'>There are empty fields, please fill in all fields!</p>";
        error.style.display = 'block';
    } else if (!isRadioButtonsValid2) {
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
    const formFields = document.querySelectorAll('#user-cashout-form input');
    const form = document.getElementById('user-cashout-form');

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

function showSendMoney() {
	document.getElementById('userSendMoneyForm').classList.add('active');
	document.getElementById('overlayBg').classList.add('active');
}

function hideSendMoney() {
	document.getElementById('userSendMoneyForm').classList.remove('active');
	document.getElementById('overlayBg').classList.remove('active');
}

function showCashIn() {
	document.getElementById('userCashInForm').classList.add('active');
	document.getElementById('overlayBg').classList.add('active');
}

function hideCashIn() {
	document.getElementById('userCashInForm').classList.remove('active');
	document.getElementById('overlayBg').classList.remove('active');
}

function showCashOut() {
	document.getElementById('userCashOutForm').classList.add('active');
	document.getElementById('overlayBg').classList.add('active');
}

function hideCashOut() {
	document.getElementById('userCashOutForm').classList.remove('active');
	document.getElementById('overlayBg').classList.remove('active');
}

function showRequest() {
	localStorage.setItem('activeHistoryTab', 'activeRequestTab');
	document.getElementById('userTransactionHistory').classList.remove('active');
    document.getElementById('userRequestHistory').classList.add('active');
}

function showTransaction() {
	localStorage.setItem('activeHistoryTab', 'activeTransactionTab');
	document.getElementById('userTransactionHistory').classList.add('active');
    document.getElementById('userRequestHistory').classList.remove('active');
}

document.addEventListener('DOMContentLoaded', function() {
    var activeTab = localStorage.getItem('activeHistoryTab');
    if (activeTab === 'activeTransactionTab') {
        showTransaction();
    } else if (activeTab === 'activeRequestTab') {
        showRequest();
    }
})

function showRequestCard(id) {
	document.getElementById('overlayBg').classList.add('active');
	document.getElementById('requestCard' + id).classList.add('active');
}

function hideRequestCard(id) {
	document.getElementById('overlayBg').classList.remove('active');
	document.getElementById('requestCard' + id).classList.remove('active');
}

function showCardReceipt(id) {
	document.getElementById('overlayCardBg' + id).classList.add('active');
	document.getElementById('cardReceipt' + id).classList.add('active');
}

function hideCardReceipt(id) {
	document.getElementById('overlayCardBg' + id).classList.remove('active');
	document.getElementById('cardReceipt' + id).classList.remove('active');
}