<?php
include 'admin-session.php';

function getAdminWallet($connection, $searchWallet = '') {
    $query = "SELECT * FROM admin_wallet";
    $params = [];
    $paramTypes = "";

    if (!empty($searchWallet)) {
        $query .= " AND (admin_wallet_name LIKE ? OR virtual_balance LIKE ? OR system_balance LIKE ? OR created_at LIKE ? OR updated_at LIKE ?)";
        $searchTerm = '%' . $searchWallet . '%';
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
        $paramTypes .= "ssss";
    }

    $query .= " ORDER BY created_at DESC";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../home?error=stmtfailed");
        exit();
    }

     if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $adminWallet = mysqli_fetch_all($resultData, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    return $adminWallet;
}

function getAdminWalletHistory($connection, $virtualWalletId, $searchVirtualWalletHistory = '') {
    $query = "SELECT * FROM admin_wallet_transactions WHERE admin_wallet_id = ?";
    $params = [$virtualWalletId];
    $paramTypes = "i";


    if (!empty($searchVirtualWalletHistory)) {
        $query .= " AND (amount LIKE ? OR status LIKE ? OR notif_status LIKE ? OR method LIKE ? OR created_at LIKE ? OR updated_at LIKE ?)";
        $searchTerm = '%' . $searchVirtualWalletHistory . '%';
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
        $paramTypes .= "ssssss";
    }

    $query .= " ORDER BY created_at DESC";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../home?error=stmtfailed");
        exit();
    }

     if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $adminWalletHistory = mysqli_fetch_all($resultData, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    return $adminWalletHistory;
}

?>