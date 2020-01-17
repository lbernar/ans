<?php
include_once "../functions/db-connect.php";

session_start();
$userInfo = getUsers($_POST['email'], $db);

if(isUserRegistered($_POST['iduser'], $db)) {
  if($_POST['iduser'] == $userInfo['result']['email'] && md5($_POST['pass']) == $userInfo['password'] ){
    $_SESSION['userProfile']['user_id'] = $userInfo['id'];
    $_SESSION['userProfile']['email'] = $userInfo['email'];
    $_SESSION['userProfile']['level'] = $userInfo['level'];
    header('Location:../index.php');
  }
  else 
    expulsaVisitante("Usuário ou senha inválidos, por favor verifique. Caso persista entre em contato com adminstrador.");
}
else 
  expulsaVisitante("Usuário não cadastrado na plataforma, por favor entre em contato com administrador.");

####################funcao php###############
function isMail($mail, $use_DNS = false){
	if(preg_match('/^([a-z0-9_]|\-|\.)+@(([a-z0-9_]|\-)+\.)+[a-z]{2,3}$/i', $mail, $check))
		return(($use_DNS && $host = substr(strstr($check[0], '@'), 1).'.') ? (getmxrr($host, $mxhosts) || checkdnsrr($host, 'ANY')) : true);
  
  return false;
}

function isUserRegistered($email,$db) {
  $userInfo = getUsers($email, $db);
  if($userInfo['email'] == $email)
    return true;

  return false;
}
function getUsers($user_id, $db) {
  $query = $db->prepare("SELECT id, email, password, level FROM users WHERE user_id = :user_id");
  $query->bindValue(':user_id', $user_id);
  $query->execute();
  $sql = $query->fetchAll(PDO::FETCH_ASSOC)[0];
  return $sql;
}

function expulsaVisitante($message = null) {
	// Remove as variáveis da sessão (caso elas existam)
	unset($_SESSION);
	// Manda pra tela de login
	$msg = base64_encode("$message");
	header("Location: ../login-page.php?$msg");
	exit();
}

?>

