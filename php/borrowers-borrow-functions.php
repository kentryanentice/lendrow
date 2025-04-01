<?php
include 'user-session.php';

function isClosed($connection, $lendingtermsid) {
    $query = "SELECT id FROM lending_terms WHERE id = ? AND status = 'Closed'";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../borrowers?error=stmtfailed");
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $lendingtermsid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $isClosed = mysqli_stmt_num_rows($stmt) > 0;

    mysqli_stmt_close($stmt);

    return $isClosed;
}

function isLender($connection, $lendingtermsid, $id) {
    $query = "SELECT id FROM lending_terms WHERE id = ? AND users_id = ?";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../borrowers?error=stmtfailed");
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ii", $lendingtermsid, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $isLender = mysqli_stmt_num_rows($stmt) > 0;

    mysqli_stmt_close($stmt);

    return $isLender;
}

function existingApproved($connection, $id) {
	$query = "SELECT id FROM applications WHERE users_id = ? AND status = 'Approved'";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../borrowers?error=stmtfailed");
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $existingApproved = mysqli_stmt_num_rows($stmt) > 0;

    mysqli_stmt_close($stmt);

    return $existingApproved;
}

function existingDebt($connection, $id) {
	$query = "SELECT id FROM applications WHERE users_id = ? AND status = 'Funded'";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../borrowers?error=stmtfailed");
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $existingDebt = mysqli_stmt_num_rows($stmt) > 0;

    mysqli_stmt_close($stmt);

    return $existingDebt;
}

function emptyPicture($collateral) {
    if (empty($collateral["name"])) {
        return true;
	} else {
        return false;		
 }
}
	
function invalidSize($collateral) {
    $maxFileSize = 2 * 1024 * 1024;
    if ($collateral["size"] > $maxFileSize) {
        return true;
    } else {
        return false;
    }
}

function invalidFormat($collateral) {
    $allowedFormats = array("jpg", "jpeg", "png", "gif");

    $fileExtension = strtolower(pathinfo($collateral["name"], PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedFormats)) {
        return false;
    } else {
        return true;
    }
}


function borrow($connection, $picture, $borrowername, $mobile, $lendingtermsid, $id) {
	$existingAppQuery = "SELECT id FROM applications WHERE lending_terms_id = ? AND users_id = ? AND (status <> 'Cancelled' AND status <> 'Rejected' AND status <> 'Paid' OR status IS NULL)";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $existingAppQuery)) {
        header("location: ../borrowers?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii", $lendingtermsid, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        header("location: ../borrowers?error=existingapplication");
        exit();
    }

    mysqli_stmt_close($stmt);
	
	$collateral = $_FILES['collateral'];
    $uploadDir = "../collaterals/";
	
	$collateralPath = $uploadDir . uniqid("collateral_", true) . "." . pathinfo($collateral['name'], PATHINFO_EXTENSION);
	
	 if (move_uploaded_file($collateral['tmp_name'], $collateralPath)) {
		$query = "INSERT INTO applications (picture, borrowername, mobile, collateral, status, lending_terms_id, users_id) VALUES (?,?,?,?,?,?,?)";
		$stmt = mysqli_stmt_init($connection);
		
		if (!mysqli_stmt_prepare($stmt, $query)) {
			header("location: ../borrowers?error=stmtfailed");
            exit();
		}
			
		$status = 'Pending';
		mysqli_stmt_bind_param($stmt, "sssssii", $picture, $borrowername, $mobile, $collateralPath, $status, $lendingtermsid, $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		header("location: ../borrowers?success=applied");
		exit();
	} else {
			header("location: ../borrowers?error=applyfailed");
			exit();
	}
}

function cancel($connection, $decodedApplicationsId, $decodedLendingTermsId, $decodedApplicationsUsersId) {
		$query = "UPDATE applications SET status = 'Cancelled' WHERE id = ? AND lending_terms_id = ? AND users_id = ?";
		$stmt = mysqli_stmt_init($connection);
		
		if (!mysqli_stmt_prepare($stmt, $query)) {
			header("location: ../borrowers?error=stmtfailed");
            exit();
		}
			
		$status = 'Pending';
		mysqli_stmt_bind_param($stmt, "iii", $decodedApplicationsId, $decodedLendingTermsId, $decodedApplicationsUsersId);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		header("location: ../borrowers?success=cancelled");
		exit();
}

?>