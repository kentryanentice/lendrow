<?php
include 'admin-session.php';
include 'confirm-virtual-money-functions.php';

if (isset($_SESSION['last_submission_time']) && time() - $_SESSION['last_submission_time'] < 5) {
    header("Location: ../admin-account-wallet?error=duplicate_submission");
    exit();
}

$_SESSION['last_submission_time'] = time();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["confirm"])) {	
	$name = $_POST["name"];
	$amount = $_POST["amount"];
	$id = filter_var($_POST["id"], FILTER_VALIDATE_INT);

    confirm($connection, $name, $amount, $id);
	
	$_SESSION['last_submission_time'] = time();
	exit();
} 

else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cancel"])) {
	$id = filter_var($_POST["id"], FILTER_VALIDATE_INT);;

    cancel($connection, $id);
	
	$_SESSION['last_submission_time'] = time();
	exit();
}

else {
    header("location: ../admin-account-wallet");
    exit();
}
?>
