<?php
include 'admin-session.php';
include 'update-profile-functions.php';

if (isset($_SESSION['last_submission_time']) && time() - $_SESSION['last_submission_time'] < 5) {
    header("Location: ../admin-profile?error=duplicate_submission");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['id'], $_FILES['profile'])) {
        header("Location: ../admin-profile?error=missing_fields");
        exit();
    }

    $id = filter_var($_POST["id"], FILTER_VALIDATE_INT);
	$picture = $_FILES["profile"];
	
	if (emptyPicture($picture) !== false) {
        header("Location: ../admin-profile?error=emptyreceipt");
        exit();
    }
	
	if (invalidSize($picture) !== false) {
        header("Location: ../admin-profile?error=invalidsize");
        exit();
    }
	
	if (invalidFormat($picture) !== false) {
		header("Location: ../admin-profile?error=invalidformat");
		exit();
	}

    if ($id === false) {
        header("Location: ../admin-profile?error=invalid_id");
        exit();
    }

    updateProfile($connection, $id);
	
	$_SESSION['last_submission_time'] = time();
	exit();
	
} else {
    header("Location: ../admin-profile");
    exit();
}
