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
          <div class="box-header with-border">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete">
              Deletar Categoria
            </button>
          </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="functions/updateCategoria.php" method="POST" id="form_category" enctype="multipart/form-data">
              <input type='hidden' name='id' value="<?=$id?>">
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
            <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <h3>Deseja mesmo deletar essa categoria?</h3>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="delete_button_cat" class="btn btn-danger">Deletar</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
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

