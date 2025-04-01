<?php
include '../php/user-session.php';
include '../php/wallet-functions.php';

	$searchRequest = isset($_GET['searchRequest']) ? $_GET['searchRequest'] : '';
	$requests = getRequest($connection, $userId, $searchRequest = '');
							
	if (empty($requests)) {
		echo '<p class="empty" id="loading"><span class="animated-dots">Request History is currently empty<span class="dots"></span></span></p>';
	} else {
		foreach ($requests as $request) {
		$userId = $request['wallet_id'];
		
	if ($request['status'] == 'Pending' && $request['method'] == 'CashIn') {
	?>

		<div class="user-history">
			<div class="pending"></div>
			<i class='bx bxs-alarm-exclamation'></i>
			<input type="hidden" placeholder="" disabled>					
			<input type="hidden" placeholder="" disabled>						
			<input type="hidden" placeholder="" disabled>						
			<p>You had a <?php echo htmlspecialchars($request['status']); ?> ₱<?php echo htmlspecialchars($request['amount']); ?> <?php echo htmlspecialchars($request['method']); ?> Request!<br><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($request['updated_at']))); ?></p>
			
			<div class="view-button">
				<div class="view" onclick="showRequestCard(<?php echo htmlspecialchars($request['id']); ?>)">View</div>
			</div>
			
		</div>
		
	<?php
		} elseif ($request['status'] == 'Pending' && $request['method'] == 'CashOut') {
	?>
					
		<div class="user-history">
			<div class="pending"></div>
			<i class='bx bxs-alarm-exclamation'></i>
			<input type="hidden" placeholder="" disabled>					
			<input type="hidden" placeholder="" disabled>						
			<input type="hidden" placeholder="" disabled>						
			<p>You had a <?php echo htmlspecialchars($request['status']); ?> ₱<?php echo htmlspecialchars($request['amount']); ?> <?php echo htmlspecialchars($request['method']); ?> Request!<br><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($request['updated_at']))); ?></p>
			
			<div class="view-button">
				<div class="view" onclick="showRequestCard(<?php echo htmlspecialchars($request['id']); ?>)">View</div>
			</div>
			
		</div>

	<?php
	} elseif ($request['status'] == 'Approved' && $request['method'] == 'CashIn') {
	?>
							
		<div class="user-history">
			<div class="approved"></div>
			<i class='bx bxs-check-circle'></i>
			<input type="hidden" placeholder="" disabled>					
			<input type="hidden" placeholder="" disabled>						
			<input type="hidden" placeholder="" disabled>						
			<p>Your ₱<?php echo htmlspecialchars($request['amount']); ?> <?php echo htmlspecialchars($request['method']); ?> Request has been <?php echo htmlspecialchars($request['status']); ?>!<br><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($request['updated_at']))); ?></p>

			<div class="view-button">
				<div class="view" onclick="showRequestCard(<?php echo htmlspecialchars($request['id']); ?>)">View</div>
			</div>
		
		</div>

	<?php
		} elseif ($request['status'] == 'Approved' && $request['method'] == 'CashOut') {
	?>
							
		<div class="user-history">
			<div class="approved"></div>
			<i class='bx bxs-check-circle'></i>
			<input type="hidden" placeholder="" disabled>					
			<input type="hidden" placeholder="" disabled>						
			<input type="hidden" placeholder="" disabled>						
			<p>Your ₱<?php echo htmlspecialchars($request['amount']); ?> <?php echo htmlspecialchars($request['method']); ?> Request has been <?php echo htmlspecialchars($request['status']); ?>!<br><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($request['updated_at']))); ?></p>

			<div class="view-button">
				<div class="view" onclick="showRequestCard(<?php echo htmlspecialchars($request['id']); ?>)">View</div>
			</div>
		
		</div>

	<?php
		} elseif ($request['status'] == 'Refunded' && $request['method'] == 'CashOut') {
	?>
							
		<div class="user-history">
			<div class="approved"></div>
			<i class='bx bxs-check-circle'></i>
			<input type="hidden" placeholder="" disabled>
			<input type="hidden" placeholder="" disabled>						
			<input type="hidden" placeholder="" disabled>						
			<p>Your ₱<?php echo htmlspecialchars($request['amount']); ?> <?php echo htmlspecialchars($request['method']); ?> Request has been <?php echo htmlspecialchars($request['status']); ?>!<br><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($request['updated_at']))); ?></p>

			<div class="view-button">
				<div class="view" onclick="showRequestCard(<?php echo htmlspecialchars($request['id']); ?>)">View</div>
			</div>
		
		</div>

	<?php
		} elseif ($request['status'] == 'Rejected' && $request['method'] == 'CashIn') {
	?>
							
		<div class="user-history">
			<div class="rejected"></div>
			<i class='bx bxs-x-circle' ></i>
			<input type="hidden" placeholder="" disabled>					
			<input type="hidden" placeholder="" disabled>						
			<input type="hidden" placeholder="" disabled>						
			<p>Your ₱<?php echo htmlspecialchars($request['amount']); ?> <?php echo htmlspecialchars($request['method']); ?> Request has been <?php echo htmlspecialchars($request['status']); ?>!<br><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($request['updated_at']))); ?></p>

			<div class="view-button">
				<div class="view" onclick="showRequestCard(<?php echo htmlspecialchars($request['id']); ?>)">View</div>
			</div>
			
		</div>

	<?php
		} elseif ($request['status'] == 'Rejected' && $request['method'] == 'CashOut') {
	?>
							
		<div class="user-history">
			<div class="rejected"></div>
			<i class='bx bxs-x-circle' ></i>
			<input type="hidden" placeholder="" disabled>					
			<input type="hidden" placeholder="" disabled>						
			<input type="hidden" placeholder="" disabled>						
			<p>Your ₱<?php echo htmlspecialchars($request['amount']); ?> <?php echo htmlspecialchars($request['method']); ?> Request has been <?php echo htmlspecialchars($request['status']); ?>!<br><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($request['updated_at']))); ?></p>		

			<div class="view-button">
				<div class="view" onclick="showRequestCard(<?php echo htmlspecialchars($request['id']); ?>)">View</div>
			</div>
			
		</div>

	<?php
		} elseif ($request['status'] == 'Added' && $request['method'] == 'CashIn') {
	?>	
							
		<div class="user-history">
			<div class="added"></div>
			<span class="added-cashin"><i class='bx bxs-check-circle' ></i></span>
			<input type="hidden" placeholder="" disabled>					
			<input type="hidden" placeholder="" disabled>						
			<input type="hidden" placeholder="" disabled>						
			<p>₱<?php echo htmlspecialchars($request['amount']); ?> has been <?php echo htmlspecialchars($request['status']); ?> to your Wallet!<br><?php echo htmlspecialchars($request['method']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($request['updated_at']))); ?></p>	

			<div class="view-button">
				<div class="view" onclick="showRequestCard(<?php echo htmlspecialchars($request['id']); ?>)">View</div>
			</div>
		
		</div>

	<?php
		} elseif ($request['status'] == 'Deducted' && $request['method'] == 'CashOut') {
	?>
							
		<div class="user-history">
			<div class="deducted"></div>
			<i class='bx bxs-minus-circle' ></i>
			<input type="hidden" placeholder="" disabled>					
			<input type="hidden" placeholder="" disabled>						
			<input type="hidden" placeholder="" disabled>						
			<p>₱<?php echo htmlspecialchars($request['amount']); ?> has been <?php echo htmlspecialchars($request['status']); ?> from your Wallet!<br><?php echo htmlspecialchars($request['method']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($request['updated_at']))); ?></p>								
		
			<div class="view-button">
				<div class="view" onclick="showRequestCard(<?php echo htmlspecialchars($request['id']); ?>)">View</div>
			</div>	
			
		</div>
		
		<?php
			}
		}
	}
?>