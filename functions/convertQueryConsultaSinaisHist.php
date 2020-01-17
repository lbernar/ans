<?php
/*
* Code to query an SQLite database and return
* results as JSON.
*/
include "db-connect.php";
$result = [];
$db->beginTransaction();
// Define your SQL statement //
//$query = $db->query("SELECT * from sinal")->fetchAll(PDO::FETCH_ASSOC);
$query = $db->query("SELECT snl.id, moeda.nome, data_sinal, direcao, valor, gale, result, lucro_preju FROM sinal AS snl INNER JOIN moedas AS moeda ON moeda.id = snl.moeda_id")->fetchAll(PDO::FETCH_ASSOC);
foreach($query as $line) {
    $line['direcao'] = strtoupper($line['direcao']);
    $line['valor'] = '$ ' . number_format($line['valor'], 2, '.', '');
    $line['lucro_preju'] = '$ ' . number_format($line['lucro_preju'], 2, '.', '');
    array_push($result, $line);
}
echo json_encode($result);
//echo "<pre>",print_r($query),"</pre>";

$db->commit();

?>

