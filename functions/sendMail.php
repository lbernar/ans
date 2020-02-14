<?php
require "db-connect.php";
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
$id = $_POST['id'];
$query = $db->prepare("SELECT name, email, password FROM users WHERE id = :id");
$query->bindValue(':id', $id);
$query->execute();
$query = $query->fetchAll(PDO::FETCH_ASSOC)[0];
$to = $query['email'];
$name = $query['name'];
$password = $query['password'];
$from = "aval@acesseamente.com.br";
$subject = "Link para questionário de análise neurossistêmica";
$message = "Olá, $name \n Você está recebendo o link para responder o questionário de análise neurossistêmica.\n Para acessar clique no link abaixo para logar e responder o questionário.\n";
$message .= "https://www.acesseamente.com.br/ans \n"; 
$message .= "Login: seu email \n"; 
$message .= "Senha: " . $password . "\n"; 
$message .= "Será um prazer ajudá-lo em seu autoconhecimento e desenvolvimento humano.\n"; 
$message .= "Equipe Acesseamente.\n"; 
$message .= "(11) 3360-8775 \n"; 
$mail = new PHPMailer\PHPMailer\PHPMailer();
 $mail->CharSet = 'UTF-8';
 $mail->IsSMTP(); // enable SMTP
 //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
 $mail->SMTPAuth = true; // authentication enabled
 $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
 $mail->Host = "br976.hostgator.com.br";
 $mail->Port = 465; // or 587
 $mail->IsHTML(true);
 $mail->Username = "aval@acesseamente.com.br";
 $mail->Password = '$d5zpoq7d';
 $mail->SetFrom("aval@acesseamente.com.br");
 $mail->Subject = $subject;
 $mail->Body = nl2br($message);
 $mail->AddAddress($to);
    if(!$mail->Send()) {
       echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
       echo "Mensagem enviada com sucesso";
    }
?>