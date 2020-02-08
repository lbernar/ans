<?php   
include_once "functions/db-connect.php";
session_start(); //to ensure you are using same session
session_unset();
session_destroy();
header("location:login-page.php"); //to redirect back to "index.php" after logging out
exit();
?>
