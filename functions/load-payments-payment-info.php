<?php
include '../php/user-session.php';
include '../php/payments-functions.php';

	$searchApplications = isset($_GET['searchApplications']) ? $_GET['searchApplications'] : '';
	$applications = getApplications($connection, $userId, $searchApplications = '');

	$hasPayment = false;

		foreach ($applications as $application) {
		$userId = $application['users_id'];
		$applicationsId = $application['id'];
		$borrowername = $application['borrowername'];

	?>
								
	<?php
	$searchPaymentsFinancialDetails = isset($_GET['searchPaymentsFinancialDetails']) ? $_GET['searchPaymentsFinancialDetails'] : '';
	$payments = getPaymentsFinancialDetails($connection, $borrowername, $applicationsId, $searchPaymentsFinancialDetails = '');
									
	if (!empty($payments)) {
		
	$hasPayment = true;

		foreach ($payments as $payment) {
		$term = (int) filter_var($payment['term'], FILTER_SANITIZE_NUMBER_INT);
		$paymentsId = $payment['id'];
		$borrowername = $payment['borrowername'];
		$applicationsId = $payment['applications_id'];
		$monthlyInterest = $payment['monthly'];
		$lendDate = strtotime($payment['created_at']);
		$expectedPaidDate = strtotime("+{$term} months", $lendDate);
		$expectedPaidDateFormatted = date("F d, Y", $expectedPaidDate);

		$hasPayment = true;
        $paidCount = 0;
            for ($m = 1; $m <= $term; $m++) {
                if (isset($payment["month_{$m}"]) && $payment["month_{$m}"] === "Paid") {
                    $paidCount++;
                }
            }
        $paymentPercentage = ($term > 0) ? round(($paidCount / $term * 100), 2) : 0;
	?>
	
	<tr>
		<td class="payment-td"><?php echo htmlspecialchars($payment['lendername']); ?></td>
		<td class="payment-td">₱<?php echo htmlspecialchars($payment['amount']); ?></td>
		<td class="payment-td"><?php echo htmlspecialchars($payment['interest']); ?></td>
		<td class="payment-td"><?php echo htmlspecialchars($payment['term']); ?></td>
		<td class="payment-td">₱<?php echo htmlspecialchars($monthlyInterest); ?></td>
		<td class="payment-td"><?php echo htmlspecialchars(date("F d, Y", strtotime($payment['created_at']))); ?></td>
		<td class="payment-td"><?php echo htmlspecialchars($expectedPaidDateFormatted); ?></td>

	<?php
		for ($month = 1; $month <= 12; $month++) {
			if ($month <= $term) {
			$monthStatus = $payment["month_{$month}"];
	?>
	
		<?php if($monthStatus === "Paid") {
		?>
		
			<td class="payment-td paid">₱<?php echo htmlspecialchars($payment['monthly']); ?></td>
		
		<?php 
			} elseif($monthStatus === "UnPaid") {
		?>
		
			<td class="payment-td unpaid">₱<?php echo htmlspecialchars($payment['monthly']); ?></td>
			
		<?php 
			}
		?>
	
	<?php
		} else {
	?>
		<td class="payment-td">*</td>
			
	<?php
		}
	}
	?>

        <?php if($payment['status'] === "Paid") {
		?>
            <td class="payment-td paid">
                <?php echo htmlspecialchars($paymentPercentage) . '%'; ?>
            </td>

        <?php 
			} elseif($payment['status'] === "UnPaid") {
		?>
            <td class="payment-td unpaid">
                <?php echo htmlspecialchars($paymentPercentage) . '%'; ?>
            </td>
        
        <?php 
			}
		?>
	
		<?php if($payment['status'] === "Paid") {
		?>
		
			<td class="payment-td paid"><?php echo htmlspecialchars($payment['status']); ?></td>
		
		<?php 
			} elseif($payment['status'] === "UnPaid") {
		?>
		
			<td class="payment-td unpaid"><?php echo htmlspecialchars($payment['status']); ?></td>
			
		<?php 
			}
		?>
	</tr>
	
		<?php
        }
    }
}

if (!$hasPayment) {
    echo '<p class="empty" id="loading"><span class="animated-dots">Payment Manager is currently empty<span class="dots"></span></span></p>';
}
?>