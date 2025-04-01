<?php 
include '../php/admin-session.php';
include '../php/admin-virtual-wallet-functions.php';

	$searchWallet = isset($_GET['searchWallet']) ? $_GET['searchWallet'] : '';
	$adminWallet = getAdminWallet($connection, $searchWallet = '');
							
	foreach ($adminWallet as $adminWallet) {
	$virtualWalletId = $adminWallet['id'];

	$searchVirtualWalletHistory = isset($_GET['searchVirtualWalletHistory']) ? $_GET['searchVirtualWalletHistory'] : '';
	$adminWalletHistory = getAdminWalletHistory($connection, $virtualWalletId, $searchVirtualWalletHistory = '');

	foreach ($adminWalletHistory as $virtualHistory) {
	$virtualWalletId = $virtualHistory['admin_wallet_id'];
		
	if ($virtualHistory['status'] == 'Pending' && $virtualHistory['method'] == 'Virtual CashIn') {
	?>
	
		<span class="notification-dot"></span>
<?php
		}
	}
}	
?>