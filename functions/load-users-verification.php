<?php
include '../php/users-pending-session.php';

	if ($user['usertype'] == 'Pending') {
	?>
		<div class="users-error">
			<i class='bx bxs-alarm-exclamation'></i><p class='orange'>Pending Account! Please verify your identity.</p>
		</div>
								
		<div class="update" onclick="showUpdateForm()">Update</div>
													
	<?php
	}
	elseif ($user['usertype'] == 'Verifying') {
	?>
		<div class="users-error">				
			<i class='bx bxs-alarm-exclamation'></i><p class='orange'>Verifying Account! Please wait for updates.</p>
		</div>
								
		<div class="update" onclick="showUpdateForm()">Update</div>
													
	<?php
	}
		elseif ($user['usertype'] == 'User') {
	?>
		<div class="users-error">					
			<i class='bx bxs-check-circle'></i><p class='blue'>Verification Completed! Please sign in again.</p>
		</div>
									
		<div class="update">Verified</div>
														
	<?php
	}
?>