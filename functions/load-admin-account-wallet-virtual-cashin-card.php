<?php	
include '../php/admin-session.php';
include '../php/admin-virtual-wallet-functions.php';
include '../php/admin-account-wallet-cashin-request-functions.php';
include '../php/admin-account-wallet-cashout-request-functions.php';
	
		$searchWallet = isset($_GET['searchWallet']) ? $_GET['searchWallet'] : '';
		$adminWallet = getAdminWallet($connection, $searchWallet = '');
								
		foreach ($adminWallet as $adminWallet) {
		$virtualWalletId = $adminWallet['id'];

		$searchVirtualWalletHistory = isset($_GET['searchVirtualWalletHistory']) ? $_GET['searchVirtualWalletHistory'] : '';
		$adminWalletHistory = getAdminWalletHistory($connection, $virtualWalletId, $searchVirtualWalletHistory = '');
								
		foreach ($adminWalletHistory as $virtualHistory) {
		$virtualWalletId = $virtualHistory['admin_wallet_id'];
			
	?>
			
			<div class="confirm-virtual-cashin-form" id="confirmVirtualMoney<?php echo htmlspecialchars($virtualHistory['id']);?>">
			<h2>Confirm Virtual Money Form</h2>
				<form action="php/confirm-virtual-money" method="POST" enctype="multipart/form-data">
				
				<input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($virtualHistory['id']); ?>" readonly>
				
				<div class="confirm-admin-input">
				<div class="inputBox">
					<i class='bx bxs-user'></i>
					<input type="text" name="name" id="name" value="<?php echo htmlspecialchars($adminWallet['admin_wallet_name']); ?>" readonly>
				</div>
														
				<div class="inputBox">
					<i class='bx bxl-product-hunt'></i>
					<input type="text" name="amount" id="amount" value="<?php echo htmlspecialchars($virtualHistory['amount']); ?>" readonly>
				</div>
				</div>

				<div class="virtual-cashin-button">
				
				<?php
					if ($virtualHistory['status'] === 'Pending') {
				?>
					<div class="close" onclick="hideConfirmVirtualMoney(<?php echo htmlspecialchars($virtualHistory['id']); ?>)">Close</div>
					<button type="submit" name="cancel" class="cancel">Cancel</button>
					<button type="submit" name="confirm" class="confirm">Confirm</button>
					
				<?php
					}  elseif ($virtualHistory['status'] === 'Cancelled') {
				?>
					<div class="close" onclick="hideConfirmVirtualMoney(<?php echo htmlspecialchars($virtualHistory['id']); ?>)">Close</div>
				<?php 
					} elseif ($virtualHistory['status'] === 'Added') {
				?>
					<div class="close" onclick="hideConfirmVirtualMoney(<?php echo htmlspecialchars($virtualHistory['id']); ?>)">Close</div>
				<?php 
				}
				?>
				
				</div>
				
				</form>
			</div>

	<?php
		}
	}
	?>