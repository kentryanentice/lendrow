<?php
include 'admin-session.php';
include 'admin-wallet-cashout-functions.php';

if (isset($_SESSION['last_submission_time']) && time() - $_SESSION['last_submission_time'] < 5) {
    handleCashOutError("duplicate_submission");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	
	$allowedMethods = ['Gcash', 'Maya'];
	
	$allowedAmounts = [30, 60, 110, 210, 510, 1010, 2010, 3010, 4010, 5010];

    $id = $admin['id'];
	$fullname = $admin['firstname'] . ' ' . $admin['middlename'] . ' ' . $admin['lastname'];
	$mobile = $admin["mobile"];
	$method = $_POST["admin-cashout-method"];
	$amount = $_POST["admin-cashout-amount"];

    if ($id === false) {
        handleCashOutError("invalidid");
        exit();
    }
	
	if (!in_array($method, $allowedMethods)) {
		handleCashOutError("invalidpaymentmethod");
		exit();
	}
	
	if (!in_array($amount, $allowedAmounts)) {
		handleCashOutError("invalidamount");
		exit();
	}

    cashOut($connection, $id, $fullname, $mobile, $method, $amount);
	
	$_SESSION['last_submission_time'] = time();
	exit();
	
} else {
    header("Location: $redirectUrl");
    exit();
}

function handleCashOutError($errorType) {
    $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'admin-wallet';
    $parsedUrl = parse_url($referrer);

    $path = $parsedUrl['path'];
    $query = isset($parsedUrl['query']) ? $parsedUrl['query'] : '';

    parse_str($query, $queryParams);
    unset($queryParams['error']);
	unset($queryParams['success']);
    $newQuery = http_build_query($queryParams);

    $redirectUrl = $path . ($newQuery ? '?' . $newQuery : '');

    if ($newQuery) {
        $redirectUrl .= '&error=' . $errorType;
    } else {
        $redirectUrl .= '?error=' . $errorType;
    }

    header("Location: $redirectUrl");
    exit();
}

function handleCashOutSuccess($successType) {
    $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'admin-wallet';
    $parsedUrl = parse_url($referrer);

    $path = $parsedUrl['path'];
    $query = isset($parsedUrl['query']) ? $parsedUrl['query'] : '';

    parse_str($query, $queryParams);
    unset($queryParams['error']);
	unset($queryParams['success']);
    $newQuery = http_build_query($queryParams);

    $redirectUrl = $path . ($newQuery ? '?' . $newQuery : '');

    if ($newQuery) {
        $redirectUrl .= '&success=' . $successType;
    } else {
        $redirectUrl .= '?success=' . $successType;
    }

    header("Location: $redirectUrl");
    exit();
}

?>