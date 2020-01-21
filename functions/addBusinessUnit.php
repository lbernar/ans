<?php
include "db-connect.php";
$sth = $db->prepare("INSERT INTO business_unit (title) 
VALUES (:title)");

//faço o bind das váriaveis.
  $sth->bindValue(':title', $_POST['title']);
 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
  $sth->execute();
$option = base64_encode('cadBusinessUnit');
header("Location: ../index.php?$option"); 
?>
