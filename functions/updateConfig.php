<?php
include "db-connect.php";
$db->beginTransaction();

if(empty($_POST['id']) && $db->lastInsertId() == 0) 
  $sth = $db->prepare("INSERT INTO config (ini_msg, final_msg) VALUES (:ini_msg, :final_msg)");
else {
  $sth = $db->prepare("UPDATE config SET ini_msg = :ini_msg, final_msg = :final_msg WHERE id = :id");
  $sth->bindValue(':id', $_POST['id']);
}
//faço o bind das váriaveis.
  $sth->bindValue(':ini_msg', $_POST['ini_msg']);
  $sth->bindValue(':final_msg', $_POST['final_msg']);

 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
 if($sth->execute()) {
  $db->commit();
  $option = base64_encode('cadConfig');
  echo "<script>
  alert('Configuração alterada com sucesso!')
  window.location.href = '../index.php?$option'
  </script>";
}
else {
  $db->commit();
  $option = base64_encode('cadConfig');
  echo "<script>
  alert('Houve um problema em atualizar a configuração, por favor contate o administrador do sistema!')
  window.location.href = '../index.php?$option'
  </script>";
}
?>
