<?php
include 'admin-session.php';

function existingApproved($connection, $decodedApplicationsId, $decodedApplicationsUsersId) {
	$query = "SELECT id FROM applications WHERE id <> ? AND users_id = ? AND status = 'Approved'";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-lenders?error=stmtfailed");
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ii", $decodedApplicationsId, $decodedApplicationsUsersId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $existingApproved = mysqli_stmt_num_rows($stmt) > 0;

    mysqli_stmt_close($stmt);

    return $existingApproved;
}

function existingDebt($connection, $decodedApplicationsUsersId) {
	$query = "SELECT id FROM applications WHERE users_id = ? AND status = 'Funded'";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-lenders?error=stmtfailed");
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $decodedApplicationsUsersId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $existingDebt = mysqli_stmt_num_rows($stmt) > 0;

    mysqli_stmt_close($stmt);

    return $existingDebt;
}

function reject($connection, $decodedLendingTermsId, $decodedApplicationsId, $decodedApplicationsUsersId) {
	$query = "UPDATE applications SET status = 'Rejected', updated_at = CURRENT_TIMESTAMP WHERE id = ? AND lending_terms_id = ? AND users_id = ?";

    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-lenders?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iii", $decodedApplicationsId, $decodedLendingTermsId, $decodedApplicationsUsersId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../admin-lenders?success=rejected");
    exit();
}

function approve($connection, $adminId, $decodedLenderName, $decodedBorrowerName, $decodedMobile, $decodedAmount, $decodedInterest, $decodedTerm, $decodedMonthly, $decodedCollateral, $decodedLendingTermsId, $decodedApplicationsId, $decodedApplicationsUsersId) {
	$query = "UPDATE applications SET status = 'Approved', updated_at = CURRENT_TIMESTAMP WHERE id = ? AND lending_terms_id = ? AND users_id = ?";

    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-lenders?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iii", $decodedApplicationsId, $decodedLendingTermsId, $decodedApplicationsUsersId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
	
	$queryLending = "UPDATE lending_terms SET status = 'Closed' WHERE id = ? AND users_id = ?";
	
	$stmtLending = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmtLending, $queryLending)) {
        header("location: ../admin-lenders?error=stmtfailed");
        exit();
    }
	
	mysqli_stmt_bind_param($stmtLending, "ii",  $decodedLendingTermsId, $adminId);
    mysqli_stmt_execute($stmtLending);
    mysqli_stmt_close($stmtLending);
	
	$rejectQuery = "UPDATE applications SET status = 'Rejected', updated_at = CURRENT_TIMESTAMP WHERE status = 'Pending' AND id <> ? AND lending_terms_id = ?";
    $rejectStmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($rejectStmt, $rejectQuery)) {
        header("location: ../admin-lenders?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($rejectStmt, "ii", $decodedApplicationsId, $decodedLendingTermsId);
    mysqli_stmt_execute($rejectStmt);
    mysqli_stmt_close($rejectStmt);
	
	$insertQuery = "INSERT INTO lending_agreement (lendername, borrowername, mobile, amount, interest, term, monthly, collateral, lending_terms_id, applications_id) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $insertStmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($insertStmt, $insertQuery)) {
        header("location: ../admin-lenders?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($insertStmt, "ssssssssii", $decodedLenderName, $decodedBorrowerName, $decodedMobile, $decodedAmount, $decodedInterest, $decodedTerm, $decodedMonthly, $decodedCollateral, $decodedLendingTermsId, $decodedApplicationsId);
    mysqli_stmt_execute($insertStmt);
    mysqli_stmt_close($insertStmt);

    header("location: ../admin-lenders?success=approved");
    exit();
}

function disburse($connection, $adminId, $decodedPicture, $decodedLenderName, $decodedBorrowerName, $decodedMobile, $decodedAmount, $decodedInterest, $decodedTerm, $decodedMonthly, $decodedCollateral, $decodedLendingTermsId, $decodedApplicationsId, $decodedApplicationsUsersId, $decodedAgreementsId) {
	
	$query = "UPDATE applications SET status = 'Funded', updated_at = CURRENT_TIMESTAMP WHERE id = ? AND lending_terms_id = ? AND users_id = ?";
	
	$stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-lenders?error=stmtfailed");
        exit();
    }
	
	mysqli_stmt_bind_param($stmt, "iii", $decodedApplicationsId, $decodedLendingTermsId, $decodedApplicationsUsersId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
	
	$insertQuery = "INSERT INTO financial_details (picture, lendername, borrowername, mobile, amount, interest, term, monthly, lending_terms_id, applications_id, lending_agreements_id) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $insertStmt = mysqli_stmt_init($connection);
	
	if (!mysqli_stmt_prepare($insertStmt, $insertQuery)) {
        header("location: ../admin-lenders?error=stmtfailed");
        exit();
    }
	
	mysqli_stmt_bind_param($insertStmt, "ssssssssiii", $decodedPicture, $decodedLenderName, $decodedBorrowerName, $decodedMobile, $decodedAmount, $decodedInterest, $decodedTerm, $decodedMonthly, $decodedLendingTermsId, $decodedApplicationsId, $decodedAgreementsId);
    mysqli_stmt_execute($insertStmt);
    mysqli_stmt_close($insertStmt);
	
	$receiverCurrentBalance = getReceiverCurrentBalance($connection, $decodedMobile, $decodedApplicationsUsersId);

    $receiverNewBalance = number_format((float) str_replace(',', '', $receiverCurrentBalance) + (float) str_replace(',', '', $decodedAmount), 2, '.', ',');

    $query = "UPDATE wallet SET balance = ?, updated_at = CURRENT_TIMESTAMP WHERE mobile = ? AND users_id = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-lenders?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssi", $receiverNewBalance, $decodedMobile, $decodedApplicationsUsersId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
	
	$amount = number_format((float) str_replace(',', '', $decodedAmount), 2, '.', ',');
    $transferMethod = 'Disbursed';
    $receiverWalletId = getReceiverWalletId($connection, $decodedMobile, $decodedBorrowerName, $decodedApplicationsUsersId);
	$senderWalletId = getSenderWalletId($connection, $decodedLenderName, $adminId);

    $queryInsert = "INSERT INTO wallet_transactions (sender, mobile, amount, receiver, transfer_method, receiver_wallet_id, sender_wallet_id) VALUES (?,?,?,?,?,?,?)";
    $stmtInsert = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmtInsert, $queryInsert)) {
        header("location: ../admin-lenders?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmtInsert, "sssssii", $decodedLenderName, $decodedMobile, $decodedAmount, $decodedBorrowerName,  $transferMethod, $decodedApplicationsUsersId, $adminId);
    mysqli_stmt_execute($stmtInsert);
    mysqli_stmt_close($stmtInsert);
	
	header("location: ../admin-lenders?success=funded");
    exit();
}

function getReceiverCurrentBalance($connection, $decodedMobile, $decodedApplicationsUsersId) {
    $query = "SELECT balance FROM wallet WHERE mobile = ? AND users_id = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-lenders?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "si", $decodedMobile, $decodedApplicationsUsersId);
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

function getReceiverWalletId($connection, $decodedMobile, $decodedBorrowerName, $decodedApplicationsUsersId) {
    $query = "SELECT id FROM wallet WHERE mobile = ? AND fullname = ? AND users_id = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-lenders?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssi", $decodedMobile, $decodedBorrowerName, $decodedApplicationsUsersId);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['id'];
    } else {
        header("location: ../admin-lenders?error=walletidnotfound");
        exit();
    }

    mysqli_stmt_close($stmt);
}

function getSenderWalletId($connection, $decodedLenderName, $adminId) {
    $query = "SELECT id FROM wallet WHERE fullname = ? AND users_id = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-lenders?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "si", $decodedLenderName, $adminId);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['id'];
    } else {
        header("location: ../admin-lenders?error=senderidnotfound");
        exit();
    }

    mysqli_stmt_close($stmt);
}

?>