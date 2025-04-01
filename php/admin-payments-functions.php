<?php
include 'admin-session.php';

$adminId = $admin['id'];

function getLendingTerms($connection, $adminId, $searchLendingTerms = '') {
    $query = "SELECT * FROM lending_terms WHERE users_id = ?";
    $params = [$adminId];
    $paramTypes = "i";

    if (!empty($searchLendingTerms)) {
        $query .= " AND (lendername LIKE ? OR mobile LIKE ? OR monthly LIKE ? OR amount LIKE ? OR interest LIKE ? OR collateral LIKE ? OR terms LIKE ? OR OR status LIKE ? OR created_at LIKE ? OR updated_at LIKE ?)";
        $searchTerm = '%' . $searchLendingTerms . '%';
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
        $paramTypes .= "ssssssss";
    }

    $query .= " ORDER BY created_at DESC, updated_at DESC";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../home?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $lending = mysqli_fetch_all($resultData, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    return $lending;
}

function getApplications($connection, $adminId, $searchApplications = '') {
    $query = "SELECT * FROM applications WHERE users_id = ?";
    $params = [$adminId];
    $paramTypes = "i";

    if (!empty($searchApplications)) {
        $query .= " AND (borrowername LIKE ? OR mobile LIKE ? OR collateral LIKE ? OR status LIKE ? OR created_at LIKE ? OR updated_at LIKE ?)";
        $searchTerm = '%' . $searchApplications . '%';
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
        $paramTypes .= "ssssss";
    }

    $query .= " ORDER BY created_at DESC, updated_at DESC";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../home?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $applications = mysqli_fetch_all($resultData, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    return $applications;
}

function getPaymentsFinancialDetails($connection, $borrowername, $applicationsId, $searchPaymentsFinancialDetails = '') {
    $query = "SELECT * FROM financial_details WHERE borrowername = ? AND applications_id = ?";
    $params = [$borrowername, $applicationsId];
    $paramTypes = "si";

    if (!empty($searchPaymentsFinancialDetails)) {
        $query .= " AND (lendername LIKE ? OR borrowername LIKE ? OR mobile LIKE ? OR amount LIKE ? OR interest LIKE ? OR term LIKE ? OR monthly LIKE ? OR status LIKE ? OR created_at LIKE ? OR updated_at LIKE ?)";
        $searchTerm = '%' . $searchPaymentsFinancialDetails . '%';
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
        $paramTypes .= "ssssssssss";
    }

    $query .= " ORDER BY created_at DESC, updated_at DESC";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../home?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $payments = mysqli_fetch_all($resultData, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    return $payments;
}

function getCollectionFinancialDetails($connection, $lendername, $lendingTermsId, $searchCollectionFinancialDetails = '') {
    $query = "SELECT * FROM financial_details WHERE lendername = ? AND lending_terms_id = ?";
    $params = [$lendername, $lendingTermsId];
    $paramTypes = "si";

    if (!empty($searchCollectionFinancialDetails)) {
        $query .= " AND (lendername LIKE ? OR borrowername LIKE ? OR mobile LIKE ? OR amount LIKE ? OR interest LIKE ? OR term LIKE ? OR monthly LIKE ? OR status LIKE ? OR created_at LIKE ? OR updated_at LIKE ?)";
        $searchTerm = '%' . $searchCollectionFinancialDetails . '%';
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
        $paramTypes .= "ssssssssss";
    }

    $query .= " ORDER BY created_at DESC, updated_at DESC";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../home?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $collections = mysqli_fetch_all($resultData, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    return $collections;
}

?>