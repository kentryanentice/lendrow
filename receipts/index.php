<?php
session_start();

include '../php/config.php';

if (!isset($_SESSION['username']) || !$_SESSION['Admin']) {
	session_unset();
	session_destroy();
    header("Location: ../home?error=unauthorizedaccess");
    exit;
}
else {
	header("Location: ../home");
    exit;
}

?>