<?php
include 'admin-session.php';

function getUsers($searchUsers = '') {
    global $connection;
    $query = "SELECT * FROM users";
    $params = [];
    $paramTypes = "";

    if (!empty($searchUsers)) {
        $query .= " WHERE firstname LIKE ? OR middlename LIKE ? OR lastname LIKE ? OR username LIKE ? OR created_at LIKE ? OR usertype LIKE ? OR userlevel LIKE ? OR userbadge LIKE ?";
        $searchTerm = '%' . $searchUsers . '%';
        $param = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
        $paramTypes = "ssssssss";
    }
    
    $query .= " ORDER BY created_at ASC";
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
    $userData = mysqli_fetch_all($resultData, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    return $userData;
}

?>