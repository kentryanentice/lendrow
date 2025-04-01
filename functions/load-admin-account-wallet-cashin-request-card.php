<?php
include '../php/admin-session.php';
include '../php/admin-virtual-wallet-functions.php';
include '../php/admin-account-wallet-cashin-request-functions.php';
include '../php/admin-account-wallet-cashout-request-functions.php';

	$searchCashinRequest = isset($_GET['searchCashinRequest']) ? $_GET['searchCashinRequest'] : '';
	$cashinRequests = getCashinRequest($connection, $searchCashinRequest = '');
							
		foreach ($cashinRequests as $cashin) {
		$id = $cashin['id'];
		
		if ($cashin['method'] == 'CashIn') {
	?>
		<div class="cashin-card" id="cashInCard<?php echo htmlspecialchars($cashin['id']); ?>">
			<h2>Cash In Information</h2>
			
			<form action="php/admin-account-wallet-verify-cashin" method="POST">
			
			<div class="cashin-card-input">
			
			<input type="hidden" name="id" value="<?php echo htmlspecialchars($cashin['id']); ?>" readonly>
			
			<?php		
			$searchWallet = isset($_GET['searchWallet']) ? $_GET['searchWallet'] : '';
			$adminWallet = getAdminWallet($connection, $searchWallet = '');
			
			if(empty($adminWallet)) {
				echo '<input type="hidden" name="adminname" value="None" readonly>';
			} else {
									
			foreach ($adminWallet as $adminWallet) {
			$virtualWalletId = $adminWallet['id'];
			?>
				<input type="hidden" name="adminname" value="<?php echo htmlspecialchars($adminWallet['admin_wallet_name']); ?>" readonly>
			<?php
				}
			}
			?>
			
			<div class="info1">
				<label><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($cashin['updated_at']))); ?></label>
			</div>
			
			<div class="info">
				<label>Name : </label><input type="text" name="receiver" value="<?php echo htmlspecialchars($cashin['fullname']); ?>" readonly>
			</div>
			
			<div class="info">
				<label>Cash In Method : </label><input type="text" value="<?php echo htmlspecialchars($cashin['payment_method']); ?>" readonly>
			</div>
			
			<div class="info">
				<label>Cash In Amount : </label><input type="text" name="amount" id="amount" value="<?php echo htmlspecialchars($cashin['amount']); ?>" readonly>
			</div>
			
			<div class="info">
				<label>Payment No : </label><input type="text" name="mobile" value="<?php echo htmlspecialchars($cashin['payment_number']); ?>" readonly>
			</div>
			
			<div class="info">
				<label>Account Name : </label><input type="text" value="<?php echo htmlspecialchars($cashin['payment_account_name']); ?>" readonly>
			</div>
			
			<div class="info">
				<label>Receipt : </label>
			</div>
			
			<div class="receipt" onclick="showCashinReceipt(<?php echo htmlspecialchars($cashin['id']);?>)">
			<?php
				if (!empty($cashin['receipt'])) {
				$receiptPath = './/' . htmlspecialchars($cashin['receipt']);
					echo '<img src="' . $receiptPath . '" alt="Receipt">';
				} else {
					echo '<img src="pictures/logo.png" alt="No Cash In Receipt">';
				}
				?>
			</div>
			
			</div>
			
			<?php
			if ($cashin['status'] == 'Pending' && $cashin['method'] == 'CashIn') {
			?>
				<div class="cashin-card-button">
					<div class="close" onclick="hideCashinInfo(<?php echo htmlspecialchars($cashin['id']); ?>)">Close</div>
					<button type="submit" name="reject" class="reject">Reject</button>
					<button type="submit" name="approve" class="approve">Approve</button>
				</div>
			<?php
				} elseif ($cashin['status'] == 'Approved' && $cashin['method'] == 'CashIn') {
			?>
				<div class="cashin-card-button">
					<div class="close" onclick="hideCashinInfo(<?php echo htmlspecialchars($cashin['id']); ?>)">Close</div>
					<button type="submit" name="reject" class="reject">Reject</button>
					<button type="submit" name="cashin" class="approve">Cash In</button>
				</div>
			<?php
				} elseif ($cashin['status'] == 'Rejected' && $cashin['method'] == 'CashIn') {
			?>
				<div class="cashin-card-button2">
					<div class="close" onclick="hideCashinInfo(<?php echo htmlspecialchars($cashin['id']); ?>)">Close</div>
				</div>
			<?php
				} elseif ($cashin['status'] == 'Added' && $cashin['method'] == 'CashIn') {
			?>
				<div class="cashin-card-button2">
					<div class="close" onclick="hideCashinInfo(<?php echo htmlspecialchars($cashin['id']); ?>)">Close</div>
				</div>
			<?php
				}
			?>
			
			</form>
			
			<div class="overlaycashinbg" id="overlayCashinBg<?php echo htmlspecialchars($cashin['id']); ?>"></div>
			
			<div class="cashin-card-receipt" id="cashInReceipt<?php echo htmlspecialchars($cashin['id']);?>">
				<div class="cashin-card-receipt-title">Cash In Receipt<i class='bx bxs-message-square-x' onclick="hideCashinReceipt(<?php echo htmlspecialchars($cashin['id']);?>)"></i></div>
					<?php
						if (!empty($cashin['receipt'])) {
							$receiptPath = './/' . htmlspecialchars($cashin['receipt']);
								echo '<img src="' . $receiptPath . '" alt="Receipt">';
						} else {
							echo '<img src="pictures/logo.png" alt="No Cash In Receipt">';
						}
					?>
			</div>
			
		</div>
	<?php
		}
	}
	?>