<?php
include 'user-session.php';
include 'lenders-application-approval-functions.php';

if (isset($_SESSION['last_submission_time']) && time() - $_SESSION['last_submission_time'] < 5) {
    header("Location: ../lenders?error=duplicate_submission");
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

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["approve"])) {
	$userId = $user['id'];
	$decodedLenderName = decodeId($_POST['lendername'], $secret_key);
	$decodedBorrowerName = decodeId($_POST['borrowername'], $secret_key);
	$decodedMobile = decodeId($_POST['mobile'], $secret_key);
	$decodedAmount = decodeId($_POST['amount'], $secret_key);
	$decodedInterest = decodeId($_POST['interest'], $secret_key);
	$decodedTerm = decodeId($_POST['term'], $secret_key);
	$decodedMonthly = decodeId($_POST['monthly'], $secret_key);
	$decodedCollateral = decodeId($_POST['collateral'], $secret_key);
	$decodedLendingTermsId = decodeId($_POST['lending_terms_id'], $secret_key);
	$decodedApplicationsId = decodeId($_POST['applications_id'], $secret_key);
	$decodedApplicationsUsersId = decodeId($_POST['users_id'], $secret_key);
	
	if (!ctype_digit($decodedLendingTermsId) || !ctype_digit($decodedApplicationsId) || !ctype_digit($decodedApplicationsUsersId)) {
        header("Location: ../lenders?error=invalidform");
        exit();
    }
	
	if(existingApproved($connection, $decodedApplicationsId, $decodedApplicationsUsersId) !== false) {
		header("location: ../lenders?error=existingapproved");
		exit();
	}

	if(existingDebt($connection, $decodedApplicationsUsersId) !== false) {
		header("location: ../lenders?error=existingdebt");
		exit();
	}

    approve($connection, $userId, $decodedLenderName, $decodedBorrowerName, $decodedMobile, $decodedAmount, $decodedInterest, $decodedTerm, $decodedMonthly, $decodedCollateral, $decodedLendingTermsId, $decodedApplicationsId, $decodedApplicationsUsersId);
	
	$_SESSION['last_submission_time'] = time();
	exit();
} 

else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reject"])) {
	$decodedLendingTermsId = decodeId($_POST['lending_terms_id'], $secret_key);
	$decodedApplicationsId = decodeId($_POST['applications_id'], $secret_key);
	$decodedApplicationsUsersId = decodeId($_POST['users_id'], $secret_key);

	if (!ctype_digit($decodedLendingTermsId) || !ctype_digit($decodedApplicationsId) || !ctype_digit($decodedApplicationsUsersId)) {
        header("Location: ../lenders?error=invalidform");
        exit();
    }

    reject($connection, $decodedLendingTermsId, $decodedApplicationsId, $decodedApplicationsUsersId);
	
	$_SESSION['last_submission_time'] = time();
	exit();
} 

elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["disburse"])) {
	$userId = $user['id'];
	$decodedPicture = decodeId($_POST['picture'], $secret_key);
	$decodedLenderName = decodeId($_POST['lendername'], $secret_key);
	$decodedBorrowerName = decodeId($_POST['borrowername'], $secret_key);
	$decodedMobile = decodeId($_POST['mobile'], $secret_key);
	$decodedAmount = decodeId($_POST['amount'], $secret_key);
	$decodedInterest = decodeId($_POST['interest'], $secret_key);
	$decodedTerm = decodeId($_POST['term'], $secret_key);
	$decodedMonthly = decodeId($_POST['monthly'], $secret_key);
	$decodedCollateral = decodeId($_POST['collateral'], $secret_key);
	$decodedLendingTermsId = decodeId($_POST['lending_terms_id'], $secret_key);
	$decodedApplicationsId = decodeId($_POST['applications_id'], $secret_key);
	$decodedApplicationsUsersId = decodeId($_POST['users_id'], $secret_key);
	$decodedAgreementsId = decodeId($_POST['agreements_id'], $secret_key);
	
	if (!ctype_digit($decodedLendingTermsId) || !ctype_digit($decodedApplicationsId) || !ctype_digit($decodedApplicationsUsersId)) {
        header("Location: ../lenders?error=invalidform");
        exit();
    }
	
	if(existingApproved($connection, $decodedApplicationsId, $decodedApplicationsUsersId) !== false) {
		header("location: ../lenders?error=existingapproved");
		exit();
	}

	if(existingDebt($connection, $decodedApplicationsUsersId) !== false) {
		header("location: ../lenders?error=existingdebt");
		exit();
	}
	
	disburse($connection, $userId, $decodedPicture, $decodedLenderName, $decodedBorrowerName, $decodedMobile, $decodedAmount, $decodedInterest, $decodedTerm, $decodedMonthly, $decodedCollateral, $decodedLendingTermsId, $decodedApplicationsId, $decodedApplicationsUsersId, $decodedAgreementsId);

	$_SESSION['last_submission_time'] = time();
	exit();
} 

else {
    header("location: ../lenders");
    exit();
}

?>