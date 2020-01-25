<?php
include "db-connect.php";
$db->beginTransaction();

$userId = $_POST['user_id'];
$option = base64_encode("respondeQuestoes&page=0");
$statusQuest = 'S';

  
if($db->lastInsertId('status') == 0) 
  $sth = $db->prepare("INSERT INTO status (user_id, status_quest) VALUES (:user_id, :status_quest)");
else
  $sth = $db->prepare("UPDATE status SET status_quest = :status_quest WHERE user_id = :user_id");

$sth->bindValue(':user_id', $userId);
$sth->bindValue(':status_quest', $statusQuest);
$sth->execute();
$db->commit();
header("Location: ../index.php?$option"); 
?>
