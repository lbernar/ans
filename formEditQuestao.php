<?php
$id = $_GET['id'];
include "functions/db-connect.php";

// $db->beginTransaction();
// // Define your SQL statement //
// $query = $db->prepare("SELECT sinal.*, moeda.nome FROM sinal AS sinal INNER JOIN moedas AS moeda ON moeda.id = sinal.moeda_id WHERE sinal.id = :id");
// $query->bindValue(':id', $id);
// $query->execute();
// $sql = $query->fetchAll(PDO::FETCH_ASSOC)[0];
// $db->commit();
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
                  <input type="text" required name="num_quest" class="form-control" value="<?=$sql['num_quest']?>">
                </div>
                <div class="form-group">
                  <label>Questão :</label>
                  <!-- /.box-header -->
                  <div class="box-body pad">
                    <form>
                      <textarea class="textarea" name="question" placeholder="Digite a questão..." style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        <?=$sql['question']?>
                      </textarea>
                    </form>
                  </div>
                </div>
                <div class="form-group">
                  <label>Categoria da questão:</label>
                  <select required name="category" class="form-control">
                    <option selected="selected" value="<?=$sql['moeda_id'];?>"><?=$sql['nome']?></option>
                    <option>--------------------------------------------------------------------------</option>
                    <?php
                      // include_once "functions/db-connect.php";
                      // $sth = $db->prepare("SELECT * FROM categories ORDER BY nome ASC");
                      // $sth->execute();
                      // $category = $sth->fetchAll(PDO::FETCH_ASSOC);
					  // for($i=0;$i < count($category); $i++){  
					?>
					<option required value="<?=$category[$i]['id'];?>"><?=$category[$i]['name'];?></option>
                    <?php //} ?>						
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

