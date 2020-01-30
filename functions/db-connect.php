<?php
$db = "";
$user = 'acesse74_menteci';
$pass = 'Mklo0410!@#';
try
{
$db = new PDO('mysql:host=br976.hostgator.com.br;dbname=acesse74_mentecina;charset=utf8', $user, $pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
}
catch(PDOException $e)
  {
    print 'Exception : '.$e->getMessage();
  }

?>