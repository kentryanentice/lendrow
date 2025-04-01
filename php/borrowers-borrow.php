<?php
include 'user-session.php';
include 'borrowers-borrow-functions.php';

if (isset($_SESSION['last_submission_time']) && time() - $_SESSION['last_submission_time'] < 5) {
    header("Location: ../borrowers?error=duplicate_submission");
    exit();
}

function decodeId($encodedData, $secret_key) {
    $decodedData = base64_decode($encodedData);
    $ivLength = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($decodedData, 0, $ivLength);
    $encrypted = substr($decodedData, $ivLength);
    $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $secret_key, 0, $iv);
    return $decrypted;
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["collateral"])) {	
	$id = $user['id'];
    $picture = $user['picture'];
	$borrowername = $user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname'];
	$mobile = $user["mobile"];
	$lendingtermsid = $_POST['lending-terms-id'];
	$collateral = $_FILES["collateral"];
	
	if ($id === false) {
		header("Location: ../borrowers?error=invalidid");
        exit();
	}
	
	if(isClosed($connection, $lendingtermsid) !== false) {
		header("location: ../borrowers?error=closedlending");
		exit();
	}
	
	if(isLender($connection, $lendingtermsid, $id) !== false) {
		header("location: ../borrowers?error=ownlending");
		exit();
	}
		
	if(existingApproved($connection, $id) !== false) {
		header("location: ../borrowers?error=existingapproved");
		exit();
	}

	if(existingDebt($connection, $id) !== false) {
		header("location: ../borrowers?error=existingdebt");
		exit();
	}
	
	if (emptyPicture($collateral) !== false) {
        header("Location: ../borrowers?error=emptycollateral");
        exit();
    }
	
	if (invalidSize($collateral) !== false) {
        header("Location: ../borrowers?error=invalidsize");
        exit();
    }
	
	if (invalidFormat($collateral) !== false) {
		header("Location: ../borrowers?error=invalidformat");
		exit();
	}
	
	borrow($connection, $picture, $borrowername, $mobile, $lendingtermsid, $id);

	$_SESSION['last_submission_time'] = time();
	exit();
	
} 

elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cancel"])) {

	$decodedLendingTermsId = decodeId($_POST['lending_terms_id'], $secret_key);
	$decodedApplicationsId = decodeId($_POST['application_id'], $secret_key);
	$decodedApplicationsUsersId = decodeId($_POST['users_id'], $secret_key);
	
	if (!ctype_digit($decodedLendingTermsId) || !ctype_digit($decodedApplicationsId) || !ctype_digit($decodedApplicationsUsersId)) {
        header("Location: ../borrowers?error=invalidform");
        exit();
    }
	
	cancel($connection, $decodedApplicationsId, $decodedLendingTermsId, $decodedApplicationsUsersId);
	
	$_SESSION['last_submission_time'] = time();
	exit();
	
} else {
    header("Location: ../borrowers");
    exit();
}
?>