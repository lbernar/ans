<?php
include "db-connect.php";
$id = $_POST['id'];
$moeda = $_POST['moeda'];
$dataSinal = $_POST['dataSinal'];
$valor = $_POST['valor'];
$expiracao = $_POST['expiracao'];
$direcao = $_POST['direcao'];
$usa_gale = $_POST['usa_gale'];
$tipo = $_POST['tipo'];
$db->beginTransaction();
$sth = $db->prepare("UPDATE sinal SET moeda_id = :moeda, data_sinal = :dataSinal, valor = :valor, expiracao = :expiracao, direcao = :direcao, usa_gale = :usa_gale WHERE id = :id");
//faço o bind das váriaveis.
  $sth->bindValue(':id', $id);
  $sth->bindValue(':moeda', $moeda);
  $sth->bindValue(':dataSinal', $dataSinal);
  $sth->bindValue(':valor', $valor);
  $sth->bindValue(':expiracao', $expiracao);
  $sth->bindValue(':direcao', $direcao);
  $sth->bindValue(':usa_gale', $usa_gale);

 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
  $sth->execute();
  $db->commit();
  $option = base64_encode('editSinais');
  header("Location: ../index.php?$option&id=$id"); 
?>
