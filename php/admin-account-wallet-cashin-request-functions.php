<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'config.php';
include 'admin-session.php';


function getCashinRequest($connection, $searchCashinRequest = '') {
    $query = "SELECT * FROM cash_transactions";
    $params = [];
    $paramTypes = "";

    if (!empty($searchCashinRequest)) {
        $query .= " AND (fullname LIKE ? OR method LIKE ? OR payment_method LIKE ? OR amount LIKE ? OR status LIKE ? OR notif_status LIKE ? OR created_at LIKE ? OR updated_at LIKE ?)";
        $searchTerm = '%' . $searchCashinRequest . '%';
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
        $paramTypes .= "ssssssss";
    }

    $query .= " ORDER BY created_at DESC, updated_at DESC";
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
    $cashinRequest = mysqli_fetch_all($resultData, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    return $cashinRequest;
}
?>