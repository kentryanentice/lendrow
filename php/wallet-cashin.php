<?php
include 'user-session.php';
include 'wallet-cashin-functions.php';

if (isset($_SESSION['last_submission_time']) && time() - $_SESSION['last_submission_time'] < 5) {
    handleCashInError("duplicate_submission");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['id'], $_FILES['cashin-receipt'])) {
        handleCashInError("missingfields");
        exit();
    }
	
	$allowedMethods = ['Gcash', 'Maya'];
	
	$allowedAmounts = [20, 50, 100, 200, 500, 1000, 2000, 3000, 4000, 5000];

    $id = $user['id'];
	$fullname = $user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname'];
	$mobile = $user["mobile"];
	$method = $_POST["user-cashin-method"];
	$amount = $_POST["user-cashin-amount"];
	$receipt = $_FILES["cashin-receipt"];

    if ($id === false) {
        handleCashInError("invalidid");
        exit();
    }
	
	if (!in_array($method, $allowedMethods)) {
		handleCashInError("invalidpaymentmethod");
		exit();
	}
	
	if (!in_array($amount, $allowedAmounts)) {
		handleCashInError("invalidamount");
		exit();
	}
	
	if (emptyPicture($receipt) !== false) {
        handleCashInError("emptyreceipt");
        exit();
    }
	
	if (invalidSize($receipt) !== false) {
        handleCashInError("invalidsize");
        exit();
    }
	
	if (invalidFormat($receipt) !== false) {
		handleCashInError("invalidformat");
		exit();
	}

    cashIn($connection, $id, $fullname, $mobile, $method, $amount);
	
	$_SESSION['last_submission_time'] = time();
	exit();
	
} else {
    header("Location: $redirectUrl");
    exit();
}

function handleCashInError($errorType) {
    $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'wallet';
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

function handleCashInSuccess($successType) {
    $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'wallet';
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