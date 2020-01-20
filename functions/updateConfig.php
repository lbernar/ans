<?php
include "db-connect.php";
$db->beginTransaction();
$sth = $db->prepare("UPDATE config SET ini_msg = :ini_msg, final_msg = :final_msg");
//faço o bind das váriaveis.
  $sth->bindValue(':ini_msg', $_POST['ini_msg']);
  $sth->bindValue(':final_msg', $_POST['final_msg']);

 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
  $sth->execute();
  $db->commit();
  $option = base64_encode('cadConfig');
  header("Location: ../index.php?$option"); 
?>
