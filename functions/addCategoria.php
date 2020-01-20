<?php
session_start();
include "db-connect.php";
$sth = $db->prepare("INSERT INTO categories (class, sub_class) 
VALUES (:class, :sub_class)");

//faço o bind das váriaveis.
  $sth->bindValue(':class', $_POST['class']);
  $sth->bindValue(':sub_class', $_POST['sub_class']);
 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
  $sth->execute();
$option = base64_encode('consultaCategorias');
header("Location: ../index.php?$option"); 
?>
