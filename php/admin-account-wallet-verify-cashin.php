<?php
include 'admin-session.php';
include 'admin-account-wallet-verify-cashin-functions.php';

if (isset($_SESSION['last_submission_time']) && time() - $_SESSION['last_submission_time'] < 5) {
    header("Location: ../admin-account-wallet?error=duplicate_submission");
    exit();
}

$_SESSION['last_submission_time'] = time();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["approve"])) {
	$id = filter_var($_POST["id"], FILTER_VALIDATE_INT);
	$adminname = $_POST['adminname'];
	$amount = $_POST['amount'];

    approve($connection, $adminname, $amount, $id);
	
	$_SESSION['last_submission_time'] = time();
	exit();
} 

else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reject"])) {
	$id = filter_var($_POST["id"], FILTER_VALIDATE_INT);

    reject($connection, $id);
	
	$_SESSION['last_submission_time'] = time();
	exit();
}

else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cashin"])) {
	$id = filter_var($_POST["id"], FILTER_VALIDATE_INT);
	$adminname = $_POST['adminname'];
	$amount = $_POST['amount'];
	$receiver = $_POST['receiver'];
	$mobile = $_POST['mobile'];

    cashin($connection, $adminname, $amount, $receiver, $mobile, $id);
	
	$_SESSION['last_submission_time'] = time();
	exit();
}

else {
    header("location: ../admin-account-wallet");
    exit();
}