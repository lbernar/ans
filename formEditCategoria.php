<?php
$id = $_GET['id'];
include "functions/db-connect.php";
if($_SESSION['userProfile']['level'] == 0) {
  $option = base64_encode('welcome');
  echo "<script>
        alert('Você não tem permissão para acessar essa página!')
        window.location.href = 'index.php?$option'
        </script>";
}
$db->beginTransaction();
// Define your SQL statement //
$query = $db->prepare("SELECT class, sub_class FROM categories WHERE id = :id");
$query->bindValue(':id', $id);
$query->execute();
$sql = $query->fetchAll(PDO::FETCH_ASSOC)[0];
$db->commit();
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		Editar Categoria
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-edit"></i>ATUALIZAÇÕES</li>
        <li class="active">Categorias</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content-header">
    <!-- row -->
      <div  class="row">
     <!-- col -->
        <div class="col-md-10 col-md-offset-1">
	    <!-- general form elements disabled -->
          <div class="box">
            <div class="box-header with-border"></div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="functions/addCategoria.php" method="POST" id="form_category" enctype="multipart/form-data">
                <div class="form-group ">
                  <label>Classe :</label>
                  <input type="text" required name="class" value="<?=$sql['class']?>" class="form-control">
                </div>
                <div class="form-group ">
                  <label>Sub Classe :</label>
                  <input type="text" required name="sub_class" value="<?=$sql['sub_class']?>" class="form-control">
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Salvar</button>
                </div>
                <!-- text input -->
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <section class="content-header">
    <!-- row -->
    <div  class="row">
      <div class="col-md-12 ">
        <div class="box">
          <div class="box-body">
            <table id="tableCategorias" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Classe</th>
                  <th>Sub Classe</th>
                  <th>Ação</th>
                </tr>
              </thead>
            </table>
          </div>
        </div> 
      </div> 
    </div>  
    <!-- /.row -->
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- /.Main content -->
</section>         
  </div>
  <!-- /.content-wrapper -->

