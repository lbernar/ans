<?php
/*
* Code to query an SQLite database and return
* results as JSON.
*/
include "db-connect.php";
$db->beginTransaction();
// Define your SQL statement //
$query = $db->query("SELECT id, quest_id, response FROM answers")->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($query);
//echo "<pre>",print_r($query),"</pre>";

$db->commit();

?>

