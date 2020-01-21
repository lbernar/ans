<?php
session_start();
include "db-connect.php";
$sth = $db->prepare("INSERT INTO alternatives (quest_id, alternative_id, response) 
VALUES (:quest_id, :response, :alternative_id)");
$alternative_id = 'A' . $_POST['alternative_id'];

//faço o bind das váriaveis.
  $sth->bindValue(':quest_id', $_POST['quest_id']);
  $sth->bindValue(':alternative_id', alternative_id);
  $sth->bindValue(':response', $_POST['response']);
 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
  $sth->execute();
$option = base64_encode('consultaRespostas');
header("Location: ../index.php?$option"); 
?>
