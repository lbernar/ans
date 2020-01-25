<?php
include "db-connect.php";
$db->beginTransaction();

$userId = $_POST['user_id'];
$lastQuest = $_POST['quest_id'];
$lastPage = $_POST['page'];
$nextPage = $lastPage + 1;
// if(empty($_POST['id']) && $db->lastInsertId('status') == 0) 
//   $sth = $db->prepare("INSERT INTO status (user_id, status_quest, last_page) VALUES (:user_id, :status_quest, :last_page)");
// else {
//   $sth = $db->prepare("UPDATE status SET user_id = :user_id, status_quest = :status_quest, status_quest = :status_quest WHERE id = :id");
//   $sth->bindValue(':id', $_POST['id']);
// }
// //faço o bind das váriaveis.
// $sth->bindValue(':user_id', $userId);
//   $sth->bindValue(':status_quest', $statusQuest);
//   $sth->bindValue(':last_page', $lastPage);

//  //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
//   $sth->execute();
//   $db->commit();
//   $option = base64_encode('cadConfig');
  //header("Location: ../index.php?$option"); 
?>
