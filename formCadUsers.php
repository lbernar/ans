
<?php 
 if($_SESSION['userProfile']['level'] == 0) {
  $option = base64_encode('welcome');
  echo "<script>
        alert('Você não tem permissão para acessar essa página!')
        window.location.href = 'index.php?$option'
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
                  <label>Celular :</label>
                  <input type="text" name="phone" class="form-control" id="phone">
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
                    <option selected="selected">Selecione um tipo sanguíneo...</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
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
        <section class="content-header">
          <!-- row -->
          <div  class="row">
            <div class="col-md-12 ">
              <div class="box">
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
                        <th>Data/Hora Conclusão</th>
                        <th>Ação</th>
                        <th>Relatório</th>
                        <th>Enviar E-mail</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div> 
            </div> 
          </div>  
          <!-- /.row -->
        </section>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->