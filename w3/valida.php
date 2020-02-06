<?php
include_once "../functions/db-connect.php";
//ini_set('session.use_cookies', '0');
session_start();
$userInfo = getUsers($_POST['email'], $db);
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time
if(isUserRegistered($_POST['email'], $db)) {
  if($_POST['email'] == $userInfo['email'] && $_POST['pass'] == $userInfo['password']) {
    $_SESSION['userProfile']['user_id'] = $userInfo['id'];
    $_SESSION['userProfile']['email'] = $userInfo['email'];
    $_SESSION['userProfile']['level'] = $userInfo['level'];
    $_SESSION['userProfile']['last_page'] = $userInfo['last_page'];
    $_SESSION['userProfile']['status_quest'] = $userInfo['status_quest'];
    session_regenerate_id();
    header('Location:../index.php');
  }
  else 
    expulsaVisitante("Usuário ou senha inválidos, por favor verifique. Caso persista entre em contato com adminstrador.");
}
else 
  expulsaVisitante("Usuário ou senha inválidos, por favor verifique. Caso persista entre em contato com adminstrador.");

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

function getUsers($email, $db) {
  $query = $db->prepare("SELECT id, email, password, level, last_page, status_quest FROM users WHERE email = :email");
  $query->bindValue(':email', $email);
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

function setUserToken($userId, $token, $db) {
  $query = $db->prepare("UPDATE users SET token = :token WHERE id = :user_id");
  $query->bindValue(':user_id', $userId);
  $query->bindValue(':token', $token);
  if($query->execute())
    return true;

  return false;
}

function getUserToken($userId, $db) {
  $query = $db->prepare("SELECT token FROM users WHERE id = :user_id");
  $query->bindValue(':user_id', $userId);
  $query->execute();
  $sql = $query->fetchAll(PDO::FETCH_ASSOC)[0];
  return $sql['token'];
}

// Generate token
function genToken($length){
  $token = "";
  $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
  $codeAlphabet.= "0123456789";
  $max = strlen($codeAlphabet); // edited
 
  for ($i=0; $i < $length; $i++) {
   $token .= $codeAlphabet[rand(0, $max-1)];
  }
 
  return $token;
 }

?>

