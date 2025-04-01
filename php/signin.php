<?php
	include 'home-session.php';
	require 'config.php';
	require 'signin-functions.php';

if (isset($_SESSION['last_submission_time']) && time() - $_SESSION['last_submission_time'] < 5) {
    header("Location: ../home?error=duplicate_submission");
    exit();
}

$_SESSION['last_submission_time'] = time();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$username = $_POST["username"];
	$pass = $_POST["pass"];
	
	signinUser($connection, $username, $pass);
	
	$_SESSION['last_submission_time'] = time();
	exit();
}

	else{
		header("location: ../home");
		exit();
	}
?>