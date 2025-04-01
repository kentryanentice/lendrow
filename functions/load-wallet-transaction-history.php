<?php
include '../php/user-session.php';
include '../php/wallet-functions.php';	

	$searchTransactions = isset($_GET['searchTransactions']) ? $_GET['searchTransactions'] : '';
	$transactions = getTransactions($connection, $userId, $searchTransactions = '');
							
	if (empty($transactions)) {
		echo '<p class="empty" id="loading"><span class="animated-dots">Transaction History is currently empty<span class="dots"></span></span></p>';
	} else {
		foreach ($transactions as $transaction) {
		$receiverWalletId = $transaction['receiver_wallet_id'];
		$senderWalletId = $transaction['sender_wallet_id'];

		
		if ($transaction['transfer_method'] == 'Lending' && $receiverWalletId == $userId) {
	?>	
							
		<div class="user-history">
			<div class="approved"></div>
			<i class='bx bxs-check-circle' ></i>					
			<p>₱<?php echo htmlspecialchars($transaction['amount']); ?> has been Deducted from your Wallet!<br><?php echo htmlspecialchars($transaction['transfer_method']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($transaction['created_at']))); ?></p>								
		
		</div>

	<?php
		} elseif ($transaction['transfer_method'] == 'Refunded' && $receiverWalletId == $userId) {
	?>
							
		<div class="user-history">
			<div class="approved"></div>
			<i class='bx bxs-check-circle'></i>				
			<p><?php echo htmlspecialchars($transaction['sender']); ?> <?php echo htmlspecialchars($transaction['transfer_method']); ?> ₱<?php echo htmlspecialchars($transaction['amount']); ?> to your Wallet!<br>Rejected CashOut at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($transaction['created_at']))); ?></p>		
			
		</div>

	<?php
		} elseif ($transaction['transfer_method'] == 'Added' && $receiverWalletId == $userId) {
	?>	
							
		<div class="user-history">
			<div class="added"></div>
			<span class="added-cashin"><i class='bx bxs-check-circle' ></i></span>					
			<p><?php echo htmlspecialchars($transaction['sender']); ?> <?php echo htmlspecialchars($transaction['transfer_method']); ?> ₱<?php echo htmlspecialchars($transaction['amount']); ?> to your Wallet!<br> CashIn at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($transaction['created_at']))); ?></p>								
		
		</div>

	<?php
		} elseif ($transaction['transfer_method'] == 'Deducted' && $receiverWalletId == $userId) {
	?>
							
		<div class="user-history">
			<div class="deducted"></div>
			<i class='bx bxs-minus-circle' ></i>					
			<p><?php echo htmlspecialchars($transaction['sender']); ?> <?php echo htmlspecialchars($transaction['transfer_method']); ?> ₱<?php echo htmlspecialchars($transaction['amount']); ?> from your Wallet!<br>CashOut at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($transaction['created_at']))); ?></p>									
		
		</div>
		
	<?php
		}  elseif ($transaction['transfer_method'] == 'Disbursed' && $receiverWalletId == $userId) {
	?>
							
		<div class="user-history">
			<div class="added"></div>
			<span class="added-cashin"><i class='bx bxs-check-circle' ></i></span>					
			<p><?php echo htmlspecialchars($transaction['sender']); ?> <?php echo htmlspecialchars($transaction['transfer_method']); ?> ₱<?php echo htmlspecialchars($transaction['amount']); ?> to your Wallet!<br><?php echo htmlspecialchars($transaction['transfer_method']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($transaction['created_at']))); ?></p>									
		
		</div>
		
	<?php
		}  elseif ($transaction['transfer_method'] == 'Disbursed' && $senderWalletId == $userId) {
	?>
							
		<div class="user-history">
			<div class="added"></div>
			<span class="added-cashin"><i class='bx bxs-check-circle' ></i></span>					
			<p>You <?php echo htmlspecialchars($transaction['transfer_method']); ?> ₱<?php echo htmlspecialchars($transaction['amount']); ?> to <?php echo htmlspecialchars($transaction['receiver']); ?>!<br><?php echo htmlspecialchars($transaction['transfer_method']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($transaction['created_at']))); ?></p>									
		
		</div>
		
		<?php
			} elseif ($transaction['transfer_method'] == 'Paid' && $senderWalletId == $userId) {
	?>
							
		<div class="user-history">
			<div class="added"></div>
			<span class="added-cashin"><i class='bx bxs-check-circle' ></i></span>				
			<p>You <?php echo htmlspecialchars($transaction['transfer_method']); ?> ₱<?php echo htmlspecialchars($transaction['amount']); ?> to <?php echo htmlspecialchars($transaction['receiver']); ?>!<br><?php echo htmlspecialchars($transaction['transfer_method']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($transaction['created_at']))); ?></p>									
		
		</div>
		
		<?php
			} elseif ($transaction['transfer_method'] == 'Paid' && $receiverWalletId == $userId) {
	?>
							
		<div class="user-history">
			<div class="added"></div>
			<span class="added-cashin"><i class='bx bxs-check-circle' ></i></span>			
			<p><?php echo htmlspecialchars($transaction['sender']); ?> has <?php echo htmlspecialchars($transaction['transfer_method']); ?> ₱<?php echo htmlspecialchars($transaction['amount']); ?> Interest!<br><?php echo htmlspecialchars($transaction['transfer_method']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($transaction['created_at']))); ?></p>									
		
		</div>
		
		<?php
			}
		}
	}
?>