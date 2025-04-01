<?php
include 'admin-session.php';

function approve($connection, $adminname, $amount, $id) {
	if (!hasEnoughVirtualBalance($connection, $adminname, $amount)) {
        header("location: ../admin-account-wallet?error=insufficientvirtualbalance");
        exit();
    }
	
	$existingAppQuery = "SELECT id FROM cash_transactions WHERE method = 'CashIn' AND status = 'Approved'";
    $stmtAppQuery = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmtAppQuery, $existingAppQuery)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_execute($stmtAppQuery);
    mysqli_stmt_store_result($stmtAppQuery);

    if (mysqli_stmt_num_rows($stmtAppQuery) > 0) {
        header("location: ../admin-account-wallet?error=existingcashinapproval");
        exit();
    }

    mysqli_stmt_close($stmtAppQuery);

    $query = "UPDATE cash_transactions SET status = 'Approved', updated_at = CURRENT_TIMESTAMP WHERE id = ?";

    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../admin-account-wallet?success=approvedcashin");
    exit();
}

function reject($connection, $id) {

    $query = "UPDATE cash_transactions SET status = 'Rejected', updated_at = CURRENT_TIMESTAMP WHERE id = ?";

    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../admin-account-wallet?success=rejectedcashin");
    exit();
}

function cashin($connection, $adminname, $amount, $receiver, $mobile, $id) {
	if (!hasEnoughVirtualBalance($connection, $adminname, $amount)) {
        header("location: ../admin-account-wallet?error=insufficientvirtualbalance");
        exit();
    }
	
	$currentVirtualBalance = getCurrentVirtualBalance($connection, $adminname);

	$newVirtualBalance = number_format((float) str_replace(',', '', $currentVirtualBalance) - (float) str_replace(',', '', $amount), 2, '.', ',');

	$queryDeduct = "UPDATE admin_wallet SET virtual_balance = ?, updated_at = CURRENT_TIMESTAMP WHERE admin_wallet_name = ?;";
	$stmtDeduct = mysqli_stmt_init($connection);

	if (!mysqli_stmt_prepare($stmtDeduct, $queryDeduct)) {
		header("location: ../admin-account-wallet?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmtDeduct, "ss", $newVirtualBalance, $adminname);
	mysqli_stmt_execute($stmtDeduct);
	mysqli_stmt_close($stmtDeduct);
	
	$newAmount = number_format((float) str_replace(',', '', $amount), 2, '.', ',');
	$status = 'Deducted';
    $transferMethod = 'CashIn';
	$adminWalletId = getAdminWalletId($connection, $adminname);
	
	$queryInsert = "INSERT INTO admin_wallet_transactions (amount, status, method, admin_wallet_id) VALUES (?,?,?,?)";
    $stmtInsert = mysqli_stmt_init($connection);
	
    if (!mysqli_stmt_prepare($stmtInsert, $queryInsert)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmtInsert, "sssi", $newAmount, $status, $transferMethod, $adminWalletId);
    mysqli_stmt_execute($stmtInsert);
    mysqli_stmt_close($stmtInsert);
	
	$currentBalance = getCurrentBalance($connection, $mobile);

    $newBalance = number_format((float) str_replace(',', '', $currentBalance) + (float) str_replace(',', '', $amount), 2, '.', ',');

    $query = "UPDATE wallet SET balance = ?, updated_at = CURRENT_TIMESTAMP WHERE mobile = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $newBalance, $mobile);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

	$newAmount = number_format((float) str_replace(',', '', $amount), 2, '.', ',');
    $transferMethod = 'Added';
    $receiverWalletId = getReceiverWalletId($connection, $mobile);
	$senderWalletId = getSenderWalletId($connection, $adminname);

    $queryInsert = "INSERT INTO wallet_transactions (sender, mobile, amount, receiver, transfer_method, receiver_wallet_id, sender_wallet_id) VALUES (?,?,?,?,?,?,?)";
    $stmtInsert = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmtInsert, $queryInsert)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmtInsert, "sssssii", $adminname, $mobile, $newAmount, $receiver, $transferMethod, $receiverWalletId, $senderWalletId);
    mysqli_stmt_execute($stmtInsert);
    mysqli_stmt_close($stmtInsert);
	
	$updateQuery = "UPDATE cash_transactions SET status = 'Added', updated_at = CURRENT_TIMESTAMP WHERE id = ?";
	$stmtUpdate = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmtUpdate, $updateQuery)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmtUpdate, "i",  $id);
    mysqli_stmt_execute($stmtUpdate);
    mysqli_stmt_close($stmtUpdate);

    header("location: ../admin-account-wallet?success=cashin");
    exit();
}

function hasEnoughVirtualBalance($connection, $adminname, $amount) {
    $currentVirtualBalance = getCurrentVirtualBalance($connection, $adminname);

    return (float) str_replace(',', '', $currentVirtualBalance) >= (float) str_replace(',', '', $amount);
}

function getCurrentVirtualBalance($connection, $adminname) {
    $query = "SELECT virtual_balance FROM admin_wallet WHERE admin_wallet_name = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $adminname);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['virtual_balance'];
    } else {
        header("location: ../admin-account-wallet?error=virtualbalancenotfound");
        exit();
    }

    mysqli_stmt_close($stmt);
}

function getAdminWalletId($connection, $adminname) {
    $query = "SELECT id FROM admin_wallet WHERE admin_wallet_name = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $adminname);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['id'];
    } else {
        header("location: ../admin-account-wallet?error=virtualwalletidnotfound");
        exit();
    }

    mysqli_stmt_close($stmt);
}

function getCurrentBalance($connection, $mobile) {
    $query = "SELECT balance FROM wallet WHERE mobile = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $mobile);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['balance'];
    } else {
        header("location: ../admin-account-wallet?error=balancenotfound");
        exit();
    }

    mysqli_stmt_close($stmt);
}

function getReceiverWalletId($connection, $mobile) {
    $query = "SELECT id FROM wallet WHERE mobile = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $mobile);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['id'];
    } else {
        header("location: ../admin-account-wallet?error=walletidnotfound");
        exit();
    }

    mysqli_stmt_close($stmt);
}

function getSenderWalletId($connection, $adminname) {
	$query = "SELECT id FROM admin_wallet WHERE admin_wallet_name = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $adminname);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['id'];
    } else {
        header("location: ../admin-account-wallet?error=senderidnotfound");
        exit();
    }

    mysqli_stmt_close($stmt);
}

?>