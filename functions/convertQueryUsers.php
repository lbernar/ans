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
$query = $db->prepare("SELECT id, name, email, level, status FROM users");
$query->execute();
$query = $query->fetchAll(PDO::FETCH_ASSOC);
foreach($query as $line) {

    if($line['level'] == 1)
        $line['level'] = 'Adminstrador';
    else
        $line['level'] = 'Usuário';
    if(empty($line['status']) || $line['status'] == 'P')
        $line['status'] = 'Pendente';
    elseif($line['status'] == 'S')
        $line['status'] = 'Iniciado';
    elseif ($line['status'] == 'C') 
        $line['status'] = 'Completo';
    else
        $line['status'] = 'Sem Status';
        
    array_push($result, $line);
}
echo json_encode($result);
//echo "<pre>",print_r($query),"</pre>";

$db->commit();

?>

