<?php
include '../php/user-session.php';
include '../php/wallet-functions.php';

		$searchRequest = isset($_GET['searchRequest']) ? $_GET['searchRequest'] : '';
		$requests = getRequest($connection, $userId, $searchRequest = '');
								
		foreach ($requests as $request) {
		$userId = $request['wallet_id'];
		?>
		
		<div class="request-card" id="requestCard<?php echo htmlspecialchars($request['id']); ?>">
		<h2>Transaction Information</h2>
		
		<div class="card-input">
			<div class="info1">
				<label><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($request['updated_at']))); ?></label>
			</div>
			
			<div class="info">
				<label>Name : </label><input type="text" name="name" value="<?php echo htmlspecialchars($request['fullname']); ?>" readonly>
			</div>
			
			<div class="info">
				<label> <?php 
				if ($request['method'] === 'CashIn') { 
					echo 'Cash In Method:'; 
				} elseif ($request['method'] === 'CashOut') { 
					echo 'Cash Out Method:'; 
				} 
				?>
				</label><input type="text" value="<?php echo htmlspecialchars($request['payment_method']); ?>" readonly>
			</div>
			
			<div class="info">
				<label> <?php 
				if ($request['method'] === 'CashIn') { 
					echo 'Cash In Amount:'; 
				} elseif ($request['method'] === 'CashOut') { 
					echo 'Cash Out Amount:'; 
				} 
				?></label><input type="text" name="amount" id="amount" value="<?php echo htmlspecialchars($request['amount']); ?>" readonly>
			</div>
			
			<div class="info">
				<label>Payment No : </label><input type="text" name="mobile" value="<?php echo htmlspecialchars($request['payment_number']); ?>" readonly>
			</div>
			
			<div class="info">
				<label>Account Name : </label><input type="text" value="<?php echo htmlspecialchars($request['payment_account_name']); ?>" readonly>
			</div>
			
			<div class="info">
				<label>Receipt : </label>
			</div>
			
			<div class="receipt" onclick="showCardReceipt(<?php echo htmlspecialchars($request['id']);?>)">
			<?php
				if (!empty($request['receipt'])) {
				$receiptPath = './/' . htmlspecialchars($request['receipt']);
					echo '<img src="' . $receiptPath . '" alt="Receipt">';
				} else {
					echo '<img src="pictures/logo.png" alt="No Receipt">';
				}
				?>
			</div>
			
			</div>
		
			<div class="request-card-button">
				<div class="close" onclick="hideRequestCard(<?php echo htmlspecialchars($request['id']); ?>)">Close</div> 
			</div>
			
			<div class="overlaycardbg" id="overlayCardBg<?php echo htmlspecialchars($request['id']); ?>"></div>
			
			<div class="card-receipt" id="cardReceipt<?php echo htmlspecialchars($request['id']);?>">
				<div class="card-receipt-title"><?php 
				if ($request['method'] === 'CashIn') { 
					echo 'Cash In Receipt'; 
				} elseif ($request['method'] === 'CashOut') { 
					echo 'Cash Out Receipt'; 
				} 
				?><<i class='bx bxs-message-square-x' onclick="hideCardReceipt(<?php echo htmlspecialchars($request['id']);?>)"></i></div>
					<?php
						if (!empty($request['receipt'])) {
							$receiptPath = './/' . htmlspecialchars($request['receipt']);
								echo '<img src="' . $receiptPath . '" alt="Receipt">';
						} else {
							echo '<img src="pictures/logo.png" alt="No  Receipt">';
						}
					?>
			</div>
		
		</div>
		
		<?php
			}
		?>