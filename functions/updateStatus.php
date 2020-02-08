<?php
include "db-connect.php";
$db->beginTransaction();

$userId = $_POST['user_id'];
$lastQuest = $_POST['quest_id'];
$lastPage = $_POST['page'];
$quantQuest = $_POST['quant_quest'];
$nextPage = $lastPage + 1;
$lastQuestId = $_POST['id'];

if($nextPage >= $quantQuest) {
  $option = base64_encode("finalPage");
  $statusQuest = 'C';
} 
else {
  $option = base64_encode("respondeQuestoes&page=$nextPage");
  $statusQuest = 'S';
}

$sth = $db->prepare("SELECT q.id AS last_user_quest FROM questions AS q INNER JOIN users AS u ON u.last_quest = q.quest_id WHERE u.id = :userId");
$sth->bindValue(':userId', $userId);
$sth->execute();
$lastQuestUser = $sth->fetchAll(PDO::FETCH_ASSOC)[0]['last_user_quest'];

if($lastQuestId <= $lastQuestUser) {
  echo md5('logout');
  exit;
}
$sth = $db->prepare("UPDATE users SET status_quest = :status_quest, last_page = :last_page, last_quest = :last_quest WHERE id = :user_id");
$sth->bindValue(':user_id', $userId);
$sth->bindValue(':status_quest', $statusQuest);
$sth->bindValue(':last_page', $lastPage);
$sth->bindValue(':last_quest', $lastQuest);
$sth->execute();

$data = $_POST;
if(isset($data['peso']) || isset($data['mult']) || isset($data['single'])) {
  $sth = $db->prepare("INSERT INTO results (alternative_id, quest_id, user_id, response) VALUES (:alternative_id, :quest_id, :user_id, :response)");
  if(array_key_exists('peso', $data)) {
    foreach($data['peso'] as $key => $value) {
      if(!empty($value)) {
        $alternativeId = $key;
        $resp = $value;
        $sth->bindValue(':user_id', $userId);
        $sth->bindValue(':alternative_id', $alternativeId);
        $sth->bindValue(':quest_id', $lastQuest);
        $sth->bindValue(':response', $resp);
        $sth->execute();
      }
    }
  }
  elseif(array_key_exists('mult', $data)) {
    foreach($data['mult'] as $value) {
      if(!empty($value)) {
        $alternativeId = $value;
        $resp = 1;
        $sth->bindValue(':user_id', $userId);
        $sth->bindValue(':alternative_id', $alternativeId);
        $sth->bindValue(':quest_id', $lastQuest);
        $sth->bindValue(':response', $resp);
        $sth->execute();
      }
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
  $sth = $db->prepare("UPDATE users SET resp_date = NOW() WHERE id = :user_id");
  $sth->bindValue(':user_id', $userId);
  $sth->execute();
}

$db->commit();
echo $option;
?>
