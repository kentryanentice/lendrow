<?php
include '../php/user-session.php';
include '../php/payments-functions.php';

	$searchApplications = isset($_GET['searchApplications']) ? $_GET['searchApplications'] : '';
	$applications = getApplications($connection, $userId, $searchApplications = '');

	foreach ($applications as $application) {
		$userId = $application['users_id'];
		$applicationsId = $application['id'];
		$borrowername = $application['borrowername'];

	?>
	
	<?php
	$searchPaymentsFinancialDetails = isset($_GET['searchPaymentsFinancialDetails']) ? $_GET['searchPaymentsFinancialDetails'] : '';
	$payments = getPaymentsFinancialDetails($connection, $borrowername, $applicationsId, $searchPaymentsFinancialDetails = '');

		foreach ($payments as $payment) {
		$paymentsId = $payment['id'];
		$borrowername = $payment['borrowername'];
		$applicationsId = $payment['applications_id'];
	?>
	
	<?php
		for ($month = 1; $month <= 12; $month++) {
			$dueDate = date("F d, Y", strtotime($payment['created_at'] . ' +' . $month . ' month'));
			$statusKey = 'month_' . $month;
			$status = $payment[$statusKey];
		
			$today = date("F d, Y");
			$dueDateCheck = date("F d, Y", strtotime($dueDate));

	
			$diffDays = (strtotime($dueDateCheck) - strtotime($today)) / (60 * 60 * 24);

		if ($payment[$statusKey] === 'UnPaid' && $diffDays >= 0 && $diffDays <= 3) {
?>
			<span class="notification-dot"></span>

	<?php
		}
	}
?>

	<?php
	}
?>

	<?php
	}
?>