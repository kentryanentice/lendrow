<?php 
include '../php/admin-session.php';
include '../php/admin-account-wallet-cashin-request-functions.php';

	$searchCashinRequest = isset($_GET['searchCashinRequest']) ? $_GET['searchCashinRequest'] : '';
	$cashinRequests = getCashinRequest($connection, $searchCashinRequest = '');
							
	$cashinRequestsFiltered = array_filter($cashinRequests, function($cashin) {
		return $cashin['method'] === 'CashIn';
	});

	if (empty($cashinRequestsFiltered)) {
		echo '<p class="empty" id="loading"><span class="animated-dots">Cash In Request is currently empty<span class="dots"></span></span></p>';
	} else {
		foreach ($cashinRequestsFiltered as $cashin) {
			if ($cashin['status'] == 'Pending') {
	?>
						
	<div class="admin-history">
		<div class="pending"></div>
		<span><i class='bx bxs-alarm-exclamation'></i></span>		
		<p><?php echo htmlspecialchars($cashin['status']); ?> ₱<?php echo htmlspecialchars($cashin['amount']); ?> <?php echo htmlspecialchars($cashin['method']); ?> Request!<br><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($cashin['updated_at']))); ?></p>	
		<div class="view-button">
			<div class="view" onclick="viewCashinInfo(<?php echo htmlspecialchars($cashin['id']); ?>)">View</div>
		</div>
	</div>

	<?php
	} elseif ($cashin['status'] == 'Approved') {
	?>
						
	<div class="admin-history">
		<div class="approved"></div>
		<span><i class='bx bxs-check-circle'></i></span>					
		<p><?php echo htmlspecialchars($cashin['status']); ?> ₱<?php echo htmlspecialchars($cashin['amount']); ?> <?php echo htmlspecialchars($cashin['method']); ?> Request!<br><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($cashin['updated_at']))); ?></p>	
		<div class="view-button">
			<div class="view" onclick="viewCashinInfo(<?php echo htmlspecialchars($cashin['id']); ?>)">View</div>
		</div>	
	</div>

	<?php
		} elseif ($cashin['status'] == 'Rejected') {
	?>
						
	<div class="admin-history">
		<div class="rejected"></div>
		<span><i class='bx bxs-x-circle' ></i></span>		
		<p>₱<?php echo htmlspecialchars($cashin['amount']); ?> <?php echo htmlspecialchars($cashin['method']); ?> Request has been <?php echo htmlspecialchars($cashin['status']); ?>!<br><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($cashin['updated_at']))); ?></p>
		<div class="view-button">
			<div class="view" onclick="viewCashinInfo(<?php echo htmlspecialchars($cashin['id']); ?>)">View</div>
		</div>	
	</div>

	<?php
		} elseif ($cashin['status'] == 'Added') {
	?>
						
	<div class="admin-history">
		<div class="added"></div>
		<span class="added-cashin"><i class='bx bxs-check-circle'></i></span>			
		<p>₱<?php echo htmlspecialchars($cashin['amount']); ?> has been <?php echo htmlspecialchars($cashin['status']); ?> to a <?php echo htmlspecialchars($cashin['method']); ?> Request!<br><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($cashin['updated_at']))); ?></p>	
		<div class="view-button">
			<div class="view" onclick="viewCashinInfo(<?php echo htmlspecialchars($cashin['id']); ?>)">View</div>
		</div>	
	</div>

	<?php
			}
		}
	}
?>