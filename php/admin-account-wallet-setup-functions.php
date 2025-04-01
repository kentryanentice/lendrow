<?php
include 'admin-session.php';

function accountSetup($connection, $adminwalletname) {
	$virtualBalance = '0.00';
	$systemBalance = '0.00';

    $queryInsert = "INSERT INTO admin_wallet (admin_wallet_name, virtual_balance, system_balance) VALUES (?,?,?)";
    $stmtInsert = mysqli_stmt_init($connection);
	
    if (!mysqli_stmt_prepare($stmtInsert, $queryInsert)) {
        header("location: ../admin-account-wallet?error=stmtfailed");
        exit();
    }
	
    mysqli_stmt_bind_param($stmtInsert, "sss", $adminwalletname, $virtualBalance, $systemBalance);
    mysqli_stmt_execute($stmtInsert);
    mysqli_stmt_close($stmtInsert);

    header("location: ../admin-account-wallet?success=setup");
    exit();
}

?>