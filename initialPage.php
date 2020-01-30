<?php 
include 'functions/db-connect.php';
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
                <div class="box-header with-border">
                    <h3 class="box-title">Bem Vindo(a) ao questionário de análise neurossistêmica</h3>
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
  </div>
  <!-- /.content-wrapper -->

