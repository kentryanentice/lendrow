<?php
include 'admin-session.php';
include 'admin-account-wallet-setup-functions.php';

if (isset($_SESSION['last_submission_time']) && time() - $_SESSION['last_submission_time'] < 5) {
    header("Location: ../admin-account-wallet?error=duplicate_submission");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$adminwalletname = $_POST["adminwalletname"];

    accountSetup($connection, $adminwalletname);
	
	$_SESSION['last_submission_time'] = time();
	exit();
	
} else {
    header("Location: ../admin-account-wallet");
    exit();
}

?>