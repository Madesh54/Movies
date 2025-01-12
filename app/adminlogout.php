<?php
session_start();

// Destroy the session to log out the user
session_destroy();

// Redirect to logout success message
header("Location: adminlogout-success.php");
exit;
?>