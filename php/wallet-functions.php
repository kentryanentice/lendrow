<?php
include 'user-session.php';

	$username = $_SESSION['username'];

	$queryUserData = "SELECT * FROM users WHERE username='$username'";
	$resultUserData = mysqli_query($connection, $queryUserData);

	if ($resultUserData) {
		$userData = mysqli_fetch_assoc($resultUserData);

		$userId = $userData['id'];
		$queryWallet = "SELECT balance FROM wallet WHERE users_id='$userId'";
			$resultWallet = mysqli_query($connection, $queryWallet);

			if ($resultWallet) {
				$walletData = mysqli_fetch_assoc($resultWallet);
				$userBalance = $walletData['balance'];
			} else {
				echo "Error retrieving user wallet data!" . mysqli_error($connection);
			}
		} else {
			echo "Error retrieving user data!" . mysqli_error($connection);
		}

function getWallet($connection, $userId, $searchWallet = '') {
    $query = "SELECT * FROM wallet WHERE users_id = ?";
    $params = [$userId];
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

function getRequest($connection, $userId, $searchRequest = '') {
    $query = "SELECT * FROM cash_transactions WHERE wallet_id = ?";
    $params = [$userId];
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

function getTransactions($connection, $userId, $searchTransactions = '') {
    $query = "SELECT * FROM wallet_transactions WHERE receiver_wallet_id = ? OR sender_wallet_id = ?";
    $params = [$userId, $userId];
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