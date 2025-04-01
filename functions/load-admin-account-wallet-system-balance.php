<?php
include '../php/admin-session.php';
include '../php/admin-virtual-wallet-functions.php';

	$searchRequest = isset($_GET['searchRequest']) ? $_GET['searchRequest'] : '';
	$adminWalletData = getAdminWallet($connection, $searchRequest);
	
	if (empty($adminWalletData)) {
		echo '<input type="text" id="balance" placeholder="0.00" readonly>';
	} else {
							
		foreach ($adminWalletData as $wallet) {
	?>
	
		<input type="text" id="balance" placeholder="<?php echo htmlspecialchars($wallet["system_balance"]); ?>" readonly>
	
<?php
	}
}
?>