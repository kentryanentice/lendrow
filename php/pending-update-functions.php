<?php
include 'users-pending-session.php';

function emptyPicture($picture) {
    if (empty($picture["name"])) {
        return true;
	} else {
        return false;		
 }
}

function emptyPicture2($picture2) {
    if (empty($picture2["name"])) {
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

function invalidSize2($picture2) {
    $maxFileSize = 2 * 1024 * 1024;
    if ($picture2["size"] > $maxFileSize) {
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

function invalidFormat2($picture2) {
    $allowedFormats = array("jpg", "jpeg", "png", "gif");

    $fileExtension = strtolower(pathinfo($picture2["name"], PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedFormats)) {
        return false;
    } else {
        return true;
    }
}

function pendingUpdate($connection, $id) {
	$idQuery = "SELECT id FROM users WHERE  id = ? AND usertype = 'User'";
	$idstmt = mysqli_stmt_init($connection);
	
	if (!mysqli_stmt_prepare($idstmt, $idQuery)) {
		header("Location: ../pending?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($idstmt, "i", $id);
	mysqli_stmt_execute($idstmt);
    mysqli_stmt_store_result($idstmt);

	 if (mysqli_stmt_num_rows($idstmt) > 0) {
		mysqli_stmt_close($idstmt);
        header("location: ../pending?success=verified");
        exit();
    }
	
	mysqli_stmt_close($idstmt);
	
    $primaryid = $_FILES['primaryid'];
    $primaryid2 = $_FILES['primaryid2'];
    $uploadDir = "../pictures/";

    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true)) {
        header("Location: ../pending?error=directory_create_failed");
        exit();
    }

    $primaryidPath = $uploadDir . uniqid("primary_", true) . "." . pathinfo($primaryid['name'], PATHINFO_EXTENSION);
    $primaryid2Path = $uploadDir . uniqid("secondary_", true) . "." . pathinfo($primaryid2['name'], PATHINFO_EXTENSION);

    if (move_uploaded_file($primaryid['tmp_name'], $primaryidPath) && move_uploaded_file($primaryid2['tmp_name'], $primaryid2Path)) {
		
		$query = "UPDATE users SET usertype = 'Verifying', primaryid = ?, primaryid2 = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
		$stmt = mysqli_stmt_init($connection);

		if (!mysqli_stmt_prepare($stmt, $query)) {
			header("Location: ../pending?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "ssi", $primaryidPath, $primaryid2Path, $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		header("Location: ../pending?success=uploaded");
			exit();
	} else {

		header("Location: ../pending?error=movefailed");
		exit();
    }
}
?>
