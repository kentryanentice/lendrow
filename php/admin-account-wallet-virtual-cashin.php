<?php
include 'admin-session.php';
include 'admin-account-wallet-virtual-cashin-functions.php';

if (isset($_SESSION['last_submission_time']) && time() - $_SESSION['last_submission_time'] < 5) {
    header("Location: ../admin-account-wallet?error=duplicate_submission");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$allowedAmounts = [1000, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 15000, 20000, 25000, 30000, 35000, 40000, 45000, 50000];
	
    $id = filter_var($_POST["id"], FILTER_VALIDATE_INT);
	$amount = $_POST["admin-cashin-amount"];

    if ($id === false) {
		header("Location: ../admin-account-wallet?error=invalidid");
        exit();
    }
	
	if (!in_array($amount, $allowedAmounts)) {
		header("Location: ../admin-account-wallet?error=invalidamount");
		exit();
	}


    virtualCashIn($connection, $id, $amount);
	
	$_SESSION['last_submission_time'] = time();
	exit();
	
} else {
    header("Location: ../admin-account-wallet");
    exit();
}

?>