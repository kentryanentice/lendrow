<?php
include 'admin-session.php';

function cashOut($connection, $id, $fullname, $mobile, $method, $amount) {
	if (!hasEnoughBalance($connection, $fullname, $amount, $id)) {
        handleCashOutError("cashoutinsufficientbalance");
        exit();
    }
	
	$existingAppQuery = "SELECT id FROM cash_transactions WHERE wallet_id = ? AND method = 'CashOut' AND (status <> 'Rejected' AND status <> 'Deducted' OR status IS NULL)";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $existingAppQuery)) {
		handleCashOutError("stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        handleCashOutError("existingcashout");
        exit();
    }

    mysqli_stmt_close($stmt);

	$query = "INSERT INTO cash_transactions (fullname, method, payment_method, amount, mobile, payment_number, payment_account_name, wallet_id) VALUES (?, 'CashOut', ?, ?, ?, ?, ?, ?)";
	$stmt = mysqli_stmt_init($connection);
		
	if (!mysqli_stmt_prepare($stmt, $query)) {
		handleCashOutError("stmtfailed");
        exit();
	}

	$newAmount = number_format((float) str_replace(',', '', $amount), 2, '.', ',');
			
	mysqli_stmt_bind_param($stmt, "ssssssi", $fullname, $method, $newAmount, $mobile, $mobile, $fullname, $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	
	$deductQuery = "UPDATE wallet SET balance = ? WHERE fullname = ? AND id = ?;";
	$deductstmt = mysqli_stmt_init($connection);

	if (!mysqli_stmt_prepare($deductstmt, $deductQuery)) {
		header("location: ../adminwallet?error=stmtfailed");
		exit();
	}
	
	$currentBalance = getCurrentBalance($connection, $fullname, $id);
	
	$newBalance = number_format((float) str_replace(',', '', $currentBalance) - (float) str_replace(',', '', $newAmount), 2, '.', ',');

	mysqli_stmt_bind_param($deductstmt, "ssi", $newBalance, $fullname, $id);
	mysqli_stmt_execute($deductstmt);
	mysqli_stmt_close($deductstmt);

	handleCashOutSuccess("cashedout");
	exit();
}

function hasEnoughBalance($connection, $fullname, $amount, $id) {
    $currentBalance = getCurrentBalance($connection, $fullname, $id);

    return (float) str_replace(',', '', $currentBalance) >= (float) str_replace(',', '', $amount);
}

function getCurrentBalance($connection, $fullname, $id) {
    $query = "SELECT balance FROM wallet WHERE fullname = ? AND id = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        handleCashOutError("stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "si", $fullname, $id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['balance'];
    } else {
        handleCashOutError("balancenotfound");
        exit();
    }

    mysqli_stmt_close($stmt);
} 
?>