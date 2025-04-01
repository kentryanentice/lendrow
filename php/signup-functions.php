<?php
include 'home-session.php';

function fullnameTaken($connection, $firstname, $middlename, $lastname) {
		$query = "SELECT * FROM users WHERE firstname = ? AND middlename = ? AND lastname = ?;";
		$stmt = mysqli_stmt_init($connection);
		
		if (!mysqli_stmt_prepare($stmt, $query)) {
			header("location: ../home?error=stmtfailed");
			exit();
		}
		
		mysqli_stmt_bind_param($stmt, "sss", $firstname, $middlename, $lastname);
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
	
function usernameTaken($connection, $username) {
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
	
function mobileTaken($connection, $mobile) {
    $query = "SELECT * FROM users WHERE mobile = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../home?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $mobile);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
	
function signupUser($connection, $firstname, $middlename, $lastname, $username, $mobile, $pass) {
    $query = "INSERT INTO users (firstname, middlename, lastname, username, mobile, pass) VALUES (?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../home?error=stmtfailed");
        exit();
    }

    $hashedpass = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $middlename, $lastname, $username, $mobile, $hashedpass);
    mysqli_stmt_execute($stmt);


    $userId = mysqli_insert_id($connection);

    mysqli_stmt_close($stmt);

    $queryWallet = "INSERT INTO wallet (fullname, mobile, balance, users_id) VALUES (?,?,?,?)";
    $stmtWallet = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmtWallet, $queryWallet)) {
        header("location: ../home?error=stmtfailed");
        exit();
    }

    $fullname = $firstname . ' ' . $middlename . ' ' . $lastname;
    $initialBalance = '0.00';

    mysqli_stmt_bind_param($stmtWallet, "sssi", $fullname,  $mobile, $initialBalance, $userId);
    mysqli_stmt_execute($stmtWallet);
    mysqli_stmt_close($stmtWallet);

    header("location: ../home?success=registered");
    exit();
}

?>