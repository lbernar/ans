    <?php
require "db-connect.php";
$date = date('Y-m-d H:i:s');
$db->beginTransaction();
$query = $db->prepare("INSERT INTO users(name, email, password, level, blood_type, register_date) VALUES (:name, :email, :password, :level, :blood_type, :register_date)");
$query->bindValue(':name', $_POST["name"]);
$query->bindValue(':email', $_POST["email"]);
$query->bindValue(':password', $_POST["password"]); 
$query->bindValue(':blood_type', $_POST["blood_type"]); 
$query->bindValue(':level', $_POST["level"]); 
$query->bindValue(':register_date', $date); 
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
