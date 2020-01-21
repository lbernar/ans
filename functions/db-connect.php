<?php
$db = "";
$user = 'mentecina';
$pass = 'Mklo0410!@#';
try
{
$db = new PDO('mysql:host=107.180.25.236;dbname=mentecina;charset=utf8', $user, $pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
}
catch(PDOException $e)
  {
    print 'Exception : '.$e->getMessage();
  }

?>
