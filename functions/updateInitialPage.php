<?php
include "db-connect.php";
$db->beginTransaction();
$userId = $_POST['user_id'];
$statusQuest = $_SESSION['userProfile']['status_quest'];
if(empty($_POST['last_page']))
  $option = base64_encode("respondeQuestoes&page=0");
elseif(!empty($_POST['last_page']) && $statusQuest != 'C') {
  $option = base64_encode("respondeQuestoes&page=$_POST[last_page]");
  $statusQuest = 'S';
}


$sth = $db->prepare("UPDATE users SET status_quest = :status_quest WHERE id = :user_id");

$sth->bindValue(':user_id', $userId);
$sth->bindValue(':status_quest', $statusQuest);
$sth->execute();
$db->commit();
header("Location: ../index.php?$option"); 
?>
