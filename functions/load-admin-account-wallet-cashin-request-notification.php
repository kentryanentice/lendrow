<?php 
include '../php/admin-session.php';
include '../php/admin-account-wallet-cashin-request-functions.php';

	$searchCashinRequest = isset($_GET['searchCashinRequest']) ? $_GET['searchCashinRequest'] : '';
	$cashinRequests = getCashinRequest($connection, $searchCashinRequest = '');
	
	foreach ($cashinRequests as $cashin) {
		if ($cashin['status'] == 'Pending' && $cashin['method'] == 'CashIn') {
    ?>
		<span class="notification-dot"></span>
<?php
	} 
}	
?>