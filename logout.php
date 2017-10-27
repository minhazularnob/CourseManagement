<?php
	require_once 'database.php';
    unset($_SESSION["user"]);
    session_destroy();
    header("Location: register.php");
    exit;
?>