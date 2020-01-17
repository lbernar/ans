<?php
$db = "";
$dbDir = dirname(dirname(__FILE__))."/data/IQAPI.db";
try
  {
$db = new PDO("sqlite:$dbDir");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
}
catch(PDOException $e)
  {
    print 'Exception : '.$e->getMessage();
  }

?>
