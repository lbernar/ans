<?php
require "db-connect.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);
$id = $_POST['id'];
$query = $db->prepare("SELECT name, email, password FROM users");
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
$headers = "MIME-Version: 1.1\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
$headers .= "From: $from\r\n"; // remetente
if(mail($to, $subject, $message, $headers))
    echo "E-mail enviado com sucesso.";
else
    echo "Erro ao enviar o e-mail.";
?>