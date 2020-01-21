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
$query = $db->prepare("SELECT asw.id, asw.quest_id, asw.response, q.question FROM answers AS asw INNER JOIN questions AS q ON asw.quest_id = q.quest_id WHERE asw.id = :id");
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
		Editar Afirmação
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-edit"></i>ATUALIZAÇÕES</li>
        <li class="active">Resposta</li>
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
                Deletar Afirmação
              </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form role="form" method=POST action="functions/updateAlternativa.php">
              <input type='hidden' name='id' value="<?=$sql['id']?>">
                <div class="form-group">
                  <label>Questão:</label>
                  <select required name="quest_id" class="form-control">
                    <option required value="<?=$sql['quest_id']?>" selected="selected"><?=$sql['question']?></option>
                    <option>--------------------------------------------------------------------------</option>
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
                  <input type="number" value="<?=$sql['alternative_id']?>" required name="alternative_id" class="form-control">
                </div>
                <div class="form-group">
                  <label>Afirmação :</label>
                  <!-- /.box-header -->
                  <div class="box-body pad">
                      <textarea class="textarea" name="response" placeholder="Digite a resposta da questão selecionada..." style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                      <?=$sql['response']?>
                      </textarea>
                  </div>
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
                    <h3>Deseja mesmo deletar essa afirmação?</h3>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="delete_button_resp" class="btn btn-danger">Deletar</button>
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

