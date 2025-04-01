<?php
include 'home-session.php';

function username($connection, $username) {
	$query = "SELECT * FROM users WHERE username = ?;";
	$stmt = mysqli_stmt_init($connection);
		
	if (!mysqli_stmt_prepare($stmt, $query)) {
		header("location: ../home?error=stmtfailed");
		exit();
	}
		
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
		
	$resultData = mysqli_stmt_get_result($stmt);
		
	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}
		
	mysqli_stmt_close($stmt);
}

function signinUser($connection, $username, $pass) {
    $userDetails = username($connection, $username);

    if ($userDetails === false) {
        header("location: ../home?error=invalidcredentials");
        exit();
    }

    $passHashed = $userDetails["pass"];
    $checkpass = password_verify($pass, $passHashed);

    if ($checkpass === false) {
        header("location: ../home?error=invalidcredentials");
        exit();
    } else if ($checkpass === true) {
        session_start();
		session_regenerate_id(true);
        $_SESSION["id"] = $userDetails["id"];
		$_SESSION["usertype"] = $userDetails["usertype"];
        $_SESSION["username"] = $userDetails["username"];
		
		recordLoginDetails($connection, $userDetails["username"], $userDetails["id"]);

        if ($userDetails['usertype'] == 'Admin') {
            $_SESSION['Admin'] = true;
            header("location: ../admin-accounts");
            exit();
        } else if ($userDetails['usertype'] == 'User') {
            $_SESSION['User'] = true;
            header("location: ../lenders");
            exit();
        } else if ($userDetails['usertype'] == 'Pending') {
            $_SESSION['Pending'] = true;
            header("location: ../pending");
            exit();
        } else if ($userDetails['usertype'] == 'Verifying') {
            $_SESSION['Verifying'] = true;
            header("location: ../pending");
            exit();
        }
    }
}

function recordLoginDetails($connection, $username, $userId) {
    $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $device = php_uname('s') . " " . php_uname('r');
    $browser = (strpos($userAgent, 'Chrome') !== false) ? 'Chrome' : 'Unknown';

    $query = "INSERT INTO login_details (fullname, device, browser, ip_address, user_agent) 
              VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        error_log("Failed to record login details: " . mysqli_error($connection));
        return;
    }

    mysqli_stmt_bind_param($stmt, "sssss", $username, $device, $browser, $ipAddress, $userAgent);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

?>