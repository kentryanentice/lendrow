<?php
include 'user-session.php';
include 'lenders-lend-functions.php';

if (isset($_SESSION['last_submission_time']) && time() - $_SESSION['last_submission_time'] < 5) {
    header("Location: ../lenders?error=duplicate_submission");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$allowedAmounts = [500, 1000, 1500, 2000, 2500, 3000, 3500, 4000, 4500, 5000, 5500, 6000, 6500, 7000, 7500, 8000, 8500, 9000, 9500, 10000];
	
	$allowedInterest = ['10% Monthly', '5% Monthly'];
	
	$allowedCollateral = ['Property', 'Cars', 'Items'];
	
	$allowedTerms = ['1 Month', '2 Months', '3 Months', '4 Months', '5 Months', '6 Months', '7 Months', '8 Months', '9 Months', '10 Months' ,'11 Months', '12 Months'];
	
	$id = $user['id'];
    $picture = $user['picture'];
	$lendername = $user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname'];
	$mobile = $user["mobile"];
	$amount = $_POST["lend-amount"];
	$interest = $_POST["interest-amount"];
	$collateral = $_POST["collateral-amount"];
	$term = $_POST["term-amount"];
	$monthly = $_POST["monthly"];
	
	if ($id === false) {
		header("Location: ../lenders?error=invalidid");
        exit();
	}
	
	if (!in_array($amount, $allowedAmounts)) {
		header("Location: ../lenders?error=invalidlendamount");
		exit();
	}
	
	if (!in_array($interest, $allowedInterest)) {
		header("Location: ../lenders?error=invalidinterest");
		exit();
	}
	
	if (!in_array($collateral, $allowedCollateral)) {
		header("Location: ../lenders?error=invalidcollateral");
		exit();
	}
	
	if (!in_array($term, $allowedTerms)) {
		header("Location: ../lenders?error=invalidterm");
		exit();
	}

    lend($connection, $picture, $lendername, $mobile, $monthly, $amount, $interest, $collateral, $term, $id);
	
	$_SESSION['last_submission_time'] = time();
	exit();
	
} else {
    header("Location: ../lenders");
    exit();
}
?>