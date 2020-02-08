<?php
session_start();
include "db-connect.php";
$db->beginTransaction();

if(isset($_FILES['logo']['name']) && strlen($_FILES['logo']['name']) > 0) {
  $rotation = $_POST['rotation']; 
  $uploaddir = '../images/';
  $logo = md5($_FILES['logo']['name']) . '.jpg';
  $uploadfile = $uploaddir . $logo;
  $extensao = explode('.', $_FILES['logo']['name']);
  $extensao = strtolower(end($extensao));
  if ($extensao != 'jpg') {
    echo"<script>
    alert('Extensão não suportada, por favor use um arquivo jpg .');
    </script>";
  exit;
  }
  if($rotation == -90 || $rotation == 270){ 
      $rotation = 90; 
  }elseif($rotation == -180 || $rotation == 180){ 
      $rotation = 180; 
  }elseif($rotation == -270 || $rotation == 90){ 
      $rotation = 270; 
  } 
    
  if(!empty($rotation)){ 
    $source = imagecreatefromjpeg($_FILES['logo']['tmp_name']); 
    $imageRotate = imagerotate($source, $rotation, 0); 
    $upload = imagejpeg($imageRotate, $filePath);    
  }
  elseif(move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) {
    echo"<script>
        alert('Arquivo salvo com sucesso.');
      </script>";
  }
}
else {
  $logo = str_replace('images/', '', $_SESSION['logo']);
}

if(empty($_POST['id']) && $db->lastInsertId() == 0) 
  $sth = $db->prepare("INSERT INTO config (ini_msg, final_msg, logo) VALUES (:ini_msg, :final_msg, :logo)");
else {
  $sth = $db->prepare("UPDATE config SET ini_msg = :ini_msg, final_msg = :final_msg, logo = :logo WHERE id = :id");
  $sth->bindValue(':id', $_POST['id']);
}
//faço o bind das váriaveis.
  $sth->bindValue(':ini_msg', $_POST['ini_msg']);
  $sth->bindValue(':logo', $logo);
  $sth->bindValue(':final_msg', $_POST['final_msg']);

 //Verifico se o registro foi inserido com sucesso ao mesmo tempo em que executa a query
 if($sth->execute()) {
  $db->commit();
  $option = base64_encode('cadConfig');
  unset($_SESSION['logo']);
  $_SESSION['logo'] = "images/" . $logo;
  echo "<script>
  alert('Configuração alterada com sucesso!')
  window.location.href = '../index.php?$option'
  </script>";
}
else {
  $db->commit();
  $option = base64_encode('cadConfig');
  echo "<script>
  alert('Houve um problema em atualizar a configuração, por favor contate o administrador do sistema!')
  window.location.href = '../index.php?$option'
  </script>";
}
?>
