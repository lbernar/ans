<?php
include "db-connect.php";
$id = $_POST['id'];
$question_id = 'Q' . $_POST['num_quest'];
$db->beginTransaction();
$sth = $db->prepare("UPDATE questions SET quest_id = :quest_id, question = :question, type_id = :type_id, bu_id = :bu_id WHERE id = :id");
//faço o bind das váriaveis.
$sth->bindValue(':id', $id);
$sth->bindValue(':quest_id', $question_id);
$sth->bindValue(':question', $_POST['question']);
$sth->bindValue(':type_id', $_POST['type']);
$sth->bindValue(':bu_id', $_POST['bu']);

 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
 if($sth->execute()) {
  $db->commit();
  $option = base64_encode('cadQuest');
  echo "<script>
  alert('Questão alterada com sucesso!')
  window.location.href = '../index.php?$option'
  </script>";
}
else {
  $db->commit();
  $option = base64_encode('cadQuest');
  echo "<script>
  alert('Houve um problema em atualizar a questão, por favor contate o administrador do sistema!')
  window.location.href = '../index.php?$option'
  </script>";
}
?>
