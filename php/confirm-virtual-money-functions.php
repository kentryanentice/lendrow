<?php
include 'admin-session.php';

function confirm($connection, $name, $amount, $id) {
	
	$currentVirtualBalance = getCurrentVirtualBalance($connection, $name);
	$currentSystemBalance = getCurrentSystemBalance($connection, $name);

    $newVirtualBalance = number_format((float) str_replace(',', '', $currentVirtualBalance) + (float) str_replace(',', '', $amount), 2, '.', ',');
	
	$newSystemBalance = number_format((float) str_replace(',', '', $currentSystemBalance) + (float) str_replace(',', '', $amount), 2, '.', ',');

    $query = "UPDATE admin_wallet SET virtual_balance = ?, system_balance = ?, updated_at = CURRENT_TIMESTAMP WHERE admin_wallet_name = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $newVirtualBalance, $newSystemBalance, $name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $query = "UPDATE admin_wallet_transactions SET status = 'Added', updated_at = CURRENT_TIMESTAMP WHERE id = ?";

    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../admin-account-wallet?success=confirmed");
    exit();
}

function cancel($connection, $id) {

    $query = "UPDATE admin_wallet_transactions SET status = 'Cancelled', updated_at = CURRENT_TIMESTAMP WHERE id = ?";

    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../admin-account-wallet?success=cancelled");
    exit();
}

function getCurrentVirtualBalance($connection, $name) {
    $query = "SELECT virtual_balance FROM admin_wallet WHERE admin_wallet_name = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $name);
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

function getCurrentSystemBalance($connection, $name) {
    $query = "SELECT system_balance FROM admin_wallet WHERE admin_wallet_name = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['system_balance'];
    } else {
        header("location: ../admin-account-wallet?error=systembalancenotfound");
        exit();
    }

    mysqli_stmt_close($stmt);
}

?>