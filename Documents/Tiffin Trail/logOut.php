<?php
session_start();
// Destroy the session
session_unset();
session_destroy();
// Redirect to the login or home page
header("Location: regiStration.php");
exit();
?>
