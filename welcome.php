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
            <section class="content-header">
                <!-- row -->
                <div  class="row">
                    <div class="col-md-12 ">
                        <div class="box-body">
                        <table id="tableUsers" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome do Usuário</th>
                                <th>E-mail</th>
                                <th>Tipo Sanguíneo</th>
                                <th>Nível de Acesso</th>
                                <th>Status de Resposta</th>
                                <th>Ação</th>
                                <th>Relatório</th>
                                <th>Enviar E-mail</th>
                            </tr>
                            </thead>
                        </table>
                        </div>
                    </div> 
                </div>  
                <!-- /.row -->
            </section>
            </div>
            <!-- /.box-body -->
            <div class="box-footer"></div>
        <!-- /.box-footer-->
        </div>
    <!-- /.box -->
    </section>
  </div>
  <!-- /.content-wrapper -->

