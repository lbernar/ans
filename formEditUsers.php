<?php
if($_SESSION['level'] == 0) {
  echo "<script>
  
        alert('Você não tem permissão para acessar essa página!')
        window.location.href = 'index.php?option=1'
        </script>";
}
$id = $_GET['id'];
include "functions/db-connect.php";

$db->beginTransaction();
// Define your SQL statement //
$query = $db->prepare("SELECT * FROM users WHERE id = :id");
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
		Editar Cadastro de Usuários do Sistema
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-edit"></i>ATUALIZAÇÕES</li>
        <li class="active">Usuários do Sistema</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content-header">
    <!-- row -->
      <div  class="row">
     <!-- col -->
        <div class="col-md-6 col-md-offset-3">
	    <!-- general form elements disabled -->
          <div class="box">
            <div class="box-header with-border">
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteUser">
                Deletar Usuário
              </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form role="form" method=POST action="functions/updateUsers.php">
              <input type='hidden' name='id' value="<?=$sql['id']?>">
                <!-- text input -->
                <div class="form-group">
                  <label>Nome :</label>
                  <input type="text" required name="name" class="form-control" value="<?=$sql['nome']?>">
                </div>
                <div class="form-group">
                  <label>E-mail IQ Option ::</label>
                  <input type="text"  name="userId" class="form-control" value="<?=$sql['user_id']?>">
                </div>
                <div class="form-group">
                  <label>Usuário Ativo :</label>
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" value=1 <?php if($sql['ativo'] == 1){echo "checked=checked";}?> name="active">
                    <label class="custom-control-label" for="defaultGroupExample3">Sim</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" value=0 <?php if($sql['ativo'] == 0){echo "checked=checked";}?> name="active">
                    <label class="custom-control-label" for="defaultGroupExample3">Não</label>
                  </div>
                </div>
                <div class="form-group">
                  <label>Nível de Acesso :</label>
                  <select name="level" class="form-control">
                    <option required selected="selected"><?php if($sql['level']==1){echo "Adminstrador";}else{echo "Usuário";}?></option>
                    <option>--------------------------------------------------------------------------</option>
                    <option value=0>Usuário</option>
                    <option value=1>Administrador</option>
                  </select>
                </div>
              <!-- /.form group -->
                <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Salvar</button>
              </div>
              <div class="modal fade" id="modalDeleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <h3>Deseja mesmo deletar esse usuário?</h3>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="delete_buttonUser" class="btn btn-danger">Deletar</button>
                  </div>
                </div>
              </div>
            </div>
                </div>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- /.Main content -->
</section>         
  </div>
  <!-- /.content-wrapper -->

