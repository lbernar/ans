<?php
include_once "functions/db-connect.php";
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		Cadastro de Questões
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-edit"></i>CADASTROS</li>
        <li class="active">Questões</li>
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
              <form action="functions/addQuestao.php" method="POST" id="form_quest" enctype="multipart/form-data">
                <div class="form-group ">
                  <label>Número da questão :</label>
                  <input type="number" required name="num_quest" class="form-control">
                </div>
                <div class="form-group">
                  <label>Questão :</label>
                  <!-- /.box-header -->
                  <div class="box-body pad">
                    <textarea class="textarea" name="question" placeholder="Digite a questão..." style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label>Tipo da questão:</label>
                  <select required name="type" class="form-control">
                    <option selected="selected">Selecione um tipo de questão...</option>
                    <?php
                      $sth = $db->prepare("SELECT * FROM type_questions ORDER BY type_desc ASC");
                      $sth->execute();
                      $category = $sth->fetchAll(PDO::FETCH_ASSOC);
                      var_dump($category);
							        for($i=0;$i < count($category); $i++){  
							      ?>
							      <option required value="<?=$category[$i]['id'];?>"><?=$category[$i]['type_desc'];?></option>
                    <?php } ?>						
                  </select>
                </div>
                <div class="form-group">
                  <label>Business Unit:</label>
                  <select required name="bu" class="form-control">
                    <option selected="selected">Selecione uma business unit...</option>
                    <?php
                      $sth = $db->prepare("SELECT * FROM type_questions ORDER BY type_desc ASC");
                      $sth->execute();
                      $category = $sth->fetchAll(PDO::FETCH_ASSOC);
                      var_dump($category);
							        for($i=0;$i < count($category); $i++){  
							      ?>
							      <option required value="<?=$category[$i]['id'];?>"><?=$category[$i]['type_desc'];?></option>
                    <?php } ?>						
                  </select>
                </div>
                <div class="form-group">
                  <label>Categoria:</label>
                  <select required name="category" class="form-control">
                    <option selected="selected">Selecione uma categoria...</option>
                    <?php
                      $sth = $db->prepare("SELECT * FROM type_questions ORDER BY type_desc ASC");
                      $sth->execute();
                      $category = $sth->fetchAll(PDO::FETCH_ASSOC);
                      var_dump($category);
							        for($i=0;$i < count($category); $i++){  
							      ?>
							      <option required value="<?=$category[$i]['id'];?>"><?=$category[$i]['type_desc'];?></option>
                    <?php } ?>						
                  </select>
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

