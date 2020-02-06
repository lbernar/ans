<?php   
include_once "functions/db-connect.php";
session_start(); //to ensure you are using same session
$userId = $_SESSION['userProfile']['user_id'];

$query = $db->prepare("UPDATE users SET token = '' WHERE id = :user_id");
$query->bindValue(':user_id', $userId);
$query->execute();
$_SESSION['userProfile']['token'] = '';
session_unset();
session_destroy();
header("location:login-page.php"); //to redirect back to "index.php" after logging out
exit();
?>
