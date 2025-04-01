<?php
include 'admin-session.php';

function  virtualCashIn($connection, $id, $amount) {
	$existingQuery = "SELECT id FROM admin_wallet_transactions WHERE admin_wallet_id = ? AND method = 'Virtual CashIn' AND (status <> 'Cancelled' AND status <> 'Added' OR status IS NULL)";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $existingQuery)) {
		header("Location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        header("Location: ../admin-account-wallet?error=existingvirtualcashin");
        exit();
    }

    mysqli_stmt_close($stmt);
	
	$query = "INSERT INTO admin_wallet_transactions (amount, status, method, admin_wallet_id) VALUES (?, 'Pending', 'Virtual CashIn', ?)";
	$stmt = mysqli_stmt_init($connection);
		
	if (!mysqli_stmt_prepare($stmt, $query)) {
		handleCashInError("stmtfailed");
           exit();
	}
			
		$newAmount = number_format((float) str_replace(',', '', $amount), 2, '.', ',');
		mysqli_stmt_bind_param($stmt, "si", $newAmount, $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		header("Location: ../admin-account-wallet?success=virtualcashedin");
		exit();
	}
?>