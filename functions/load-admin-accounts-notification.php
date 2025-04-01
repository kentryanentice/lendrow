<?php
include '../php/admin-session.php';
include '../php/admin-account-user-functions.php';

$searchUsers = isset($_GET['searchUsers']) ? $_GET['searchUsers'] : '';
$usersData = getUsers($searchUsers);

foreach ($usersData as $userData) {
    if ($userData['usertype'] == 'Pending' || $userData['usertype'] == 'Verifying') {
     ?>
	 <span class="notification-dot"></span>
<?php
    }
}
?>