window.onload = function () {
    const navigation = document.querySelector(".navigation");
    const menu = document.querySelector("#btn");

    menu.addEventListener("click", function () {
        navigation.classList.toggle("open");
        menuChange();
    })

    function menuChange() {
        if (navigation.classList.contains("open")) {
            menu.classList.toggle("active");
        } else {
            menu.classList.toggle("active");
        }
    }

    let list = document.querySelectorAll('.navigation li');

		function activelink() {
		const list = document.querySelectorAll('.navigation li');
		const currentFileName = window.location.href.split('/').pop().split('?')[0];
		
		list.forEach(item => {
			item.classList.remove('active');
			if (item.id === currentFileName) {
				item.classList.add('active');
			}
		});
	}

    list.forEach((item) => {
        item.addEventListener('click', activelink);
    });

    activelink();
}

document.addEventListener('DOMContentLoaded', () => {
    const icon = document.querySelector('.name .icon');
    const infoText = document.querySelector('.name p');

    icon.addEventListener('click', () => {
        if (infoText.style.visibility === 'visible') {
            infoText.style.visibility = 'hidden';
            infoText.style.opacity = '0';
        } else {
            infoText.style.visibility = 'visible';
            infoText.style.opacity = '1';
        }
    });
});

$(document).ready(function () {
    function loadLendersNotification() {
        $.ajax({
            url: 'functions/load-lenders-notification.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#lendersNotification').html(response);
            },
            error: function () {
                $('#lendersNotification').html('<p class="error-message"></p>');
            }
        });
    }

    loadLendersNotification();

    setInterval(loadLendersNotification, 30000);
});

$(document).ready(function () {
    function loadBorrowersNotification() {
        $.ajax({
            url: 'functions/load-borrowers-notification.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#borrowersNotification').html(response);
            },
            error: function () {
                $('#borrowersNotification').html('<p class="error-message"></p>');
            }
        });
    }

    loadBorrowersNotification();

    setInterval(loadBorrowersNotification, 30000);
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
                $('#paymentsNotification').html(response);
            },
            error: function () {
                $('#paymentsNotification').html('<p class="error-message"></p>');
            }
        });
    }

    loadPaymentsNotification();

    setInterval(loadPaymentsNotification, 30000);
});