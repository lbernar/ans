<?php
include "db-connect.php";
$id = $_POST['id'];

$db->beginTransaction();
$sth = $db->prepare("UPDATE categories SET class = :class, sub_class = :sub_class WHERE id = :id");
//faço o bind das váriaveis.
  $sth->bindValue(':id', $id);
  $sth->bindValue(':class', $_POST['class']);
  $sth->bindValue(':sub_class', $_POST['sub_class']);

 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
 if($sth->execute()) {
  $db->commit();
  $option = base64_encode('cadCategoria');
  echo "<script>
  alert('Categoria alterada com sucesso!')
  window.location.href = '../index.php?$option'
  </script>";
}
else {
  $db->commit();
  $option = base64_encode('cadCategoria');
  echo "<script>
  alert('Houve um problema em atualizar a categoria, por favor contate o administrador do sistema!')
  window.location.href = '../index.php?$option'
  </script>";
}
?>
