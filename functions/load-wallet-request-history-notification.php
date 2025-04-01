<?php
include '../php/user-session.php';
include '../php/wallet-functions.php';

	$searchRequest = isset($_GET['searchRequest']) ? $_GET['searchRequest'] : '';
	$requests = getRequest($connection, $userId, $searchRequest = '');
							
	foreach ($requests as $request) {
	$userId = $request['wallet_id'];
		
	if ($request['status'] == 'Pending' && ($request['method'] == 'CashIn' || $request['method'] == 'CashOut')) {
	?>	
		<span class="notification-dot"></span>
<?php
		}
	}
?>