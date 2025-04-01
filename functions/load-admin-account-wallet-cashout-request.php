<?php 
include '../php/admin-session.php';
include '../php/admin-account-wallet-cashout-request-functions.php';

	$searchCashoutRequest = isset($_GET['searchCashoutRequest']) ? $_GET['searchCashoutRequest'] : '';
	$cashoutRequests = getCashoutRequest($connection, $searchCashoutRequest = '');
							
	$cashoutRequestsFiltered = array_filter($cashoutRequests, function($cashout) {
		return $cashout['method'] === 'CashOut';
	});

	if (empty($cashoutRequestsFiltered)) {
		echo '<p class="empty" id="loading"><span class="animated-dots">Cash Out Request is currently empty<span class="dots"></span></span></p>';
	} else {
		foreach ($cashoutRequestsFiltered as $cashout) {
			if ($cashout['status'] == 'Pending') {
	?>
						
	<div class="admin-history">
		<div class="pending"></div>
		<span><i class='bx bxs-alarm-exclamation'></i></span>
		<input type="hidden" placeholder="" disabled>					
		<input type="hidden" placeholder="" disabled>						
		<input type="hidden" placeholder="" disabled>						
		<p><?php echo htmlspecialchars($cashout['status']); ?> ₱<?php echo htmlspecialchars($cashout['amount']); ?> <?php echo htmlspecialchars($cashout['method']); ?> Request!<br><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($cashout['updated_at']))); ?></p>	
		<div class="view-button">
			<div class="view" onclick="viewCashoutInfo(<?php echo htmlspecialchars($cashout['id']); ?>)">View</div>
		</div>	
	</div>

	<?php
		} elseif ($cashout['status'] == 'Approved') {
	?>
						
	<div class="admin-history">
		<div class="approved"></div>
		<span><i class='bx bxs-check-circle'></i></span>
		<input type="hidden" placeholder="" disabled>					
		<input type="hidden" placeholder="" disabled>						
		<input type="hidden" placeholder="" disabled>						
		<p><?php echo htmlspecialchars($cashout['status']); ?> ₱<?php echo htmlspecialchars($cashout['amount']); ?> <?php echo htmlspecialchars($cashout['method']); ?> Request!<br><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($cashout['updated_at']))); ?></p>
		<div class="view-button">
			<div class="view" onclick="viewCashoutInfo(<?php echo htmlspecialchars($cashout['id']); ?>)">View</div>
		</div>	
	</div>

	<?php
		} elseif ($cashout['status'] == 'Rejected') {
	?>
						
	<div class="admin-history">
		<div class="rejected"></div>
		<span><i class='bx bxs-x-circle' ></i></span>
		<input type="hidden" placeholder="" disabled>					
		<input type="hidden" placeholder="" disabled>						
		<input type="hidden" placeholder="" disabled>						
		<p>₱<?php echo htmlspecialchars($cashout['amount']); ?> <?php echo htmlspecialchars($cashout['method']); ?> Request has been <?php echo htmlspecialchars($cashout['status']); ?>!<br><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($cashout['updated_at']))); ?></p>	
		<div class="view-button">
			<div class="view" onclick="viewCashoutInfo(<?php echo htmlspecialchars($cashout['id']); ?>)">View</div>
		</div>	
	</div>

	<?php
		} elseif ($cashout['status'] == 'Deducted') {
	?>
						
	<div class="admin-history">
		<div class="deducted"></div>
		<span class="deducted-cashout"><i class='bx bxs-check-circle' ></i></span>
		<input type="hidden" placeholder="" disabled>					
		<input type="hidden" placeholder="" disabled>						
		<input type="hidden" placeholder="" disabled>						
		<p>₱<?php $newAmount = $cashout['amount'] - 10; echo htmlspecialchars(number_format($newAmount, 2, '.', ',')); ?> has been <?php echo htmlspecialchars($cashout['status']); ?> from <?php echo htmlspecialchars($cashout['method']); ?> Request!<br><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($cashout['updated_at']))); ?></p>	
		<div class="view-button">
			<div class="view" onclick="viewCashoutInfo(<?php echo htmlspecialchars($cashout['id']); ?>)">View</div>
		</div>		
	</div>

	<?php
			}
		}
	}
?>