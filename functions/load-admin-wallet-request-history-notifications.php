<?php
include '../php/admin-session.php';
include '../php/admin-wallet-functions.php';

	$searchRequest = isset($_GET['searchRequest']) ? $_GET['searchRequest'] : '';
	$requests = getRequest($connection, $adminId, $searchRequest = '');
							
	foreach ($requests as $request) {
	$adminId = $request['wallet_id'];
		
	if ($request['status'] == 'Pending' && ($request['method'] == 'CashIn' || $request['method'] == 'CashOut')) {
	?>	
		<span class="notification-dot"></span>
<?php
		}
	}
?>