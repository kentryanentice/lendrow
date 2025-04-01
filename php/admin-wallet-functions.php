<?php
include 'admin-session.php';

	$username = $_SESSION['username'];

	$queryAdminData = "SELECT * FROM users WHERE username='$username'";
	$resultAdminData = mysqli_query($connection, $queryAdminData);

	if ($resultAdminData) {
		$adminData = mysqli_fetch_assoc($resultAdminData);

		$adminId = $adminData['id'];
		$queryWallet = "SELECT balance FROM wallet WHERE users_id='$adminId'";
			$resultWallet = mysqli_query($connection, $queryWallet);

			if ($resultWallet) {
				$walletData = mysqli_fetch_assoc($resultWallet);
				$adminBalance = $walletData['balance'];
			} else {
				echo "Error retrieving admin wallet data!" . mysqli_error($connection);
			}
		} else {
			echo "Error retrieving admin data!" . mysqli_error($connection);
		}

function getWallet($connection, $adminId, $searchWallet = '') {
    $query = "SELECT * FROM wallet WHERE users_id = ?";
    $params = [$adminId];
    $paramTypes = "i";

    if (!empty($searchWallet)) {
        $query .= " AND (fullname LIKE ? OR mobile LIKE ? OR balance LIKE ? OR created_at LIKE ?)";
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

    mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $wallet = mysqli_fetch_all($resultData, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    return $wallet;
}

function getRequest($connection, $adminId, $searchRequest = '') {
    $query = "SELECT * FROM cash_transactions WHERE wallet_id = ?";
    $params = [$adminId];
    $paramTypes = "i";

    if (!empty($searchRequest)) {
        $query .= " AND (name LIKE ? OR method LIKE ? OR payment_method LIKE ? OR amount LIKE ? OR payment_number LIKE ? OR receipt LIKE ? OR status LIKE ? OR created_at LIKE ?)";
        $searchTerm = '%' . $searchRequest . '%';
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
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
    $requests = mysqli_fetch_all($resultData, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    return $requests;
}

function getTransactions($connection, $adminId, $searchTransactions = '') {
    $query = "SELECT * FROM wallet_transactions WHERE receiver_wallet_id = ? OR sender_wallet_id = ?";
    $params = [$adminId, $adminId];
    $paramTypes = "ii";

    if (!empty($searchTransactions)) {
        $query .= " AND (sender LIKE ? OR mobile LIKE ? OR amount LIKE ? OR receiver LIKE ? OR transfer_method LIKE ? OR created_at LIKE ?)";
        $searchTerm = '%' . $searchTransactions . '%';
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
        $paramTypes .= "ssssss";
    }

    $query .= " ORDER BY created_at DESC";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../home?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $transactions = mysqli_fetch_all($resultData, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    return $transactions;
}
?>