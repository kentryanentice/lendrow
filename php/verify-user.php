<?php
include 'admin-session.php';
include 'verify-user-functions.php';

if (isset($_SESSION['last_submission_time']) && time() - $_SESSION['last_submission_time'] < 5) {
    header("Location: ../admin-accounts?error=duplicate_submission");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = filter_var($_POST["id"], FILTER_VALIDATE_INT);

    verifyUser($connection, $id);
	
	$_SESSION['last_submission_time'] = time();
	exit();
	
} else {
    header("Location: ../admin-accounts");
    exit();
}

?>