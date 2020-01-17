
<?php 
 if($_SESSION['level'] == 1) {
  echo "<script>
  
        alert('Você não tem permissão para acessar essa página!')
        window.location.href = 'index.php?option=1'
        </script>";
}
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		Cadastro de Usuários
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-edit"></i>CADASTROS</li>
        <li class="active">Usuários</li>
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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method=POST action="functions/addUsers.php">
                <!-- text input -->
                <div class="form-group">
                  <label>Nome :</label>
                  <input type="text" required name="name" class="form-control" placeholder="João da Silva">
                </div>
                <div class="form-group">
                  <label>E-mail :</label>
                  <input type="text"  name="email" class="form-control" placeholder="jsilva@gmail.com">
                </div>
                <div class="form-group">
                  <label>Senha :</label>
                  <input type="text"  name="password" class="form-control" id="password">
                  <button type="button" class="btn-flat btn btn-success" id="passGen">Gerar Senha</button> 
                </div>
                <div class="form-group">
                  <label>Nível de Acesso :</label>
                  <select required name="level" class="form-control">
                    <option required selected="selected">Selecione um nível...</option>
                    <option value=0>Usuário</option>
                    <option value=1>Administrador</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tipo Sanguíneo:</label>
                  <select required name="blood_type" class="form-control">
                    <option required selected="selected">Selecione um tipo sanguíneo...</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                  </select>
                </div>
              <!-- /.form group -->
                <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Salvar</button>
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

