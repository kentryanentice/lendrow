<?php
if (session_status() == PHP_SESSION_NONE) {
    session_set_cookie_params([
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    session_start();
	session_regenerate_id();
}

include 'config.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (!isset($_SESSION['username']) || !isset($_SESSION['Admin'])) {
    header("Location: ./home");
    exit;
}

	$username = $_SESSION['username'];

	$query = "SELECT * FROM users WHERE username = ?";
	$stmt = mysqli_prepare($connection, $query);
	
	mysqli_stmt_bind_param($stmt, 's', $username);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$admin = mysqli_fetch_assoc($result);

	if ($admin) {
		$_SESSION['Admin'] = $admin;
	} else {
		$_SESSION['Admin'] = null;
	}
	
	mysqli_stmt_close($stmt);
?>
