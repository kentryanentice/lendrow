<?php 
include '../php/admin-session.php';
include '../php/admin-account-wallet-cashout-request-functions.php';

	$searchCashoutRequest = isset($_GET['searchCashoutRequest']) ? $_GET['searchCashoutRequest'] : '';
	$cashoutRequests = getCashoutRequest($connection, $searchCashinRequest = '');
	
	foreach ($cashoutRequests as $cashout) {
		if ($cashout['status'] == 'Pending' && $cashout['method'] == 'CashOut') {
    ?>
		<span class="notification-dot"></span>
<?php
	}
}	
?>