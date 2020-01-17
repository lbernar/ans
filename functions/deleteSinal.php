<?php
include "db-connect.php";
include "createCron.php";
$id = isset($_POST['id']) ? $_POST['id'] : '';
$cron = new CreateCron();
$request = isset($_POST['request']) ? $_POST['request'] : '';
// Delete record
if($request == 2){
  $deleteids_arr = $_POST['deleteids_arr'];
  foreach($deleteids_arr as $deleteid){
    deleteCron($deleteid, $cron);
    $sth = $db->prepare("DELETE FROM sinal WHERE id = :id");
    $sth->bindValue(':id', $deleteid);
    $sth->execute();
  }
  echo 1;
  exit;
}

function deleteCron($id, $cron) {
  $newCron = [];
  $crontab = explode("\n", $cron->getCron());
  foreach($crontab as $line) {
    if (strpos($line, $id) !== false)
      unset($line);
    array_push($newCron, $line);
  }
  $output = implode("\n", $newCron);
  file_put_contents("$_SERVER[DOCUMENT_ROOT]/functions/crontab.txt", trim($output).PHP_EOL, FILE_APPEND);
  $cron->deleteCron();
  $cron->insertToCron();
}

deleteCron($id, $cron);
$db->beginTransaction();
$sth = $db->prepare("DELETE FROM sinal WHERE id = :id");
//faço o bind das váriaveis.
  $sth->bindValue(':id', $id);
 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
  $sth->execute();
  $db->commit();
  $option = base64_encode('consultaSinais');
  header("Location: ../index.php?$option"); 
  
  ?>
