<?php
include "db-connect.php";
$id = $_POST['id'];
$db->beginTransaction();
$sth = $db->prepare("DELETE FROM alternatives WHERE id = :id");
//faço o bind das váriaveis.
  $sth->bindValue(':id', $id);
 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
  $sth->execute();
  $db->commit();
  $option = base64_encode('cadAltern');
  header("Location: ../index.php?$option"); 
?>
