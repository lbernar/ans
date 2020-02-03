<?php
include "db-connect.php";
$db->beginTransaction();
$userId = $_POST['user_id'];
$statusQuest = $_POST['status_quest'];
if((empty($_POST['last_page']) || $_POST['last_page'] == 0) && empty($statusQuest)) {
  $option = base64_encode("respondeQuestoes&page=0");
  $sth = $db->prepare("UPDATE users SET status_quest = :status_quest WHERE id = :user_id");
  $sth->bindValue(':user_id', $userId);
  $sth->bindValue(':status_quest', 'S');
  $sth->execute();
}
elseif($_POST['last_page'] >= 0 && $statusQuest == 'S') {
  $option = base64_encode("respondeQuestoes&page=$_POST[last_page]");
}
$db->commit();
header("Location: ../index.php?$option"); 
?>
