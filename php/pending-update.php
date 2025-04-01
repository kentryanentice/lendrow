<?php
include 'users-pending-session.php';
include 'pending-update-functions.php';

if (isset($_SESSION['last_submission_time']) && time() - $_SESSION['last_submission_time'] < 5) {
    header("Location: ../pending?error=duplicate_submission");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['id'], $_FILES['primaryid'], $_FILES['primaryid2'])) {
        header("Location: ../pending?error=missing_fields");
        exit();
    }

    $id = filter_var($_POST["id"], FILTER_VALIDATE_INT);
	$picture = $_FILES['primaryid'];
	$picture2 = $_FILES['primaryid2'];
	
	if (emptyPicture($picture) !== false) {
        header("Location: ../pending?error=emptypicture");
        exit();
    }
	
	if (emptyPicture2($picture2) !== false) {
        header("Location: ../pending?error=emptypicture");
        exit();
    }
	
	if (invalidSize($picture) !== false) {
        header("Location: ../pending?error=invalidsize");
        exit();
    }
	
	if (invalidSize2($picture2) !== false) {
        header("Location: ../pending?error=invalidsize");
        exit();
    }
	
	if (invalidFormat($picture) !== false) {
		header("Location: ../pending?error=invalidformat");
		exit();
	}
	
	if (invalidFormat2($picture2) !== false) {
		header("Location: ../pending?error=invalidformat");
		exit();
	}

    if ($id === false) {
        header("Location: ../pending?error=invalid_id");
        exit();
    }

    pendingUpdate($connection, $id);
	
	$_SESSION['last_submission_time'] = time();
	exit();
	
} else {
    header("Location: ../pending");
    exit();
}

?>