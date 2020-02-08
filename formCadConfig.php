<?php
if($_SESSION['userProfile']['level'] == 0) {
  $option = base64_encode('welcome');
  echo "<script>
        alert('Você não tem permissão para acessar essa página!')
        window.location.href = 'index.php?$option'
        </script>";
}
include "functions/db-connect.php";
$db->beginTransaction();
// Define your SQL statement //
$query = $db->prepare("SELECT id, ini_msg, final_msg FROM config");
$query->execute();
$sql = $query->fetchAll(PDO::FETCH_ASSOC)[0];
$db->commit();
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		Cadastro de Configuração
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-edit"></i>CADASTROS</li>
        <li class="active">Configuração</li>
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
              <form action="functions/updateConfig.php" method="POST" id="form_config" enctype="multipart/form-data">
              <input type='hidden' name='id' value="<?=$sql['id']?>">
                <div class="form-group">
                  <label>Mensagem Inicial :</label>
                  <!-- /.box-header -->
                  <div class="box-body pad">
                      <textarea class="textarea" name="ini_msg" placeholder="Digite a mensagem inicial do sistema..." style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        <?=$sql['ini_msg']?>
                      </textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label>Mensagem Final :</label>
                  <!-- /.box-header -->
                  <div class="box-body pad">
                      <textarea class="textarea" name="final_msg" placeholder="Digite a final do sistema..." style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        <?=$sql['final_msg']?>
                      </textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label>Subir Logo :</label>
                  <input type="file" name="logo" id="file" class="">
                  <input type="hidden" name="rotation" id="rotation" value="0"/>
                </div>
                <div id="logo_atual" class="form-group">
                  <div>
                    <label>Logo :</label>
                  </div>
                  <div class="image">
                    <div class="form-group">
                      <button id="rleft">Girar a esquerda</button>
                      <button id="rright">Girar a direita</button>
                    </div>
                    <div id="imgPreview" ></div>
                  </div>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- /.Main content -->
</section>         
  </div>
  <!-- /.content-wrapper -->

