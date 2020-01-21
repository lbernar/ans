<?php
include "db-connect.php";
$id = $_POST['id'];

$db->beginTransaction();
$sth = $db->prepare("UPDATE alternatives SET quest_id = :quest_id, alternative_id = :alternative_id, response = :response WHERE id = :id");
//faço o bind das váriaveis.
  $sth->bindValue(':id', $id);
  $sth->bindValue(':quest_id', $_POST['quest_id']);
  $sth->bindValue(':alternative_id', $_POST['alternative_id']);
  $sth->bindValue(':response', $_POST['response']);

 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
  $sth->execute();
  $db->commit();
  $option = base64_encode('editResposta');
  header("Location: ../index.php?$option&id=$id"); 
?>
