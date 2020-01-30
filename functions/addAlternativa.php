<?php
include "db-connect.php";
$db->beginTransaction();
$alternative_id = 'A' . $_POST['alternative_id'];
$query = $db->prepare("SELECT alternative_id FROM alternatives WHERE alternative_id = :alternative_id");
$query->bindValue(':alternative_id', $alternative_id);
$query->execute();
$sql = $query->fetchAll(PDO::FETCH_ASSOC)[0];

if(count($sql) <= 0) {
$sth = $db->prepare("INSERT INTO alternatives (quest_id, alternative_id, response) 
VALUES (:quest_id, :alternative_id, :response)");

//faço o bind das váriaveis.
$sth->bindValue(':quest_id', $_POST['quest_id']);
$sth->bindValue(':alternative_id', $alternative_id);
$sth->bindValue(':response', $_POST['response']);
//Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
$sth = $sth->execute();
$db->commit();
if($sth) {
  $option = base64_encode('cadAltern');
  echo "<script>
  alert('Alternativa cadastrada com sucesso!')
  window.location.href = '../index.php?$option'
  </script>";
}
else {
  $db->commit();
  $option = base64_encode('cadAltern');
  echo "<script>
  alert('Houve um problema em cadastrar a alternativa, por favor contate o administrador do sistema!')
  window.location.href = '../index.php?$option'
  </script>";
}
}
else {
  $option = base64_encode('cadAltern');
  echo "<script>
  alert('Essa alternativa já está registrada, por favor insira um id diferente!')
  window.location.href = '../index.php?$option'
  </script>";
}


?>
