<?php
include 'user-session.php';

function pay($connection, $decodedPaymentsId, $decodedApplicationsId, $decodedLenderName, $decodedBorrowerName, $decodedMobile, $decodedMonthly, $userId, $decodedMonth, $month) {
	if (!hasEnoughBalance($connection, $decodedBorrowerName, $decodedMonthly, $decodedMobile, $userId)) {
		header("location: ../payments?error=insufficientbalance");
		exit();
	}

	$termQuery = "SELECT term FROM financial_details WHERE id = ? AND lendername = ? AND borrowername = ? AND mobile = ? AND applications_id = ?";
    $stmtTerm = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmtTerm, $termQuery)) {
        header("location: ../payments?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmtTerm, "isssi", $decodedPaymentsId, $decodedLenderName, $decodedBorrowerName, $decodedMobile, $decodedApplicationsId);
    mysqli_stmt_execute($stmtTerm);
    $resultTerm = mysqli_stmt_get_result($stmtTerm);
    $rowTerm = mysqli_fetch_assoc($resultTerm);

    if ($rowTerm['term'] === '1 Month') {
        $statusUpdate = "UPDATE financial_details SET status = 'Paid', updated_at_month_1 = CURRENT_TIMESTAMP, updated_at = CURRENT_TIMESTAMP WHERE term = '1 Month' AND id = ? AND lendername = ? AND borrowername = ? AND mobile = ? AND applications_id = ?;";
        $stmtStatusUpdate = mysqli_stmt_init($connection);

		if (!mysqli_stmt_prepare($stmtStatusUpdate, $statusUpdate)) {
			header("location: ../payments?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmtStatusUpdate, "isssi", $decodedPaymentsId, $decodedLenderName, $decodedBorrowerName, $decodedMobile, $decodedApplicationsId);
		mysqli_stmt_execute($stmtStatusUpdate);
		mysqli_stmt_close($stmtStatusUpdate);
	
		$applicationUpdate = "UPDATE applications SET status = 'Paid', updated_at = CURRENT_TIMESTAMP WHERE id = ? AND borrowername = ? AND mobile = ? AND users_id = ?;";
        $stmtApplicationUpdate = mysqli_stmt_init($connection);

        if (!mysqli_stmt_prepare($stmtApplicationUpdate, $applicationUpdate)) {
            header("location: ../payments?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmtApplicationUpdate, "issi", $decodedApplicationsId, $decodedBorrowerName, $decodedMobile, $userId);
        mysqli_stmt_execute($stmtApplicationUpdate);
        mysqli_stmt_close($stmtApplicationUpdate);
		
		$lendingAgreementUpdate = "UPDATE lending_agreement SET updated_at = CURRENT_TIMESTAMP WHERE lendername = ? AND borrowername = ? AND mobile = ? AND applications_id = ?;";
		$stmtLendingAgreementUpdate = mysqli_stmt_init($connection);

		if (!mysqli_stmt_prepare($stmtLendingAgreementUpdate, $lendingAgreementUpdate)) {
			header("location: ../payments?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmtLendingAgreementUpdate, "sssi", $decodedLenderName, $decodedBorrowerName, $decodedMobile, $decodedApplicationsId);
		mysqli_stmt_execute($stmtLendingAgreementUpdate);
		mysqli_stmt_close($stmtLendingAgreementUpdate);
	}	
	
	$paymentUpdate = "UPDATE financial_details SET month_1 = 'Paid', updated_at_month_1 = CURRENT_TIMESTAMP, updated_at = CURRENT_TIMESTAMP WHERE id = ? AND lendername = ? AND borrowername = ? AND mobile = ? AND applications_id = ?;";
	$stmtPaymentUpdate = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmtPaymentUpdate, $paymentUpdate)) {
        header("location: ../payments?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmtPaymentUpdate, "isssi", $decodedPaymentsId, $decodedLenderName, $decodedBorrowerName, $decodedMobile, $decodedApplicationsId);
    mysqli_stmt_execute($stmtPaymentUpdate);
    mysqli_stmt_close($stmtPaymentUpdate);
		
	$senderCurrentBalance = getCurrentBalance($connection, $decodedBorrowerName, $decodedMobile, $userId);

    $senderNewBalance = number_format((float) str_replace(',', '', $senderCurrentBalance) - (float) str_replace(',', '', $decodedMonthly), 2, '.', ',');

    $queryDeduct = "UPDATE wallet SET balance = ?, updated_at = CURRENT_TIMESTAMP WHERE fullname = ? AND mobile = ? AND users_id = ?;";
    $stmtDeduct = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmtDeduct, $queryDeduct)) {
        header("location: ../payments?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmtDeduct, "sssi", $senderNewBalance, $decodedBorrowerName, $decodedMobile, $userId);
    mysqli_stmt_execute($stmtDeduct);
    mysqli_stmt_close($stmtDeduct);
	
	$receiverCurrentBalance = getReceiverCurrentBalance($connection, $decodedLenderName);

    $receiverNewBalance = number_format((float) str_replace(',', '', $receiverCurrentBalance) + (float) str_replace(',', '', $decodedMonthly), 2, '.', ',');

    $query = "UPDATE wallet SET balance = ?, updated_at = CURRENT_TIMESTAMP WHERE fullname = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../payments?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $receiverNewBalance, $decodedLenderName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

	$amount = number_format((float) str_replace(',', '', $decodedMonthly), 2, '.', ',');
    $transferMethod = 'Paid';
    $receiverWalletId = getReceiverWalletId($connection, $decodedLenderName);
	$senderWalletId = getSenderWalletId($connection, $decodedBorrowerName, $decodedMobile, $userId);

    $queryInsert = "INSERT INTO wallet_transactions (sender, mobile, amount, receiver, transfer_method, receiver_wallet_id, sender_wallet_id) VALUES (?,?,?,?,?,?,?)";
    $stmtInsert = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmtInsert, $queryInsert)) {
        header("location: ../payments?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmtInsert, "sssssii", $decodedBorrowerName, $decodedMobile, $decodedMonthly, $decodedLenderName, $transferMethod, $receiverWalletId, $senderWalletId);
    mysqli_stmt_execute($stmtInsert);
    mysqli_stmt_close($stmtInsert);

    header("location: ../payments?success=paid");
    exit();
}

function hasEnoughBalance($connection, $decodedBorrowerName, $decodedMonthly, $decodedMobile, $userId) {
    $currentBalance = getCurrentBalance($connection, $decodedBorrowerName, $decodedMobile, $userId);

    return (float) str_replace(',', '', $currentBalance) >= (float) str_replace(',', '', $decodedMonthly);
}

function getCurrentBalance($connection, $decodedBorrowerName, $decodedMobile, $userId) {
    $query = "SELECT balance FROM wallet WHERE fullname = ? AND mobile = ? AND id = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../payments?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssi", $decodedBorrowerName, $decodedMobile, $userId);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['balance'];
    } else {
        header("location: ../payments?error=balancenotfound");
        exit();
    }

    mysqli_stmt_close($stmt);
}

function isMonthPaid($connection, $decodedPaymentsId, $decodedMonth) {
    $query = "SELECT $decodedMonth FROM financial_details WHERE id = ?";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../payments?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $decodedPaymentsId);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row[$decodedMonth] === 'Paid';
    } else {
        header("location: ../payments?error=recordnotfound");
        exit();
    }
}

function getReceiverCurrentBalance($connection, $decodedLenderName) {
    $query = "SELECT balance FROM wallet WHERE fullname = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../payments?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $decodedLenderName);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['balance'];
    } else {
        header("location: ../payments?error=balancenotfound");
        exit();
    }

    mysqli_stmt_close($stmt);
}

function getReceiverWalletId($connection, $decodedLenderName) {
    $query = "SELECT id FROM wallet WHERE fullname = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../payments?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $decodedLenderName);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['id'];
    } else {
        header("location: ../payments?error=walletidnotfound");
        exit();
    }

    mysqli_stmt_close($stmt);
}

function getSenderWalletId($connection, $decodedBorrowerName, $decodedMobile, $userId) {
	$query = "SELECT id FROM wallet WHERE fullname = ? AND mobile = ? AND users_id = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../payments?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssi", $decodedBorrowerName, $decodedMobile, $userId);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['id'];
    } else {
        header("location: ../payments?error=senderidnotfound");
        exit();
    }

    mysqli_stmt_close($stmt);
}
?>