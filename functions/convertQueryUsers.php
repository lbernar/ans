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
$query = $db->query("SELECT id, nome, user_id, ativo, level FROM users")->fetchAll(PDO::FETCH_ASSOC);
foreach($query as $line) {
    if($line['ativo'] == 1)
        $line['ativo'] = 'Sim';
    else
        $line['ativo'] = 'Não';

    if($line['level'] == 1)
        $line['level'] = 'Adminstrador';
    else
        $line['level'] = 'Usuário';
        
    array_push($result, $line);
}
echo json_encode($result);
//echo "<pre>",print_r($query),"</pre>";

$db->commit();

?>

