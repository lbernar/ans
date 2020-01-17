<?php
include "db-connect.php";
$id = str_replace("/","", $_POST['id']);
$gale = $_POST['gale'];
$foto = md5($_FILES['foto']['name']) . '.jpg';
$conta = $_POST['conta'];
$stopLoss = str_replace('$', '',$_POST['stop_loss']);
$stopGain = str_replace('$', '',$_POST['stop_gain']);
$smartGale = $_POST['smart_gale'];
$rotation = $_POST['rotation']; 

if(isset($_FILES['foto']['name']) && strlen($_FILES['foto']['name']) > 0) {
  $uploaddir = 'uploads/fotos/';
  $uploadfile = $uploaddir . $foto;
  $extensao = explode('.', $_FILES['foto']['name']);
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
    $source = imagecreatefromjpeg($_FILES['foto']['tmp_name']); 
    $imageRotate = imagerotate($source, $rotation, 0); 
    $upload = imagejpeg($imageRotate, $filePath);    
  }
  elseif(move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile))
    echo "Arquivo Salvo";

}

$db->beginTransaction();
$query = $db->prepare("UPDATE users SET gale = :gale, foto = :foto, conta = :conta, stop_loss = :stop_loss, stop_gain = :stop_gain, smart_gale = :smart_gale WHERE id = :id");
$query->bindValue(':id', $id);
$query->bindValue(':gale', $gale);
$query->bindValue(':foto', $foto);
$query->bindValue(':conta', $conta); 
$query->bindValue(':smart_gale', $smartGale); 
$query->bindValue(':stop_loss', $stopLoss); 
$query->bindValue(':stop_gain', $stopGain); 
$sth = $query->execute();
$db->commit();
//Verifico se o registro foi inserido com sucesso
$_SESSION['userProfile']['avatar'] = $uploadfile;
if ($sth) {
    $option = base64_encode('configura');
    header("Location: ../index.php?$option"); 
}
else {
    echo "Não foi possivel inserir o registro - entre em contato com o webmaster ";
}
?>
