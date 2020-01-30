<?php
include "db-connect.php";

$query = $db->prepare("SELECT title FROM business_unit WHERE title = :title");
$query->bindValue(':title', $_POST['title']);
$query->execute();
$sql = $query->fetchAll(PDO::FETCH_ASSOC)[0];

if(count($sql) <= 0) {
$sth = $db->prepare("INSERT INTO business_unit (title) 
VALUES (:title)");

//faço o bind das váriaveis.
  $sth->bindValue(':title', $_POST['title']);
 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
$sth = $sth->execute();
}
else {
  $option = base64_encode('cadBusinessUnit');
  echo "<script>
  alert('Essa Business Unit já está registrada, por favor insira um titulo diferente diferente!')
  window.location.href = '../index.php?$option'
  </script>";
}

if($sth) {
  $option = base64_encode('cadBusinessUnit');
  echo "<script>
  alert('Business Unit cadastrada com sucesso!')
  window.location.href = '../index.php?$option'
  </script>";
}
else {
  $db->commit();
  $option = base64_encode('cadBusinessUnit');
  echo "<script>
  alert('Houve um problema em cadastrar a business unit, por favor contate o administrador do sistema!')
  window.location.href = '../index.php?$option'
  </script>";
}

?>
