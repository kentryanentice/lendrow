<?php
include 'admin-session.php';

$adminId = $admin['id'];

function getLendingTerms($connection, $searchLendingTerms = '') {
    $query = "SELECT * FROM lending_terms";
	$params = [];
    $paramTypes = "";

    if (!empty($searchLendingTerms)) {
        $query .= " AND (lendername LIKE ? OR mobile LIKE ? OR monthly LIKE ? OR amount LIKE ? OR interest LIKE ? OR collateral LIKE ? OR terms LIKE ? OR OR status LIKE ? OR created_at LIKE ?, OR updated_at LIKE ?)";
        $searchTerm = '%' . $searchLendingTerms . '%';
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
        $paramTypes .= "ssssssss";
    }

    $query .= " ORDER BY created_at DESC, updated_at ";
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
    $lender = mysqli_fetch_all($resultData, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    return $lender;
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

function getLendingTermsByApplications($connection, $lendingTermsId, $searchLendingTermsApplications = '') {
    $query = "SELECT * FROM lending_terms WHERE id = ?";
    $params = [$lendingTermsId];
    $paramTypes = "i";

    if (!empty($searchLendingTermsApplications)) {
        $query .= " AND (lendername LIKE ? OR mobile LIKE ? OR monthly LIKE ? OR amount LIKE ? OR interest LIKE ? OR collateral LIKE ? OR terms LIKE ? OR OR status LIKE ? OR created_at LIKE ?, OR updated_at LIKE ?)";
        $searchTerm = '%' . $searchLendingTermsApplications . '%';
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
    $lendingTermsApplications = mysqli_fetch_all($resultData, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    return $lendingTermsApplications;
}

function getAgreementsByApplications($connection, $lendingTermsId, $applicationsId, $searchAgreements = '') {
    $query = "SELECT * FROM lending_agreement WHERE lending_terms_id = ? AND applications_id = ?";
    $params = [$lendingTermsId, $applicationsId];
    $paramTypes = "ii";

    if (!empty($searchAgreements)) {
        $query .= " AND (lendername LIKE ? OR borrowername LIKE ? OR mobile LIKE ? OR amount LIKE ? OR interest LIKE ? OR term LIKE ? OR monthly LIKE ? OR collateral LIKE ? OR created_at LIKE ? OR updated_at LIKE ?)";
        $searchTerm = '%' . $searchAgreements . '%';
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
    $agreements = mysqli_fetch_all($resultData, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    return $agreements;
}

function getFinancialDetails($connection, $borrowername, $searchFinancialDetails = '') {
    $query = "SELECT * FROM financial_details WHERE borrowername = ?";
    $params = [$borrowername];
    $paramTypes = "s";

    if (!empty($searchFinancialDetails)) {
        $query .= " AND (lendername LIKE ? OR borrowername LIKE ? OR mobile LIKE ? OR amount LIKE ? OR interest LIKE ? OR term LIKE ? OR monthly LIKE ? OR status LIKE ? OR created_at LIKE ? OR updated_at LIKE ?)";
        $searchTerm = '%' . $searchFinancialDetails . '%';
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
    $financials = mysqli_fetch_all($resultData, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    return $financials;
}



?>