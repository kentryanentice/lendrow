<?php
include '../php/admin-session.php';
include '../php/admin-borrowers-lending-terms-functions.php';

		$searchApplications = isset($_GET['searchApplications']) ? $_GET['searchApplications'] : '';
		$applications = getApplications($connection, $adminId, $searchApplications = '');
																	
			foreach ($applications as $application) {
			$adminId = $application['users_id'];
												
		if  ($application['status'] == 'Pending') {
		?>
	
		<span class="notification-dot"></span>
		

<?php
    }
}
?>