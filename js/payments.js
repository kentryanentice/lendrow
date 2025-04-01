function showPaymentsManager() {
	localStorage.setItem('activePaymentsTab', 'paymentsManagerButton');
	document.getElementById('paymentsManagerButton').classList.add('active');
	document.getElementById('userPaymentManager').classList.add('active');
	document.getElementById('paymentInfoButton').classList.add('active');
	document.getElementById('collectManagerButton').classList.remove('active');
	document.getElementById('userCollectManager').classList.remove('active');
	document.getElementById('collectionInfoButton').classList.remove('active');
}

function showCollectManager() {
	localStorage.setItem('activePaymentsTab', 'collectManagerButton');
	document.getElementById('paymentsManagerButton').classList.remove('active');
	document.getElementById('userPaymentManager').classList.remove('active');
	document.getElementById('paymentInfoButton').classList.remove('active');
	document.getElementById('collectManagerButton').classList.add('active');
	document.getElementById('userCollectManager').classList.add('active');
	document.getElementById('collectionInfoButton').classList.add('active');
}

document.addEventListener('DOMContentLoaded', function() {
    var activeTab = localStorage.getItem('activePaymentsTab');
    if (activeTab === 'paymentsManagerButton') {
        showPaymentsManager();
    } else if (activeTab === 'collectManagerButton') {
        showCollectManager();
    }
})

$(document).ready(function () {
	var paymentswiper;
	
	function saveScrollPositions() {
		$('.payments-content').each(function () {
			var contentId = $(this).attr('id');
			var scrollPosition = $(this).scrollTop();
			localStorage.setItem(contentId, scrollPosition);
		});
	}

	function restoreScrollPositions() {
		$('.payments-content').each(function () {
			var contentId = $(this).attr('id');
			var savedPosition = localStorage.getItem(contentId);
			if (savedPosition !== null) {
			$(this).scrollTop(savedPosition);
			}
		});
	}

    function loadPaymentsData() {
		
		saveScrollPositions();

        Promise.all([$.ajax({
            url: 'functions/load-payments-payment-card.php',
            type: 'GET',
            cache: false
        })])
        .then(function (response) {
            if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                console.error('Unexpected HTML response (possible redirect).');
                return;
            }
            $('#paymentCardContainer').html(response);
			
			restoreScrollPositions();

            if (!paymentswiper) {
                paymentswiper = new Swiper('#paymentSlide .slide-content', {
                    slidesPerView: 1,
                    spaceBetween: 25,
                    slidesPerGroup: 1,
                    centerSlide: 'true',
                    fade: 'true',
                    grabCursor: 'true',
                    loopFillGroupWithBlank: false,
                    pagination: {
                        el: '#paymentSlide .swiper-pagination',
                        clickable: true,
                        dynamicBullets: true,
                    },
                    navigation: {
                        nextEl: '#paymentSlide .swiper-button-next',
                        prevEl: '#paymentSlide .swiper-button-prev',
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
                paymentswiper.update();
            }
        })
        .catch(function () {
            $('#paymentCardContainer').html('<p class="empty" id="loading"><span class="animated-dots">Loading payment manager<span class="dots"></span></span></p>');
        });
    }

    loadPaymentsData();
    setInterval(loadPaymentsData, 60000);
	
	$(window).on('beforeunload', saveScrollPositions);
});


$(document).ready(function () {
    var collectionswiper;
	
	function saveScrollPositions() {
		$('.collections-content').each(function () {
			var contentId = $(this).attr('id');
			var scrollPosition = $(this).scrollTop();
			localStorage.setItem(contentId, scrollPosition);
		});
	}

	function restoreScrollPositions() {
		$('.collections-content').each(function () {
			var contentId = $(this).attr('id');
			var savedPosition = localStorage.getItem(contentId);
			if (savedPosition !== null) {
			$(this).scrollTop(savedPosition);
			}
		});
	}

    function loadCollectionsData() {
		
		saveScrollPositions();

        Promise.all([$.ajax({
            url: 'functions/load-payments-collection-card.php',
            type: 'GET',
            cache: false
        })])
        .then(function (response) {
            if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                console.error('Unexpected HTML response (possible redirect).');
                return;
            }
            $('#collectionCardContainer').html(response);
			
			restoreScrollPositions();

            if (!collectionswiper) {
                collectionswiper = new Swiper('#collectionSlide .slide-content', {
                    slidesPerView: 1,
                    spaceBetween: 25,
                    slidesPerGroup: 1,
                    centerSlide: 'true',
                    fade: 'true',
                    grabCursor: 'true',
                    loopFillGroupWithBlank: false,
                    pagination: {
                        el: '#collectionSlide .swiper-pagination',
                        clickable: true,
                        dynamicBullets: true,
                    },
                    navigation: {
                        nextEl: '#collectionSlide .swiper-button-next',
                        prevEl: '#collectionSlide .swiper-button-prev',
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
                collectionswiper.update();
            }
        })
        .catch(function () {
            $('#collectionCardContainer').html('<p class="empty" id="loading"><span class="animated-dots">Loading collection manager<span class="dots"></span></span></p>');
        });
    }

    loadCollectionsData();
    setInterval(loadCollectionsData, 60000);
	
	$(window).on('beforeunload', saveScrollPositions);
});

function showPayment(id) {
	document.getElementById('overlayBg').classList.add('active');
	document.getElementById('paymentForm' + id).classList.add('active');
}

function hidePayment(id) {
	document.getElementById('overlayBg').classList.remove('active');
	document.getElementById('paymentForm' + id).classList.remove('active');
}

function showConfirmPay(id) {
	document.getElementById('overlayConfirmation' + id).classList.add('active');
	document.getElementById('confirmCard' + id).classList.add('active');
}

function hideConfirmPay(id) {
	document.getElementById('overlayConfirmation' + id).classList.remove('active');
	document.getElementById('confirmCard' + id).classList.remove('active');
}

$(document).ready(function () {
	
    function loadMonthlyPaymentCards() {
		
		let activePaymentCardIds = [];
        $('.monthly-payment-form.active').each(function () {
            activePaymentCardIds.push($(this).attr('id'));
        });
		
		let activeOverlayConfirmationCardIds = [];
        $('.overlayconfirmation.active').each(function () {
            activeOverlayConfirmationCardIds.push($(this).attr('id'));
        });
		
		let activeConfirmationCardIds = [];
        $('.confirmation-card.active').each(function () {
            activeConfirmationCardIds.push($(this).attr('id'));
        });
		
        $.ajax({
            url: 'functions/load-payments-monthly-payment-card.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#monthlyPaymentCardContainer').html(response);
			
				activePaymentCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeOverlayConfirmationCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				activeConfirmationCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });

            },
            error: function () {
                $('#monthlyPaymentCardContainer').html('<p class="error-message"></p>');
            }
        });
    }

    loadMonthlyPaymentCards();

    setInterval(loadMonthlyPaymentCards, 60000);
});


$(document).ready(function () {
    function loadPaymentsNotification() {
        $.ajax({
            url: 'functions/load-payments-notification.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#userPaymentsManagerNotification').html(response);
            },
            error: function () {
                $('#userPaymentsManagerNotification').html('<p class="error-message"></p>');
            }
        });
    }

    loadPaymentsNotification();

    setInterval(loadPaymentsNotification, 30000);
});


function showPaymentInfo(id) {
	document.getElementById('overlayBg').classList.add('active');
	document.getElementById('paymentInfo').classList.add('active');
}

function hidePaymentInfo(id) {
	document.getElementById('overlayBg').classList.remove('active');
	document.getElementById('paymentInfo').classList.remove('active');
}

$(document).ready(function () {
	
    function loadPaymentInfo() {
		
		let activePaymentInfoCardIds = [];
        $('.payment-info.active').each(function () {
            activePaymentInfoCardIds.push($(this).attr('id'));
        });
		
        $.ajax({
            url: 'functions/load-payments-payment-info.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#paymentInfoContainer').html(response);
				
				 activePaymentInfoCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				
            },
            error: function () {
                $('#paymentInfoContainer').html('<p class="error-message"></p>');
            }
        });
    }

    loadPaymentInfo();

    setInterval(loadPaymentInfo, 30000);
});

function showCollectionInfo(id) {
	document.getElementById('overlayBg').classList.add('active');
	document.getElementById('collectionInfo').classList.add('active');
}

function hideCollectionInfo(id) {
	document.getElementById('overlayBg').classList.remove('active');
	document.getElementById('collectionInfo').classList.remove('active');
}

$(document).ready(function () {
	
    function loadCollectionInfo() {
		
		let activeCollectionInfoCardIds = [];
        $('.collection-info.active').each(function () {
            activeCollectionInfoCardIds.push($(this).attr('id'));
        });
		
        $.ajax({
            url: 'functions/load-payments-collection-info.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#collectionInfoContainer').html(response);
				
				 activeCollectionInfoCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				
            },
            error: function () {
                $('#collectionInfoContainer').html('<p class="error-message"></p>');
            }
        });
    }

    loadCollectionInfo();

    setInterval(loadCollectionInfo, 30000);
});