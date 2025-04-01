<?php
include '../php/user-session.php';
include '../php/wallet-functions.php';
?>

	<input type="text" id="balance" value="<?php echo htmlspecialchars($userBalance); ?>" readonly>