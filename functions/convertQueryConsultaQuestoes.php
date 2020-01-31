<?php
/*
* Code to query an MySQL database and return
* results as JSON.
*/
include "db-connect.php";
$db->beginTransaction();
// Define your SQL statement //
$query = $db->prepare("SELECT quest.quest_id, quest.question, tq.type_desc, bu.title
FROM questions AS quest 
INNER JOIN type_questions AS tq ON tq.id = quest.type_id
INNER JOIN business_unit AS bu ON quest.bu_id = bu.id");
$query->execute();
$query = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($query);
//echo "<pre>",print_r($query),"</pre>";

$db->commit();

?>

