<?php
include "db-connect.php";
$id = $_POST['id'];
$name = $_POST['name'];
$userId = $_POST['userId'];
$active = $_POST['active'];
$level = $_POST['level'];


$db->beginTransaction();
$sth = $db->prepare("UPDATE users SET nome = :name, user_id = :userId, ativo = :active, level = : level WHERE id = :id"); 
$sth->bindValue(':id', $id);
$sth->bindValue(':name', $name);
$sth->bindValue(':userId', $userId);
$sth->bindValue(':active', $active);
$sth->bindValue(':level', $level);

$sth->execute();
$db->commit();
$option = base64_encode('editUsers');
header("Location: ../index.php?$option&id=$id");
?>
