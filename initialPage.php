<?php 
include 'functions/db-connect.php';
if($_SESSION['userProfile']['status_quest'] == 'C') {
    $option = base64_encode("finalPage");
    echo "<script>
            window.location.href = 'index.php?$option'
        </script>"; 
 }
$db->beginTransaction();
// Define your SQL statement //
$query = $db->prepare("SELECT ini_msg FROM config");
$query->execute();
$query = $query->fetchAll(PDO::FETCH_ASSOC)[0];
$db->commit();
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
    <!-- Default box -->
        <div class="box">
            <form action="functions/updateInitialPage.php" method="POST" class="form form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?=$_SESSION['userProfile']['user_id']?>">
                <input type="hidden" name="last_page" value="<?=$_SESSION['userProfile']['last_page']?>">
                <input type="hidden" name="status_quest" value="<?=$_SESSION['userProfile']['status_quest']?>">
                <div class="box-header with-border">
                    <h3 class="box-title">Bem Vindo(a) <?=$_SESSION['userProfile']['name']?> ao questionário de análise neurossistêmica</h3>
                </div>
                <div class="box-body">
                    <?=$query['ini_msg']?>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class='btn-primary btn-flat pull-right'>Iniciar Questionário</button>
                </div>
            </form>
        <!-- /.box-footer-->
        </div>
    <!-- /.box -->
    </section>
    <div class="alert alert-warning alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Aviso!</strong> Utilizamos cookies e tecnologias semelhantes para entender como você usa nosso site e criar experiências mais valiosas para você.
            Ao usar este site, você concorda com o uso de cookies e tecnologias semelhantes.
  </div>
  </div>
  
  <!-- /.content-wrapper -->

