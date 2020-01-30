    <?php
require "db-connect.php";
$date = date('Y-m-d H:i:s');

$db->beginTransaction();

$query = $db->prepare("SELECT email FROM users WHERE email = :email");
$query->bindValue(':email', $_POST["email"]);
$query->execute();
$sql = $query->fetchAll(PDO::FETCH_ASSOC)[0];

if(count($sql) <= 0) {
$query = $db->prepare("INSERT INTO users(name, email, password, level, blood_type, register_date) VALUES (:name, :email, :password, :level, :blood_type, :register_date)");
$query->bindValue(':name', $_POST["name"]);
$query->bindValue(':email', $_POST["email"]);
$query->bindValue(':password', $_POST["password"]); 
$query->bindValue(':blood_type', $_POST["blood_type"]); 
$query->bindValue(':level', $_POST["level"]); 
$query->bindValue(':register_date', $date); 
$sth = $query->execute();
}
else {
    $option = base64_encode('cadUsers');
    echo "<script>
    alert('Esse email já está registrado, por favor insira um email diferente!')
    window.location.href = '../index.php?$option'
    </script>";
}
$db->commit();
//Verifico se o registro foi inserido com sucesso
if($sth) {
    $option = base64_encode('cadUsers');
    echo "<script>
    alert('Usuário cadastrado com sucesso!')
    window.location.href = '../index.php?$option'
    </script>";
  }
  else {
    $db->commit();
    $option = base64_encode('cadUsers');
    echo "<script>
    alert('Houve um problema em cadastrar o usuário, por favor contate o administrador do sistema!')
    window.location.href = '../index.php?$option'
    </script>";
  }

?>
