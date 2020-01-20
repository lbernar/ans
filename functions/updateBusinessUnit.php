<?php
include "db-connect.php";
$id = $_POST['id'];

$db->beginTransaction();
$sth = $db->prepare("UPDATE bu SET title = :title, total = :total WHERE id = :id");
//faço o bind das váriaveis.
  $sth->bindValue(':id', $id);
  $sth->bindValue(':title', $_POST['title']);
  $sth->bindValue(':total', $_POST['total']);

 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
  $sth->execute();
  $db->commit();
  $option = base64_encode('editBusinessUnit');
  header("Location: ../index.php?$option&id=$id"); 
?>
