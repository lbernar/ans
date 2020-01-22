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
$query = $db->prepare("SELECT quest.id, quest.quest_id, quest.question, tq.type_desc, tq.id AS type_id, cat.class, cat.id AS category_id,  bu.id AS bu_id, bu.title 
FROM questions AS quest 
INNER JOIN type_questions AS tq ON tq.id = quest.type_id
INNER JOIN categories AS cat ON cat.id = quest.category_id 
INNER JOIN business_unit AS bu ON quest.bu_id = bu.id
 WHERE quest.quest_id = :id");
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
		Editar Questão
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-edit"></i>ATUALIZAÇÕES</li>
        <li class="active">Questão</li>
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
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete">
                Deletar Questão
              </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form role="form" method=POST action="functions/updateQuestao.php">
              <input type='hidden' name='id' value="<?=$sql['id']?>">
                <div class="form-group">
                  <label>Número da questão :</label>
                  <input type="number" required name="num_quest" class="form-control" value="<?php echo str_replace('Q','',$sql['quest_id']); ?>">
                </div>
                <div class="form-group">
                  <label>Questão :</label>
                  <!-- /.box-header -->
                  <div class="box-body pad">
                    <textarea class="textarea" name="question" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                      <?=$sql['question']?>
                    </textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label>Tipo da questão:</label>
                  <select required name="type" class="form-control">
                    <option required selected="selected" value="<?=$sql['type_id'];?>"><?=$sql['type_desc']?></option>
                    <option>--------------------------------------------------------------------------</option>
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
                    <option required value="<?=$sql['bu_id']?>" selected="selected"><?=$sql['title']?></option>
                    <option>--------------------------------------------------------------------------</option>
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
                    <option required value="<?=$sql['category_id']?>" selected="selected"><?=$sql['class']?></option>
                    <option>--------------------------------------------------------------------------</option>
                    <?php
                      $sth = $db->prepare("SELECT * FROM categories ORDER BY class ASC");
                      $sth->execute();
                      $category = $sth->fetchAll(PDO::FETCH_ASSOC);
							        for($i=0;$i < count($category); $i++){  
							      ?>
							      <option required value="<?=$category[$i]['id'];?>"><?=$category[$i]['class'];?></option>
                    <?php } ?>						
                  </select>
                </div>
                <!-- /.form group -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Salvar</button>
                </div>
              </form>
            </div>
            <!-- Button trigger modal -->
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
                    <h3>Deseja mesmo deletar essa questão?</h3>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="delete_button" class="btn btn-danger">Deletar</button>
                  </div>
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

