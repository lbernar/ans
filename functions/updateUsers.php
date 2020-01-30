<?php
include "db-connect.php";
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$level = $_POST['level'];

$db->beginTransaction();
$sth = $db->prepare("UPDATE users SET name = :name, email = :email, password = :password, phone = :phone, level = :level WHERE id = :id"); 
$sth->bindValue(':id', $id);
$sth->bindValue(':name', $name);
$sth->bindValue(':email', $email);
$sth->bindValue(':phone', $phone);
$sth->bindValue(':password', $password);
$sth->bindValue(':level', $level);

if($sth->execute()) {
  $db->commit();
  $option = base64_encode('cadUsers');
  echo "<script>
  alert('Usuário alterado com sucesso!')
  window.location.href = '../index.php?$option'
  </script>";
}
else {
  $db->commit();
  $option = base64_encode('cadUsers');
  echo "<script>
  alert('Houve um problema em atualizar o usuário, por favor contate o administrador do sistema!')
  window.location.href = '../index.php?$option'
  </script>";
}

?>
