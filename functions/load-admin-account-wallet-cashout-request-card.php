<?php
include '../php/admin-session.php';
include '../php/admin-virtual-wallet-functions.php';
include '../php/admin-account-wallet-cashin-request-functions.php';
include '../php/admin-account-wallet-cashout-request-functions.php';

		$searchCashoutRequest = isset($_GET['searchCashoutRequest']) ? $_GET['searchCashoutRequest'] : '';
		$cashoutRequests = getCashoutRequest($connection, $searchCashoutRequest = '');
							
		foreach ($cashoutRequests as $cashout) {
		$id = $cashout['id'];
		
		if ($cashout['method'] == 'CashOut') {
		?>
		<div class="cashout-card" id="cashOutCard<?php echo htmlspecialchars($cashout['id']); ?>">
			<h2>Cash Out Information</h2>
			
			<form action="php/admin-account-wallet-verify-cashout" method="POST" id="cashout-card-form" enctype="multipart/form-data" novalidate>
			
			<div class="cashout-card-input">
			<?php
				if ($cashout['status'] == 'Approved') {
			?>
			<br/>
			<?php
				}
			?>
			
			<input type="hidden" name="id" value="<?php echo htmlspecialchars($cashout['id']); ?>" readonly>
			
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
				<label><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($cashout['updated_at']))); ?></label>
			</div>
			
			<div class="info">
				<label>Name : </label><input type="text" name="receiver" value="<?php echo htmlspecialchars($cashout['fullname']); ?>" readonly>
			</div>
			
			<div class="info">
				<label>Cash Out Method : </label><input type="text" value="<?php echo htmlspecialchars($cashout['payment_method']); ?>" readonly>
			</div>
			
			<div class="info">
				<label>Cash Out Amount : </label><input type="text" name="amount" id="amount" value="<?php echo htmlspecialchars($cashout['amount']); ?>" readonly>
			</div>
			
			<div class="info">
				<label>Payment No : </label><input type="text" name="mobile" value="<?php echo htmlspecialchars($cashout['payment_number']); ?>" readonly>
			</div>
			
			<?php
				if ($cashout['status'] == 'Approved') {
			?>
			<br/>
			<div class="info">
				<label>Cash Out Receipt : </label><span class="label">Insert a Receipt(less than 2MB)</span>
				<input class="file" type="file" placeholder="Cash Out Receipt" name="receipt" id="receipt-<?php echo htmlspecialchars($cashout['id']);?>" oninput="validateReceipt(<?php echo htmlspecialchars($cashout['id']);?>)">
				<span id="receipt-error-<?php echo htmlspecialchars($cashout['id']);?>" class="receipt-error-message"></span>
			</div>
			
			<div class="info">
			</div>
			
			<?php
				}
			?>
			
			
			<?php
				if ($cashout['status'] == 'Pending' || $cashout['status'] == 'Rejected' || $cashout['status'] == 'Deducted') {
			?>
			<div class="info">
				<label>Account Name : </label><input type="text" value="<?php echo htmlspecialchars($cashout['payment_account_name']); ?>" readonly>
			</div>
			
			<div class="info">
				<label>Receipt : </label>
			</div>
			
			<div class="receipt" onclick="showCashoutReceipt(<?php echo htmlspecialchars($cashout['id']);?>)">
			<?php
				if (!empty($cashout['receipt'])) {
				$receiptPath = './/' . htmlspecialchars($cashout['receipt']);
					echo '<img src="' . $receiptPath . '" alt="Receipt">';
				} else {
					echo '<img src="pictures/logo.png" alt="No Cash In Receipt">';
				}
				?>
			</div>
			<?php
				}
			?>
			
			</div>
			
			<span id="receipt-empty-error-<?php echo htmlspecialchars($cashout['id']);?>" class="receipt-empty-message"></span>
			
			<?php
			if ($cashout['status'] == 'Pending' && $cashout['method'] == 'CashOut') {
			?>
				<div class="cashout-card-button">
					<div class="close" onclick="hideCashoutInfo(<?php echo htmlspecialchars($cashout['id']); ?>)">Close</div>
					<button type="submit" name="reject" class="reject">Reject</button>
					<button type="submit" name="approve" class="approve">Approve</button>
				</div>
			<?php
				} elseif ($cashout['status'] == 'Approved' && $cashout['method'] == 'CashOut') {
			?>
				<div class="cashout-card-button">
					<div class="close" onclick="hideCashoutInfo(<?php echo htmlspecialchars($cashout['id']); ?>)">Close</div>
					<button type="submit" name="reject" class="reject">Reject</button>
					<button type="submit" name="cashout" class="approve">Cash Out</button>
				</div>
			<?php
				} elseif ($cashout['status'] == 'Rejected' && $cashout['method'] == 'CashOut') {
			?>
				<div class="cashout-card-button2">
					<div class="close" onclick="hideCashoutInfo(<?php echo htmlspecialchars($cashout['id']); ?>)">Close</div>
				</div>
			<?php
				} elseif ($cashout['status'] == 'Deducted' && $cashout['method'] == 'CashOut') {
			?>
				<div class="cashout-card-button2">
					<div class="close" onclick="hideCashoutInfo(<?php echo htmlspecialchars($cashout['id']); ?>)">Close</div>
				</div>
			<?php
			}
			?>
			
			</form>
			
			<?php
				if ($cashout['status'] == 'Pending' || $cashout['status'] == 'Rejected' || $cashout['status'] == 'Deducted') {
			?>
			
			<div class="overlaycashoutbg" id="overlayCashoutBg<?php echo htmlspecialchars($cashout['id']); ?>"></div>
			
			<div class="cashout-card-receipt" id="cashOutReceipt<?php echo htmlspecialchars($cashout['id']);?>">
				<div class="cashout-card-receipt-title">Cash Out Receipt<i class='bx bxs-message-square-x' onclick="hideCashoutReceipt(<?php echo htmlspecialchars($cashout['id']);?>)"></i></div>
					<?php
						if (!empty($cashout['receipt'])) {
							$receiptPath = './/' . htmlspecialchars($cashout['receipt']);
								echo '<img src="' . $receiptPath . '" alt="Receipt">';
						} else {
							echo '<img src="pictures/logo.png" alt="No Cash In Receipt">';
						}
					?>
			</div>
			<?php
				}
			?>
			
		</div>
	<?php
		}
	}
	?>