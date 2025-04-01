<?php
include 'user-session.php';

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

function cashIn($connection, $id, $fullname, $mobile, $method, $amount) {
	$existingAppQuery = "SELECT id FROM cash_transactions WHERE wallet_id = ? AND method = 'CashIn' AND (status <> 'Rejected' AND status <> 'Added' OR status IS NULL)";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $existingAppQuery)) {
		handleCashInError("stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        handleCashInError("existingcashin");
        exit();
    }

    mysqli_stmt_close($stmt);
	
	$receipt = $_FILES['cashin-receipt'];
    $uploadDir = "../receipts/";
	
	$receiptPath = $uploadDir . uniqid("receipt_", true) . "." . pathinfo($receipt['name'], PATHINFO_EXTENSION);
	
	 if (move_uploaded_file($receipt['tmp_name'], $receiptPath)) {
		$query = "INSERT INTO cash_transactions (fullname, method, payment_method, amount, mobile, payment_number, payment_account_name, receipt, wallet_id) VALUES (?, 'CashIn', ?, ?, ?, ?, ?, ?, ?)";
		$stmt = mysqli_stmt_init($connection);
		
		if (!mysqli_stmt_prepare($stmt, $query)) {
			handleCashInError("stmtfailed");
            exit();
		}
			
			$newAmount = number_format((float) str_replace(',', '', $amount), 2, '.', ',');
			mysqli_stmt_bind_param($stmt, "sssssssi", $fullname, $method, $newAmount, $mobile, $mobile, $fullname, $receiptPath, $id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);

			handleCashInSuccess("cashedin");
			exit();
	} else {
        handleCashInError("cashinfailed");
        exit();
    }	
}

?>