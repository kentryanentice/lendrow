<?php
include '../php/admin-session.php';
include '../php/admin-wallet-functions.php';
?>

	<input type="text" id="balance" value="<?php echo htmlspecialchars($adminBalance); ?>" readonly>