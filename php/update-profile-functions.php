<?php
include 'admin-session.php';

function emptyPicture($picture) {
    if (empty($picture["name"])) {
        return true;
	} else {
        return false;		
 }
}
	
function invalidSize($picture) {
    $maxFileSize = 2 * 1024 * 1024;
    if ($picture["size"] > $maxFileSize) {
        return true;
    } else {
        return false;
    }
}

function invalidFormat($picture) {
    $allowedFormats = array("jpg", "jpeg", "png", "gif");

    $fileExtension = strtolower(pathinfo($picture["name"], PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedFormats)) {
        return false;
    } else {
        return true;
    }
}

function updateProfile($connection, $id) {
	
    $profile = $_FILES['profile'];
    $uploadDir = "../pictures/";

    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true)) {
        header("Location: ../admin-profile?error=directory_create_failed");
        exit();
    }

    $profilePath = $uploadDir . uniqid("profile_", true) . "." . pathinfo($profile['name'], PATHINFO_EXTENSION);

    if (move_uploaded_file($profile['tmp_name'], $profilePath)) {
		
		$query = "UPDATE users SET picture = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
		$stmt = mysqli_stmt_init($connection);

		if (!mysqli_stmt_prepare($stmt, $query)) {
			header("Location: ../admin-profile?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "si", $profilePath, $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		header("Location: ../admin-profile?success=uploaded");
			exit();
	} else {

		header("Location: ../admin-profile?error=movefailed");
		exit();
    }
}
?>
