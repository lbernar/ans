    <?php
include "db-connect.php";

$db->beginTransaction();
$query = $db->prepare("INSERT INTO users(nome, user_id, ativo, level) VALUES (:name, :userId, :active, :level)");
$query->bindValue(':name', $_POST["name"]);
$query->bindValue(':userId', $_POST["userId"]);
$query->bindValue(':active', $_POST["active"]); 
$query->bindValue(':level', $_POST["level"]); 
$sth = $query->execute();
$db->commit();
//Verifico se o registro foi inserido com sucesso
if ($sth) {
    $option = base64_encode('cadUsers');
    header("Location: ../index.php?$option"); 
}
else {
    echo "Não foi possivel inserir o registro - entre em contato com o webmaster ";
}
?>
