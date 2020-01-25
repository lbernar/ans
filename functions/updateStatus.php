<?php
include "db-connect.php";
$db->beginTransaction();

$userId = $_POST['user_id'];
$lastQuest = $_POST['quest_id'];
$lastPage = $_POST['page'];
$quantQuest = $_POST['quant_quest'];
$nextPage = $lastPage + 1;
if($nextPage > $quantQuest) {
  $option = base64_encode("finalPage");
  $statusQuest = 'C';
} 
else {
  $option = base64_encode("respondeQuestoes&page=$nextPage");
  $statusQuest = 'S';
}
  
if($db->lastInsertId('status') == 0) 
  $sth = $db->prepare("INSERT INTO status (user_id, status_quest, last_page) VALUES (:user_id, :status_quest, :last_page)");
else
  $sth = $db->prepare("UPDATE status SET status_quest = :status_quest, last_page = :last_page WHERE user_id = :user_id");

$sth->bindValue(':user_id', $userId);
$sth->bindValue(':status_quest', $statusQuest);
$sth->bindValue(':last_page', $lastPage);
$sth->execute();

$data = $_POST;
if(isset($data['peso']) || isset($data['mult']) || isset($data['single'])) {
  $sth = $db->prepare("INSERT INTO results (alternative_id, quest_id, user_id, response) VALUES (:alternative_id, :quest_id, :user_id, :response)");
  if(array_key_exists('peso', $data)) {
    foreach($data['peso'] as $key => $value) {
      $alternativeId = $key;
      $resp = $value;
      $sth->bindValue(':user_id', $userId);
      $sth->bindValue(':alternative_id', $alternativeId);
      $sth->bindValue(':quest_id', $lastQuest);
      $sth->bindValue(':response', $resp);
      $sth->execute();
    }
  }
  elseif(array_key_exists('mult', $data)) {
    foreach($data['mult'] as $value) {
      $alternativeId = $value;
      $resp = 1;
      $sth->bindValue(':user_id', $userId);
      $sth->bindValue(':alternative_id', $alternativeId);
      $sth->bindValue(':quest_id', $lastQuest);
      $sth->bindValue(':response', $resp);
      $sth->execute();
    }
  }
  elseif(array_key_exists('single', $data)) {
      $alternativeId = $data['single'];
      $resp = 1;
      $sth->bindValue(':user_id', $userId);
      $sth->bindValue(':alternative_id', $alternativeId);
      $sth->bindValue(':quest_id', $lastQuest);
      $sth->bindValue(':response', $resp);
      $sth->execute();
  }
}

$db->commit();
echo $option;
?>
