<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		Cadastro de Respostas
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-edit"></i>CADASTROS</li>
        <li class="active">Respostas</li>
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
              <form action="functions/addResposta.php" method="POST" id="form_sinal" enctype="multipart/form-data">
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
                <div class="form-group">
                  <label>Resposta :</label>
                  <!-- /.box-header -->
                  <div class="box-body pad">
                      <textarea class="textarea" name="response" placeholder="Digite a resposta da questão selecionada..." style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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

