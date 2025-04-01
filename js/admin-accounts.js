$(document).ready(function () {
    var swiper;

    function loadUsersData() {
        Promise.all([
            $.ajax({
            url: 'functions/load-admin-account-users-account-card.php',
            type: 'GET',
            cache: false
        }),])
        .then(function (response) {
            if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                console.error('Unexpected HTML response (possible redirect).');
                return;
            }
            $('#cardContainer').html(response);

			if (!swiper) {
                swiper = new Swiper('#accountSlide .slide-content', {
                    slidesPerView: 3,
                    spaceBetween: 25,
                    slidesPerGroup: 3,
                    centerSlide: 'true',
                    fade: 'true',
                    grabCursor: 'true',
                    loopFillGroupWithBlank: false,
                    pagination: {
                        el: '#accountSlide .swiper-pagination',
                        clickable: true,
                        dynamicBullets: true,
                    },
                    navigation: {
                        nextEl: '#accountSlide .swiper-button-next',
                        prevEl: '#accountSlide .swiper-button-prev',
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 1,
                        },
                        520: {
                            slidesPerView: 2,
                        },
                        950: {
                            slidesPerView: 3,
                        },
                    },
                });
            } else {
                swiper.update();
            }
        })
        .catch(function () {
            $('#cardContainer').html('<p class="empty-users" id="loading"><span class="animated-dots">Loading users account<span class="dots"></span></span></p>');
        });
    }

    loadUsersData();
    setInterval(loadUsersData, 20000);
});

function showAccountsCard(id) {
	document.getElementById('overlayBg').classList.add('active');
	document.getElementById('accountsCard' + id).classList.add('active');
}

function hideAccountsCard(id) {
	document.getElementById('overlayBg').classList.remove('active');
	document.getElementById('accountsCard' + id).classList.remove('active');
}

function showPrimaryID(id) {
	document.getElementById('overlayAccountsBg' + id).classList.add('active');
	document.getElementById('primaryID' + id).classList.add('active');
}

function hidePrimaryID(id) {
	document.getElementById('overlayAccountsBg' +id).classList.remove('active');
	document.getElementById('primaryID' + id).classList.remove('active');
}

function showPrimaryID2(id) {
	document.getElementById('overlayAccountsBg' + id).classList.add('active');
	document.getElementById('primaryID2' + id).classList.add('active');
}

function hidePrimaryID2(id) {
	document.getElementById('overlayAccountsBg' +id).classList.remove('active');
	document.getElementById('primaryID2' + id).classList.remove('active');
}

function showVerify(id) {
	document.getElementById('overlayAccountsBg' + id).classList.add('active');
	document.getElementById('verifyAcccount' + id).classList.add('active');
}

function hideVerify(id) {
	document.getElementById('overlayAccountsBg' +id).classList.remove('active');
	document.getElementById('verifyAcccount' + id).classList.remove('active');
}

$(document).ready(function () {
	
    function loadUsersIdData() {
		
		let activeOverlayCardIds = [];
        $('.overlayAccountsBg.active').each(function () {
            activeOverlayCardIds.push($(this).attr('id'));
        });
		
		let activeUsersCardIds = [];
        $('.accounts-card.active').each(function () {
            activeUsersCardIds.push($(this).attr('id'));
        });
		
		let activeUsersIdCardIds = [];
        $('.accounts-id.active').each(function () {
            activeUsersIdCardIds.push($(this).attr('id'));
        });
		
        $.ajax({
            url: 'functions/load-admin-account-users-account-id-card.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#idContainer').html(response);
				
				activeOverlayCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				 activeUsersCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
				 activeUsersIdCardIds.forEach(function (cardId) {
                    $(`#${cardId}`).addClass('active');
                });
				
            },
            error: function () {
                $('#idContainer').html('<p class="error-message"></p>');
            }
        });
    }

    loadUsersIdData();

    setInterval(loadUsersIdData, 20000);
});

