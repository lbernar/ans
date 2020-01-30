<?php
include "db-connect.php";
$question_id = 'Q' . $_POST['num_quest'];
$query = $db->prepare("SELECT quest_id FROM questions WHERE quest_id = :quest_id");
$query->bindValue(':quest_id', $question_id);
$query->execute();
$sql = $query->fetchAll(PDO::FETCH_ASSOC)[0];

if(count($sql) <= 0) {
$sth = $db->prepare("INSERT INTO questions (quest_id, question, type_id, bu_id, category_id) 
VALUES (:quest_id, :question, :type_id, :bu_id, :category_id)");

//faço o bind das váriaveis.
$sth->bindValue(':quest_id', $question_id);
$sth->bindValue(':question', $_POST['question']);
$sth->bindValue(':type_id', $_POST['type']);
$sth->bindValue(':bu_id', $_POST['bu']);
$sth->bindValue(':category_id', $_POST['category']);
//Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
$sth = $sth->execute();
$option = base64_encode('cadQuest');
header("Location: ../index.php?$option"); 
}
else {
  $option = base64_encode('cadQuest');
  echo "<script>
  alert('Essa questão já está registrada, por favor insira um id diferente!')
  window.location.href = '../index.php?$option'
  </script>";
}

if($sth) {
  $option = base64_encode('cadQuest');
  echo "<script>
  alert('Questão cadastrada com sucesso!')
  window.location.href = '../index.php?$option'
  </script>";
}
else {
  $db->commit();
  $option = base64_encode('cadQuest');
  echo "<script>
  alert('Houve um problema em cadastrar a questão, por favor contate o administrador do sistema!')
  window.location.href = '../index.php?$option'
  </script>";
}

?>
