<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$to = $_POST['email'];
$name = $_POST['name'];
$from = 'mentecina@gmail.com';
$subject = 'Link para questionário de análise neurossistêmica';
$message = "Olá, $name você está recebendo o link para responder o questionário de análise neurossistêmica. Clique no link abaixo para logar e responder o questionário.\n";
$message .= 'https://www.acesseamente.com.br/ans'; 
$headers = "MIME-Version: 1.1\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
$headers .= "From: $from\r\n"; // remetente
if(mail($to, $subject, $message, $headers))
    echo "E-mail enviado com sucesso.";
else
    echo "Erro ao enviar o e-mail.";
?>