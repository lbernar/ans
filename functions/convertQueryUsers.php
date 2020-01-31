<?php
/*
* Code to query an SQLite database and return
* results as JSON.
*/
include "db-connect.php";
$db->beginTransaction();
$result = [];
// Define your SQL statement //
//$query = $db->query("SELECT * from sinal")->fetchAll(PDO::FETCH_ASSOC);
$query = $db->prepare("SELECT id, name, email, level, status_quest, blood_type FROM users");
$query->execute();
$query = $query->fetchAll(PDO::FETCH_ASSOC);
foreach($query as $line) {

    if($line['level'] == 1)
        $line['level'] = 'Administrador';
    else
        $line['level'] = 'Usuário';
    if(empty($line['status_quest']) || $line['status_quest'] == 'P')
        $line['status_quest'] = 'Pendente';
    elseif($line['status_quest'] == 'S')
        $line['status_quest'] = 'Iniciado';
    elseif ($line['status_quest'] == 'C') 
        $line['status_quest'] = 'Completo';
    else
        $line['status_quest'] = 'Sem Status';
        
    array_push($result, $line);
}
echo json_encode($result);
//echo "<pre>",print_r($query),"</pre>";

$db->commit();

?>

