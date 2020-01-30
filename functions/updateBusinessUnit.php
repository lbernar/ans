<?php
include "db-connect.php";
$id = $_POST['id'];

$db->beginTransaction();
$sth = $db->prepare("UPDATE business_unit SET title = :title WHERE id = :id");
//faço o bind das váriaveis.
  $sth->bindValue(':id', $id);
  $sth->bindValue(':title', $_POST['title']);

 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
 if($sth->execute()) {
  $db->commit();
  $option = base64_encode('cadBusinessUnit');
  echo "<script>
  alert('Business Unit alterado com sucesso!')
  window.location.href = '../index.php?$option'
  </script>";
}
else {
  $db->commit();
  $option = base64_encode('cadBusinessUnit');
  echo "<script>
  alert('Houve um problema em atualizar a business unit, por favor contate o administrador do sistema!')
  window.location.href = '../index.php?$option'
  </script>";
}
?>
