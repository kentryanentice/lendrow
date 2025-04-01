<?php
include 'admin-session.php';
include 'admin-payments-monthly11-functions.php';

if (isset($_SESSION['last_submission_time']) && time() - $_SESSION['last_submission_time'] < 5) {
    header("Location: ../admin-payments?error=duplicate_submission");
    exit();
}

$_SESSION['last_submission_time'] = time();

function decodeId($encodedData, $secret_key) {
    $decodedData = base64_decode($encodedData);
    $ivLength = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($decodedData, 0, $ivLength);
    $encrypted = substr($decodedData, $ivLength);
    $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $secret_key, 0, $iv);
    return $decrypted;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["pay"])) {
	$adminId = $admin['id'];
	$decodedPaymentsId = decodeId($_POST['payments_id'], $secret_key);
	$decodedApplicationsId = decodeId($_POST['applications_id'], $secret_key);
	$decodedLenderName = decodeId($_POST['lendername'], $secret_key);
	$decodedBorrowerName = decodeId($_POST['borrowername'], $secret_key);
	$decodedMobile = decodeId($_POST['mobile'], $secret_key);
	$decodedMonthly = decodeId($_POST['monthly'], $secret_key);
	$decodedMonth = decodeId($_POST['month'], $secret_key);
	$month = $_POST['month_number'];
	
	if (!ctype_digit($decodedPaymentsId) || !ctype_digit($decodedApplicationsId)) {
        header("Location: ../admin-payments?error=invalidform");
        exit();
    }
	
	pay($connection, $decodedPaymentsId, $decodedApplicationsId, $decodedLenderName, $decodedBorrowerName, $decodedMobile, $decodedMonthly, $adminId, $decodedMonth, $month);

	$_SESSION['last_submission_time'] = time();
	exit();
} 

else {
    header("location: ../admin-payments");
    exit();
}

?>