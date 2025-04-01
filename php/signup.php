<?php
	include 'home-session.php';
	require 'config.php';
	require 'signup-functions.php';
	
if (isset($_SESSION['last_submission_time']) && time() - $_SESSION['last_submission_time'] < 5) {
	header("Location: ../home?error=duplicate_submission");
	exit();
}

$_SESSION['last_submission_time'] = time();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$firstname = $_POST["firstname"];
	$middlename = $_POST["middlename"];
	$lastname = $_POST["lastname"];
	$username = $_POST["username"];
	$mobile = $_POST["mobile"];
	$pass = $_POST["pass"];
	
	if(fullnameTaken($connection, $firstname, $middlename, $lastname) !== false) {
		header("location: ../home.php?error=fullnametaken");
		exit();
	}
	
	if(usernameTaken($connection, $username) !== false) {
		header("location: ../home?error=usernametaken");
		exit();
	}
	
	if(mobileTaken($connection, $mobile) !== false) {
		header("location: ../home?error=mobiletaken");
		exit();
	}
	
		
	signupUser($connection, $firstname, $middlename, $lastname, $username, $mobile, $pass);
		
	$_SESSION['last_submission_time'] = time();
	exit();
	
} else {
		header("location: ../home");
		exit();
}

?>