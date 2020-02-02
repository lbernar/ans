<?php
include "db-connect.php";

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = $_GET['id'];
    $db->beginTransaction();
    $query = $db->prepare("SELECT name, resp_date, blood_type,
    SUM(IF(sub_class= 'TZ', result, null)) as TZ,
    SUM(IF(sub_class= 'AM', result, null)) as AM,
    SUM(IF(sub_class= 'VD', result, null)) as VD,
    SUM(IF(sub_class= 'LA', result, null)) as LA,
    SUM(IF(sub_class= 'AZ', result, null)) as AZ,
    SUM(IF(sub_class= 'VH', result, null)) as VH,
    SUM(IF(sub_class= 'RX', result, null)) as RX,
    SUM(IF(sub_class= 'NO', result, null)) as NO,
    SUM(IF(sub_class= 'SO', result, null)) as SO,
    SUM(IF(sub_class= 'NE', result, null)) as NE,
    SUM(IF(sub_class= 'SE', result, null)) as SE
    FROM
    (
    SELECT users.name, users.resp_date, users.blood_type, alternatives.sub_class, Sum(results.response) AS result
    FROM ((questions INNER JOIN alternatives ON questions.QUEST_ID=alternatives.QUEST_ID) INNER JOIN (users INNER JOIN results ON users.id=results.user_id) ON (alternatives.alternative_id=results.alternative_id) AND (alternatives.QUEST_ID=results.QUEST_ID)) INNER JOIN categories ON alternatives.sub_class=categories.sub_class
    WHERE users.id = :user_id
    GROUP BY users.id, users.name, users.blood_type, users.register_date, alternatives.sub_class
    ) src;");

    $query->bindValue(':user_id', $userId);
    $query->execute();
    $query = $query->fetchAll(PDO::FETCH_ASSOC);
    $db->commit();
     //Generate text file on the fly
    header("Content-type: text/plain");
    header("Content-Disposition: attachment; filename=Export_ANGC_NCAC.txt");

    foreach($query as $line) {
        $line['name'] = strtoupper($line['name']);
        $line['resp_date'] = date('d-m-Y H:i:s', strtotime($line['resp_date']));
        foreach($line as $key => $value) {
            $value = trim($value);
            if (empty($value))
                $value = 0;
            print_r($value . ";");
        }
    }
}


?>

