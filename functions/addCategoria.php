<?php
session_start();
include "db-connect.php";

$query = $db->prepare("SELECT class, sub_class FROM categories WHERE class = :class AND sub_class = :sub_class");
$query->bindValue(':class', $_POST['class']);
$query->bindValue(':sub_class', $_POST['sub_class']);
$query->execute();
$sql = $query->fetchAll(PDO::FETCH_ASSOC)[0];

if(count($sql) <= 0) {
$sth = $db->prepare("INSERT INTO categories (class, sub_class) 
VALUES (:class, :sub_class)");

//faço o bind das váriaveis.
  $sth->bindValue(':class', $_POST['class']);
  $sth->bindValue(':sub_class', $_POST['sub_class']);
 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
  $sth = $sth->execute();
  if($sth) {
    $option = base64_encode('cadCategoria');
    echo "<script>
    alert('Categoria cadastrada com sucesso!')
    window.location.href = '../index.php?$option'
    </script>";
  }
  else {
    $db->commit();
    $option = base64_encode('cadCategoria');
    echo "<script>
    alert('Houve um problema em cadastrar a categoria, por favor contate o administrador do sistema!')
    window.location.href = '../index.php?$option'
    </script>";
  }
}
else {
  $option = base64_encode('cadCategoria');
  echo "<script>
  alert('Essa categoria e sub classe já estão registradas, por favor insira uma categoria e sub classe diferente!')
  window.location.href = '../index.php?$option'
  </script>";

}
?>
