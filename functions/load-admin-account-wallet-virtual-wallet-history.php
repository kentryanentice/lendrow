<?php 
include '../php/admin-session.php';
include '../php/admin-virtual-wallet-functions.php';

	$searchWallet = isset($_GET['searchWallet']) ? $_GET['searchWallet'] : '';
	$adminWallet = getAdminWallet($connection, $searchWallet = '');
	
	foreach ($adminWallet as $adminWallet) {
	$virtualWalletId = $adminWallet['id'];

	$searchVirtualWalletHistory = isset($_GET['searchVirtualWalletHistory']) ? $_GET['searchVirtualWalletHistory'] : '';
	$adminWalletHistory = getAdminWalletHistory($connection, $virtualWalletId, $searchVirtualWalletHistory = '');
							
	if (empty($adminWalletHistory)) {
		echo '<p class="empty" id="loading"><span class="animated-dots">Virtual Transaction History is currently empty<span class="dots"></span></span></p>';
	} else {
		foreach ($adminWalletHistory as $virtualHistory) {
			$virtualWalletId = $virtualHistory['admin_wallet_id'];
		
	if ($virtualHistory['status'] == 'Pending' && $virtualHistory['method'] == 'Virtual CashIn') {
?>

		<div class="admin-virtual-history">
			<div class="pending"></div>
			<span><i class='bx bxs-alarm-exclamation'></i></span>
			<p><?php echo htmlspecialchars($virtualHistory['status']); ?> ₱<?php echo htmlspecialchars($virtualHistory['amount']); ?> <?php echo htmlspecialchars($virtualHistory['method']); ?>!<br><?php echo htmlspecialchars($virtualHistory['method']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($virtualHistory['updated_at']))); ?></p>	
			<div class="view-button">
				<div class="view" onclick="viewConfirmVirtualMoney(<?php echo htmlspecialchars($virtualHistory['id']); ?>)">View</div>
			</div>
		</div>
		
	<?php
	} elseif ($virtualHistory['status'] == 'Cancelled' && $virtualHistory['method'] == 'Virtual CashIn') {
	?>
						
	<div class="admin-virtual-history">
		<div class="rejected"></div>
		<span><i class='bx bxs-x-circle'></i></span>			
		<p><?php echo htmlspecialchars($virtualHistory['status']); ?> ₱<?php echo htmlspecialchars($virtualHistory['amount']); ?> <?php echo htmlspecialchars($virtualHistory['method']); ?>!<br><?php echo htmlspecialchars($virtualHistory['method']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($virtualHistory['updated_at']))); ?></p>
	</div>
	
	<?php
	} elseif ($virtualHistory['status'] == 'Added' && $virtualHistory['method'] == 'Virtual CashIn') {
	?>
						
	<div class="admin-virtual-history">
		<div class="added"></div>	
		<span class="added-virtual-cashin"><i class='bx bxs-check-circle'></i></span>			
		<p>₱<?php echo htmlspecialchars($virtualHistory['amount']); ?> has been <?php echo htmlspecialchars($virtualHistory['status']); ?> to your Virtual Wallet! <br><?php echo htmlspecialchars($virtualHistory['method']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($virtualHistory['updated_at']))); ?></p>		
	</div>
	
	<?php
	} elseif ($virtualHistory['status'] == 'Deducted' && $virtualHistory['method'] == 'CashIn') {
	?>
						
	<div class="admin-virtual-history">
		<div class="approved"></div>
		<span><i class='bx bxs-check-circle'></i></span>
		<p>₱<?php echo htmlspecialchars($virtualHistory['amount']); ?> has been <?php echo htmlspecialchars($virtualHistory['status']); ?> from your Virtual Wallet! <br><?php echo htmlspecialchars($virtualHistory['method']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($virtualHistory['updated_at']))); ?></p>	
	</div>
	
	<?php
	} elseif ($virtualHistory['status'] == 'Added' && $virtualHistory['method'] == 'CashOut') {
	?>
						
	<div class="admin-virtual-history">
		<div class="approved"></div>
		<span class="added-virtual-cashin"><i class='bx bxs-check-circle'></i></span>				
		<p>₱10.00 from ₱<?php echo htmlspecialchars($virtualHistory['amount']); ?> has been <?php echo htmlspecialchars($virtualHistory['status']); ?> to your Virtual Wallet! <br><?php echo htmlspecialchars($virtualHistory['method']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($virtualHistory['updated_at']))); ?></p>	
	</div>
	
		<?php
			}
		}
	}
}
?>