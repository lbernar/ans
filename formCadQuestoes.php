<?php 
 if($_SESSION['userProfile']['level'] == 0) {
  $option = base64_encode('welcome');
  echo "<script>
        alert('Você não tem permissão para acessar essa página!')
        window.location.href = 'index.php?$option'
        </script>";
}
include "functions/db-connect.php";

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
                  <input type="text" required name="num_quest" onkeypress="return isNumber(event)" class="form-control">
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
                      $type = $sth->fetchAll(PDO::FETCH_ASSOC);
							        for($i=0;$i < count($type); $i++){  
							      ?>
							      <option required value="<?=$type[$i]['id'];?>"><?=$type[$i]['type_desc'];?></option>
                    <?php } ?>						
                  </select>
                </div>
                <div class="form-group">
                  <label>Business Unit:</label>
                  <select required name="bu" class="form-control">
                    <option selected="selected">Selecione uma business unit...</option>
                    <?php
                      $sth = $db->prepare("SELECT * FROM business_unit ORDER BY title ASC");
                      $sth->execute();
                      $bu = $sth->fetchAll(PDO::FETCH_ASSOC);
							        for($i=0;$i < count($bu); $i++){  
							      ?>
							      <option required value="<?=$bu[$i]['id'];?>"><?=$bu[$i]['title'];?></option>
                    <?php } ?>						
                  </select>
                </div>
                <div class="form-group">
                  <label>Categoria:</label>
                  <select required name="category" class="form-control">
                    <option selected="selected">Selecione uma categoria...</option>
                    <?php
                      $sth = $db->prepare("SELECT * FROM categories ORDER BY class ASC");
                      $sth->execute();
                      $category = $sth->fetchAll(PDO::FETCH_ASSOC);
							        for($i=0;$i < count($category); $i++){  
							      ?>
							      <option required value="<?=$category[$i]['id'];?>"><?=$category[$i]['class'] . '-' . $category[$i]['sub_class'];?></option>
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
    <section class="content-header">
    <!-- row -->
    <div  class="row">
      <div class="col-md-12 ">
        <div class="box">
          <div class="box-body">
            <table id="tableQuestoes" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Enunciado</th>
                  <th>Tipo</th>
                  <th>B.U</th>
                  <th>Categoria</th>
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

