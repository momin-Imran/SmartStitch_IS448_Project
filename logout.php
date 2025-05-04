<?php

include_once('config.php');

// Author: Adams Ubini
// Description: Logs out the user by destroying the session and redirecting to login

session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to login page or homepage

header("Location: $BASE_URL/index.php");
exit();
?>