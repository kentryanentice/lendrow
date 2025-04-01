<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['username'])) {
    if (isset($_SESSION['Pending']) || isset($_SESSION['Verifying'])) {
        header("Location: ./pending");
        exit;
    } elseif (isset($_SESSION['User'])) {
        header("Location: ./profile");
        exit;
    } elseif (isset($_SESSION['Admin'])) {
        header("Location: ./admin-profile");
        exit;
    }
}

?>