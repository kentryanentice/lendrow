<?php
include '../php/admin-session.php';
include '../php/admin-payments-functions.php';

function encodeId($data, $secret_key) {
    $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $secret_key, 0, $iv);
    return base64_encode($iv . $encrypted);
}

	$searchApplications = isset($_GET['searchApplications']) ? $_GET['searchApplications'] : '';
	$applications = getApplications($connection, $adminId, $searchApplications = '');

		foreach ($applications as $application) {
		$adminId = $application['users_id'];
		$applicationsId = $application['id'];
		$borrowername = $application['borrowername'];
		
		$encodedApplicationId = encodeId($applicationsId, $secret_key);
	?>
	
	<?php
	$searchPaymentsFinancialDetails = isset($_GET['searchPaymentsFinancialDetails']) ? $_GET['searchPaymentsFinancialDetails'] : '';
	$payments = getPaymentsFinancialDetails($connection, $borrowername, $applicationsId, $searchPaymentsFinancialDetails = '');
									
		foreach ($payments as $payment) {
		$paymentsId = $payment['id'];
		$lendername = $payment['lendername'];
		$borrowername = $payment['borrowername'];
		$applicationsId = $payment['applications_id'];
		$mobile = $payment['mobile'];
		$monthly = $payment['monthly'];
		
		$encodedPaymentsId = encodeId($paymentsId, $secret_key);
		$encodedLenderName = encodeId($lendername, $secret_key);
		$encodedBorrowerName = encodeId($borrowername, $secret_key);
		$encodedMobile = encodeId($mobile, $secret_key);
		$encodedMonthly = encodeId($monthly, $secret_key);
	?>
	
		<?php
			for ($month = 1; $month <= 12; $month++) {
			$dueDate = date("F d, Y", strtotime($payment['created_at'] . ' +' . $month . ' month'));
			$statusKey = 'month_' . $month;
			$status = $payment[$statusKey];
		?>

		<div class="monthly-payment-form"  id="paymentForm<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>">
			<h2>Interest Payment Form</h2>
		
			<form action="php/admin-payments-monthly<?php echo htmlspecialchars($month); ?>" method="POST">
				
				<div class="inputBox1">
					<label><?php echo htmlspecialchars($month); ?></label>
				</div>
				
				<?php
					$encodedMonth = encodeId($statusKey, $secret_key);
				?>
				
				<input type="hidden" name="applications_id" value="<?php echo htmlspecialchars($encodedApplicationId); ?>" readonly>
				<input type="hidden" name="payments_id" value="<?php echo htmlspecialchars($encodedPaymentsId); ?>" readonly>
				<input type="hidden" name="lendername" value="<?php echo htmlspecialchars($encodedLenderName); ?>" readonly>
				<input type="hidden" name="borrowername" value="<?php echo htmlspecialchars($encodedBorrowerName); ?>" readonly>
				<input type="hidden" name="mobile" value="<?php echo htmlspecialchars($encodedMobile); ?>" readonly>
				<input type="hidden" name="monthly" value="<?php echo htmlspecialchars($encodedMonthly); ?>" readonly>
				<input type="hidden" name="month" value="<?php echo htmlspecialchars($encodedMonth); ?>" readonly>
				<input type="hidden" name="month_number" value="<?php echo htmlspecialchars($month); ?>" readonly>
				
				
				<div class="inputBox">
					<label>Payment Date : </label>
					<input type="text" placeholder="<?php echo htmlspecialchars($dueDate); ?>" readonly>
				</div>
				
				<div class="inputBox">
					<label>Monthly Interest : </label>
					<input type="text" placeholder="<?php echo htmlspecialchars($payment['monthly']); ?>" readonly>
				</div>
				
				<div class="inputBox">
					<label>Receiver : </label>
					<input type="text" placeholder="<?php echo htmlspecialchars($payment['lendername']); ?>" readonly>
				</div>
				
				<div class="interest-payment-buttons">
					
					<div class="close" onclick="hidePayment(<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>)">Close</div>
					<div class="pay" onclick="showConfirmPay(<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>)">Pay</div>
					
				</div>
				
				<div class="overlayconfirmation" id="overlayConfirmation<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>"></div>
				
				<div class="confirmation-card" id="confirmCard<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>">
					<h2>Payment Confirmation</h2>
									
						<h3>Are you sure you want to pay the interest?</h3>

					<div class="confirmation-card-buttons">
						<div class="close" onclick="hideConfirmPay(<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>)">Close</div>
						<button type="submit" name="pay" class="confirm">Pay</button>
					</div>
				</div>
				
			</form>
		</div>
		<?php
			}
		?>
		
		
<?php
	}
}
?>