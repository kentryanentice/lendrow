<?php
include 'admin-session.php';

function verifyUser($connection, $id) {
	$idQuery = "SELECT id FROM users WHERE  id = ? AND primaryid IS NULL AND primaryid2 IS NULL";
	$idstmt = mysqli_stmt_init($connection);
	
	if (!mysqli_stmt_prepare($idstmt, $idQuery)) {
		header("Location: ../admin-accounts?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($idstmt, "i", $id);
	mysqli_stmt_execute($idstmt);
    mysqli_stmt_store_result($idstmt);

	 if (mysqli_stmt_num_rows($idstmt) > 0) {
		mysqli_stmt_close($idstmt);
        header("location: ../admin-accounts?error=nouploadedid");
        exit();
    }

    mysqli_stmt_close($idstmt);
	
	$query = "UPDATE users SET usertype = 'User', userbadge = 'Verified', updated_at = CURRENT_TIMESTAMP WHERE id = ?";
	$stmt = mysqli_stmt_init($connection);

	if (!mysqli_stmt_prepare($stmt, $query)) {
		header("Location: ../admin-accounts?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "i", $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	header("Location: ../admin-accounts?success=verified");
	exit();
}
?>