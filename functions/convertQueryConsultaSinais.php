<?php
/*
* Code to query an SQLite database and return
* results as JSON.
*/
include "db-connect.php";
$result = [];
$db->beginTransaction();
$today = strtotime(date('d/m/Y'));
// Define your SQL statement //
//$query = $db->query("SELECT * from sinal")->fetchAll(PDO::FETCH_ASSOC);
$query = $db->query("SELECT snl.id, moeda.nome, data_sinal, direcao, expiracao, valor, gale, result, lucro_preju FROM sinal AS snl INNER JOIN moedas AS moeda ON moeda.id = snl.moeda_id")->fetchAll(PDO::FETCH_ASSOC);
foreach($query as $line) {
    $dataSinalTimestamp = strtotime(explode(' ', $line['data_sinal'])[0]);
    if($dataSinalTimestamp >= $today) {
        $line['direcao'] = strtoupper($line['direcao']);
        $line['valor'] = '$ ' . $line['valor'];
        $line['lucro_preju'] = '$ ' . number_format($line['lucro_preju'], 2, ',', '');
        $line['action'] = "<input type='checkbox' class='delete_check' id='delcheck_".$line['id']."' onclick='checkcheckbox();' value='".$line['id']."'>";
        array_push($result, $line);
    }
}
echo json_encode($result);
//echo "<pre>",print_r($query),"</pre>";

$db->commit();

?>

