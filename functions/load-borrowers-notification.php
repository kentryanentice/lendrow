<?php
include '../php/user-session.php';
include '../php/borrowers-lending-terms-functions.php';

		$searchApplications = isset($_GET['searchApplications']) ? $_GET['searchApplications'] : '';
		$applications = getApplications($connection, $userId, $searchApplications = '');
																	
			foreach ($applications as $application) {
			$userId = $application['users_id'];
												
		if  ($application['status'] == 'Pending') {
		?>
	
		<span class="notification-dot"></span>
		

<?php
    }
}
?>