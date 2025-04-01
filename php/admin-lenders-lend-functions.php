<?php
include 'admin-session.php';

function lend($connection, $picture, $lendername, $mobile, $monthly, $amount, $interest, $collateral, $term, $id) {
	if (!hasEnoughBalance($connection, $lendername, $amount, $id)) {
		header("location: ../admin-lenders?error=lendinsufficientbalance");
		exit();
	}
	
	$query = "INSERT INTO lending_terms (picture, lendername, mobile, monthly, amount, interest, collateral, term, status, users_id) VALUES (?,?,?,?,?,?,?,?,?,?)";
	$stmt = mysqli_stmt_init($connection);
		
	if (!mysqli_stmt_prepare($stmt, $query)) {
		header("location: ../admin-lenders?error=stmtfailed");
		exit();
	}
	
	$newAmount = number_format((float) str_replace(',', '', $amount), 2, '.', ',');
	$status = 'Open';
		
	mysqli_stmt_bind_param($stmt, "sssssssssi", $picture, $lendername, $mobile, $monthly, $newAmount, $interest, $collateral, $term, $status, $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	$currentBalance = getCurrentBalance($connection, $lendername, $id);

	$newBalance = number_format((float) str_replace(',', '', $currentBalance) - (float) str_replace(',', '', $amount), 2, '.', ',');

	$queryDeduct = "UPDATE wallet SET balance = ? WHERE fullname = ?;";
	$stmtDeduct = mysqli_stmt_init($connection);

	if (!mysqli_stmt_prepare($stmtDeduct, $queryDeduct)) {
		header("location: ../admin-lenders?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmtDeduct, "ss", $newBalance, $lendername);
	mysqli_stmt_execute($stmtDeduct);
	mysqli_stmt_close($stmtDeduct);
		
	$newAmount = number_format((float) str_replace(',', '', $amount), 2, '.', ',');
	$transferMethod = 'Lending';

	$queryInsert = "INSERT INTO wallet_transactions (sender, mobile, amount, receiver, transfer_method, receiver_wallet_id, sender_wallet_id) VALUES (?,?,?,?,?,?,?)";
	$stmtInsert = mysqli_stmt_init($connection);

	if (!mysqli_stmt_prepare($stmtInsert, $queryInsert)) {
		header("location: ../admin-lenders?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmtInsert, "sssssii", $lendername, $mobile, $newAmount, $lendername, $transferMethod, $id, $id);
	mysqli_stmt_execute($stmtInsert);
	mysqli_stmt_close($stmtInsert);
		
	header("location: ../admin-lenders?success=lendcreated");
	exit();
}

function hasEnoughBalance($connection, $lendername, $amount, $id) {
    $currentBalance = getCurrentBalance($connection, $lendername, $id);

    return (float) str_replace(',', '', $currentBalance) >= (float) str_replace(',', '', $amount);
}

function getCurrentBalance($connection, $lendername, $id) {
    $query = "SELECT balance FROM wallet WHERE fullname = ? AND id = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-lenders?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "si", $lendername, $id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['balance'];
    } else {
        header("location: ../admin-lenders?error=balancenotfound");
        exit();
    }

    mysqli_stmt_close($stmt);
}

?>