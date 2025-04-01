<?php
include '../php/admin-session.php';
include '../php/admin-lenders-lending-terms-functions.php';

	$searchLendingTerms = isset($_GET['searchLendingTerms']) ? $_GET['searchLendingTerms'] : '';
	$lending = getLendingTerms($connection, $adminId, $searchLendingTerms = '');

		foreach ($lending as $lending) {
		$adminId = ['users_id'];
		$lendingTermsId = $lending['id'];
	?>
	
	<?php
	$searchApplications = isset($_GET['searchApplications']) ? $_GET['searchApplications'] : '';
	$applications = getApplications($connection, $lendingTermsId, $searchApplications = '');

		foreach ($applications as $application) {
		$lendingTermsId = $application['lending_terms_id'];
		
		if ($application['status'] == 'Pending') {		
	?>
	
		<span class="notification-dot"></span>
		
	<?php
		}
    }
	?>
	
<?php
    }
?>