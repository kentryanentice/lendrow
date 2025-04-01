<?php
include 'admin-session.php';
include 'admin-account-wallet-verify-cashout-functions.php';

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
	$adminname = $_POST['adminname'];
	$amount = $_POST['amount'];
	$receiver = $_POST['receiver'];
	$mobile = $_POST['mobile'];

    reject($connection, $adminname, $amount, $receiver, $mobile, $id);
	
	$_SESSION['last_submission_time'] = time();
	exit();
}

else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cashout"])) {
	$id = filter_var($_POST["id"], FILTER_VALIDATE_INT);
	$adminname = $_POST['adminname'];
	$amount = $_POST['amount'];
	$receiver = $_POST['receiver'];
	$mobile = $_POST['mobile'];
	$receipt = $_FILES['receipt'];
	
	if (emptyPicture($receipt) !== false) {
        header("Location: ../admin-account-wallet?error=emptyreceipt");
        exit();
    }
	
	if (invalidSize($receipt) !== false) {
        header("Location: ../admin-account-wallet?error=invalidsize");
        exit();
    }
	
	if (invalidFormat($receipt) !== false) {
		header("Location: ../admin-account-wallet?error=invalidformat");
		exit();
	}

    cashout($connection, $adminname, $amount, $receiver, $mobile, $receipt, $id);
	
	$_SESSION['last_submission_time'] = time();
	exit();
}

else {
    header("location: ../admin-account-wallet");
    exit();
}