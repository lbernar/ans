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
            <div class="box-header with-border">
                <h3 class="box-title">Bem Vindo(a)</h3>
            </div>
            <div class="box-body">
                <?=$query['ini_msg']?>
            </div>
            <!-- /.box-body -->
            <div class="box-footer"></div>
        <!-- /.box-footer-->
        </div>
    <!-- /.box -->
    </section>
  </div>
  <!-- /.content-wrapper -->

