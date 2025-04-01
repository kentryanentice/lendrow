<?php
include '../php/users-pending-session.php';

	if ($user['usertype'] == 'Pending') {
	?>
		<button type="submit" id="update" class="update">Update</button>
							
	<?php
		}
		elseif ($user['usertype'] == 'Verifying') {
	?>
							
		<button type="submit" id="update" class="update">Update</button>
							
	<?php
		}
		elseif ($user['usertype'] == 'User') {
	?>
							
		<button type="submit" id="update"></button>
							
	<?php
	}
?>