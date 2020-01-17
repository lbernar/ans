<?php
session_start();
include "db-connect.php";
include "createCron.php";
$cron = new CreateCron();
$userid = $_SESSION['user_id'];
$pass = $_SESSION['pass'];
$sth = $db->prepare("INSERT INTO sinal (moeda_id, data_sinal, expiracao, direcao, usa_gale, tipo, valor, user_id) 
VALUES (:moeda_id, :data_sinal, :expiracao, :direcao, :usa_gale, :tipo, :valor, :userid)");

function createCronEntry($cron,$pass,$db) {
  $db->beginTransaction();
  $query = $db->query("SELECT MAX(id) FROM sinal")->fetchAll(PDO::FETCH_ASSOC)[0]['MAX(id)'];
  $db->commit();
  $cron->createCronModel($query,$pass,$db);
}

if(isset($_FILES['csv']['name']) && strlen($_FILES['csv']['name']) > 0) {
  $uploaddir = 'uploads/';
  $uploadfile = $uploaddir . $_FILES['csv']['name'];
  $extensao = explode('.', $_FILES['csv']['name']);
  $extensao = strtolower(end($extensao));
  if ($extensao != 'csv') {
    echo"<script>
    alert('Extensão não suportada, por favor use um arquivo csv .');
    window.location.href='upload.php';
    </script>";
  exit;   
  }
  if (move_uploaded_file($_FILES['csv']['tmp_name'], $uploadfile))
    echo "Arquivo salvo com sucesso.";

  $csv = array_map('str_getcsv', file($uploadfile));
  unset($csv[0]);

  foreach($csv as $line) {
    $data = $line[0] . " " . $line[1];
    $moeda_id = $db->query("SELECT id  FROM moedas WHERE nome = \"$line[2]\"")->fetchAll(PDO::FETCH_ASSOC);
    if(isset($moeda_id[0]['id']))
      $moeda = $moeda_id[0]['id'];
    else
      continue;
    
    $dataSinal = $data;
    $direcao = strtolower($line[3]);
    $valor = $line[4];
    if($line[5] == 'Sim' || $line[5] == 'SIM')
      $usaGale = 1;
    else
      $usaGale = 0;
    $tipo = "d";
    $expiracao = $line[6];

    //faço o bind das váriaveis.
    $sth->bindValue(':moeda_id', $moeda);
    $sth->bindValue(':data_sinal', $dataSinal);
    $sth->bindValue(':expiracao', $expiracao);
    $sth->bindValue(':direcao', $direcao);
    $sth->bindValue(':usa_gale', $usaGale);
    $sth->bindValue(':tipo', $tipo);
    $sth->bindValue(':valor', $valor);
    $sth->bindValue(':userid', $userid);    
  //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
    $sth->execute();
    createCronEntry($cron, $pass, $db);
  }
  $cron->insertToCron();
}
else {
  $moeda = $_POST['moeda'];
  $dataSinal = $_POST['dataSinal'];
  $expiracao = $_POST['expiracao'];
  $direcao = $_POST['direcao'];
  $usaGale = $_POST['usa_gale'];
  $tipo = $_POST['tipo'];
  $valor = str_replace('$', '', $_POST['valor']);

//faço o bind das váriaveis.
  $sth->bindValue(':moeda_id', $moeda);
  $sth->bindValue(':data_sinal', $dataSinal);
  $sth->bindValue(':expiracao', $expiracao);
  $sth->bindValue(':direcao', $direcao);
  $sth->bindValue(':usa_gale', $usaGale);
  $sth->bindValue(':tipo', $tipo);
  $sth->bindValue(':valor', $valor);
  $sth->bindValue(':userid', $userid);
  
 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
  $sth->execute();
  createCronEntry($cron,$pass,$db);
  $cron->insertToCron();

}

$option = base64_encode('consultaSinais');
header("Location: ../index.php?$option"); 
?>
