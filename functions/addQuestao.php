<?php
session_start();
include "db-connect.php";
$sth = $db->prepare("INSERT INTO questions (quest_id, question, type_id, bu_id, category_id) 
VALUES (:quest_id, :question, :type_id, :bu_id, :category_id)");

$question_id = 'Q' . $_POST['num_quest'];
//faço o bind das váriaveis.
  $sth->bindValue(':quest_id', $question_id);
  $sth->bindValue(':question', $_POST['question']);
  $sth->bindValue(':type_id', $_POST['type']);
  $sth->bindValue(':bu_id', $_POST['bu']);
  $sth->bindValue(':category_id', $_POST['category']);
 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
  $sth->execute();

$option = base64_encode('cadQuestoes');
header("Location: ../index.php?$option"); 
?>
