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
    function loadAdminAccountsNotification() {
        $.ajax({
            url: 'functions/load-admin-accounts-notification.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                $('#adminAccountsNotification').html(response);
            },
            error: function () {
                $('#adminAccountsNotification').html('<p class="error-message"></p>');
            }
        });
    }

    loadAdminAccountsNotification();

    setInterval(loadAdminAccountsNotification, 30000);
});

$(document).ready(function () {
    function loadAdminAccountWalletNotification() {
        $.ajax({
            url: 'functions/load-admin-account-wallet-notification.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#adminAccountWalletNotification').html(response);
            },
            error: function () {
                $('#adminAccountWalletNotification').html('<p class="error-message"></p>');
            }
        });
    }

    loadAdminAccountWalletNotification();

    setInterval(loadAdminAccountWalletNotification, 30000);
});

$(document).ready(function () {
    function loadAdminLendersNotification() {
        $.ajax({
            url: 'functions/load-admin-lenders-notification.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#adminLendersNotification').html(response);
            },
            error: function () {
                $('#adminLendersNotification').html('<p class="error-message"></p>');
            }
        });
    }

    loadAdminLendersNotification();

    setInterval(loadAdminLendersNotification, 30000);
});

$(document).ready(function () {
    function loadAdminBorrowersNotification() {
        $.ajax({
            url: 'functions/load-admin-borrowers-notification.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#adminBorrowersNotification').html(response);
            },
            error: function () {
                $('#adminBorrowersNotification').html('<p class="error-message"></p>');
            }
        });
    }

    loadAdminBorrowersNotification();

    setInterval(loadAdminBorrowersNotification, 30000);
});

$(document).ready(function () {
    function loadAdminPaymentsNotification() {
        $.ajax({
            url: 'functions/load-admin-payments-notification.php',
            type: 'GET',
            cache: false,
            success: function (response) {
                if (response.includes('<html') || response.includes('<!DOCTYPE')) {
                    console.error('Unexpected HTML response (possible redirect).');
                    return;
                }
                $('#adminPaymentsNotification').html(response);
            },
            error: function () {
                $('#adminPaymentsNotification').html('<p class="error-message"></p>');
            }
        });
    }

    loadAdminPaymentsNotification();

    setInterval(loadAdminPaymentsNotification, 30000);
});