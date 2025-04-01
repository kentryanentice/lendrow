<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'config.php';

if (!isset($_SESSION['username']) || (!isset($_SESSION['Pending']) && !isset($_SESSION['Verifying']))) {
    header("Location: ./home");
    exit;
}
	$username = $_SESSION['username'];
	
	$query = "SELECT * FROM users WHERE username = ?";
	$stmt = mysqli_prepare($connection, $query);
	
	mysqli_stmt_bind_param($stmt, 's', $username);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$user = mysqli_fetch_assoc($result);
	
?>