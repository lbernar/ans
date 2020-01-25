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
		Cadastro de Alternativas
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-edit"></i>CADASTROS</li>
        <li class="active">Alternativas</li>
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
              <form action="functions/addAlternativa.php" method="POST" id="form_sinal" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Questão:</label>
                  <select required name="quest_id" class="form-control">
                    <option selected="selected">Selecione uma questão...</option>
                    <?php
                      include_once "functions/db-connect.php";
                      $sth = $db->prepare("SELECT * FROM questions ORDER BY quest_id ASC");
                      $sth->execute();
                      $quest = $sth->fetchAll(PDO::FETCH_ASSOC);
					            for($i=0;$i < count($quest); $i++){  
                    ?>
                    <option required value="<?=$quest[$i]['quest_id'];?>"><?=$quest[$i]['question'];?></option>
                    <?php } ?>						
                  </select>
                </div>
                <div class="form-group ">
                  <label>Número da alternativa :</label>
                  <input type="number" required name="alternative_id" onkeypress="return isNumber(event)" class="form-control">
                </div>
                <div class="form-group">
                  <label>Alternativa :</label>
                  <!-- /.box-header -->
                  <div class="box-body pad">
                      <textarea class="textarea" name="response" placeholder="Digite a afirmação da questão selecionada..." style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
    <section class="content-header">
    <!-- row -->
    <div  class="row">
      <div class="col-md-12 ">
        <div class="box">
          <div class="box-body">
            <table id="tableAlternativas" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID Interno</th>
                  <th>ID Questão</th>
                  <th>ID Alternativa</th>
                  <th>Enunciado</th>
                  <th>Tipo</th>
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

