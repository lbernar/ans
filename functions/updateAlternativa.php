<?php
include "db-connect.php";
$id = $_POST['id'];
$alternativeId = 'A' . $_POST['alternative_id'];
$db->beginTransaction();
$sth = $db->prepare("UPDATE alternatives SET quest_id = :quest_id, sub_class = :sub_class, alternative_id = :alternative_id, response = :response WHERE id = :id");
//faço o bind das váriaveis.
  $sth->bindValue(':id', $id);
  $sth->bindValue(':quest_id', $_POST['quest_id']);
  $sth->bindValue(':sub_class', $_POST['sub_class']);
  $sth->bindValue(':alternative_id', $alternativeId);
  $sth->bindValue(':response', $_POST['response']);

 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
 if($sth->execute()) {
  $db->commit();
  $option = base64_encode('cadAltern');
  echo "<script>
  alert('Alternativa alterada com sucesso!')
  window.location.href = '../index.php?$option'
  </script>";
}
else {
  $db->commit();
  $option = base64_encode('cadAltern');
  echo "<script>
  alert('Houve um problema em atualizar a alternativa, por favor contate o administrador do sistema!')
  window.location.href = '../index.php?$option'
  </script>";
}
?>
