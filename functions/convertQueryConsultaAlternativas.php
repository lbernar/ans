<?php
/*
* Code to query an SQLite database and return
* results as JSON.
*/
include "db-connect.php";
$db->beginTransaction();
// Define your SQL statement //
$query = $db->prepare("SELECT alt.id, alt.quest_id, alt.alternative_id, alt.response, tq.type_desc FROM alternatives AS alt 
INNER JOIN questions AS quest ON quest.quest_id = alt.quest_id 
INNER JOIN type_questions AS tq ON quest.type_id = tq.id");
$query->execute();
$query = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($query);
//echo "<pre>",print_r($query),"</pre>";

$db->commit();

?>

