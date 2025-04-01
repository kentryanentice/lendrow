<?php
include 'admin-session.php';

function approve($connection, $adminname, $amount, $id) {
	
	$existingAppQuery = "SELECT id FROM cash_transactions WHERE method = 'CashOut' AND status = 'Approved'";
    $stmtAppQuery = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmtAppQuery, $existingAppQuery)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_execute($stmtAppQuery);
    mysqli_stmt_store_result($stmtAppQuery);

    if (mysqli_stmt_num_rows($stmtAppQuery) > 0) {
        header("location: ../admin-account-wallet?error=existingcashoutapproval");
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

    header("location: ../admin-account-wallet?success=approvedcashout");
    exit();
}

function reject($connection, $adminname, $amount, $receiver, $mobile, $id) {

    $query = "UPDATE cash_transactions SET status = 'Rejected', updated_at = CURRENT_TIMESTAMP WHERE id = ?";

    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
	
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
    $transferMethod = 'Refunded';
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

    header("location: ../admin-account-wallet?success=rejectedcashout");
    exit();
}

function emptyPicture($receipt) {
    if (empty($receipt["name"])) {
        return true;
	} else {
        return false;		
 }
}
	
function invalidSize($receipt) {
    $maxFileSize = 2 * 1024 * 1024;
    if ($receipt["size"] > $maxFileSize) {
        return true;
    } else {
        return false;
    }
}

function invalidFormat($receipt) {
    $allowedFormats = array("jpg", "jpeg", "png", "gif");

    $fileExtension = strtolower(pathinfo($receipt["name"], PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedFormats)) {
        return false;
    } else {
        return true;
    }
}

function cashout($connection, $adminname, $amount, $receiver, $mobile, $receipt, $id) {
	$receipt = $_FILES['receipt'];
    $uploadDir = "../receipts/";

    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true)) {
        header("Location: ../admin-account-wallet?error=directory_create_failed");
        exit();
    }

    $receiptPath = $uploadDir . uniqid("receipt_", true) . "." . pathinfo($receipt['name'], PATHINFO_EXTENSION);
	
	if (move_uploaded_file($receipt['tmp_name'], $receiptPath)) {
		
	$query = "UPDATE cash_transactions SET status = 'Deducted', receipt = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
	$stmt = mysqli_stmt_init($connection);

	if (!mysqli_stmt_prepare($stmt, $query)) {
		header("location: ../admin-account-wallet?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "si", $receiptPath, $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	$newAmount = number_format((float) str_replace(',', '', $amount), 2, '.', ',');
	$transferMethod = 'Deducted';
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
	
	$currentVirtualBalance = getCurrentVirtualBalance($connection, $adminname);
	$currentSystemBalance = getCurrentSystemBalance($connection, $adminname);
	
	$processingFee = number_format((float) str_replace(',', '', 10.00), 2, '.', ',');
	$amountAfterFee = number_format((float) str_replace(',', '', $amount) - $processingFee, 2, '.', ',');

	$newVirtualBalance = number_format((float) str_replace(',', '', $currentVirtualBalance) + $processingFee, 2, '.', ',');
	$newSystemBalance = number_format((float) str_replace(',', '', $currentSystemBalance) - $amountAfterFee, 2, '.', ',');

	$queryAdd = "UPDATE admin_wallet SET virtual_balance = ?, system_balance = ?, updated_at = CURRENT_TIMESTAMP WHERE admin_wallet_name = ?;";
	$stmtAdd = mysqli_stmt_init($connection);

	if (!mysqli_stmt_prepare($stmtAdd, $queryAdd)) {
		header("location: ../admin-account-wallet?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmtAdd, "sss", $newVirtualBalance, $newSystemBalance, $adminname);
	mysqli_stmt_execute($stmtAdd);
	mysqli_stmt_close($stmtAdd);
			
	$newAmount = number_format((float) str_replace(',', '', $amount), 2, '.', ',');
	$status = 'Added';
	$transferMethod = 'CashOut';
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
			
		header("location: ../admin-account-wallet?success=cashout");
		exit();
	}
	
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

function getCurrentSystemBalance($connection, $adminname) {
    $query = "SELECT system_balance FROM admin_wallet WHERE admin_wallet_name = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $adminname);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['system_balance'];
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