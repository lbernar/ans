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
$query = $db->prepare("SELECT title FROM business_unit WHERE id = :id");
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
		    Editar Business Unit
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-edit"></i>ATUALIZAÇÕES</li>
        <li class="active">Business Unit</li>
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
                Deletar B.U
              </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="functions/updateBusinessUnit.php" method="POST" id="form_bu" enctype="multipart/form-data">
                <input type='hidden' name='id' value="<?=$id?>">
                <div class="form-group ">
                  <label>Título :</label>
                  <input type="text" required value="<?=$sql['title']?>" name="title" class="form-control">
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Salvar</button>
                </div>
                <!-- text input -->
              </form>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <h3>Deseja mesmo deletar essa business unit?</h3>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="delete_button_bu" class="btn btn-danger">Deletar</button>
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

