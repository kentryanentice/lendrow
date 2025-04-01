<?php
include '../php/admin-session.php';
include '../php/admin-account-wallet-cashin-request-functions.php';
include '../php/admin-account-wallet-cashout-request-functions.php';
include '../php/admin-account-wallet-virtual-money-functions.php';

$searchRequest = isset($_GET['searchRequest']) ? $_GET['searchRequest'] : '';

$cashinRequests = getCashinRequest($connection, $searchRequest);
$cashoutRequests = getCashoutRequest($connection, $searchRequest);
$virtualRequests = getVirtualRequest($connection, $searchRequest);

foreach ($cashinRequests as $cashin) {
    if ($cashin['status'] == 'Pending' && $cashin['method'] == 'CashIn') {
        echo '<span class="notification-dot"></span>';
    }
}

foreach ($cashoutRequests as $cashout) {
    if ($cashout['status'] == 'Pending' && $cashout['method'] == 'CashOut') {
        echo '<span class="notification-dot"></span>';
    }
}

foreach ($virtualRequests as $virtual) {
    if ($virtual['status'] == 'Pending' && $virtual['method'] == 'Virtual CashIn') {
        echo '<span class="notification-dot"></span>';
    }
}
?>
