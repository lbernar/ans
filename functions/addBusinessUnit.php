<?php
session_start();
include "db-connect.php";
$sth = $db->prepare("INSERT INTO bu (title, total) 
VALUES (:title, :total)");

//faço o bind das váriaveis.
  $sth->bindValue(':title', $_POST['title']);
  $sth->bindValue(':total', $_POST['total']);
 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
  $sth->execute();
$option = base64_encode('consultaBusinessUnit');
header("Location: ../index.php?$option"); 
?>
