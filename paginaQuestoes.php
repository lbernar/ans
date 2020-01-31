<?php 
include 'functions/db-connect.php';
$db->beginTransaction();
$lastPage = $_SESSION['userProfile']['last_page'];
//Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina 
$num_pag = str_replace('page=', '', explode('&',base64_decode(key($_GET)))[1]);
$pagina = (!empty($num_pag) && is_numeric($num_pag)) ? $num_pag : 0;

if($lastPage == $pagina){
    $next = $pagina + 1;
    $option = base64_encode("respondeQuestoes&page=$next");
    echo "<script>
            window.location.href = 'index.php?$option'
        </script>"; 
}

//Contar o total de cursos
$totalQuestions = $db->prepare("SELECT q.quest_id, q.question, t.question_type FROM questions AS q 
                                INNER JOIN type_questions AS t ON q.type_id = t.id");
$totalQuestions->execute();
$totalQuestions = count($totalQuestions->fetchAll(PDO::FETCH_ASSOC));

//Selecionar os cursos a serem apresentado na página
$resultQuest = $db->prepare("SELECT q.quest_id, q.question, t.question_type FROM questions AS q 
                            INNER JOIN type_questions AS t ON q.type_id = t.id ORDER BY LENGTH(q.quest_id),q.quest_id LIMIT $pagina, 1");
$resultQuest->execute();
$resultQuest = $resultQuest->fetchAll(PDO::FETCH_ASSOC)[0];

$db->commit();
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
    <!-- Default box -->
        <div class="box">
            <form action="" method="POST" class="form form-horizontal" id="form_response">
                <input type="hidden" name="page" value="<?=$pagina?>">
                <input type="hidden" name="quant_quest" value="<?=$totalQuestions?>">
                <input type="hidden" name="quest_id" value="<?=$resultQuest['quest_id']?>">
                <input type="hidden" name="user_id" value="<?=$_SESSION['userProfile']['user_id']?>">
                <div class="box-body">
                    <section class="content-header">
                        <!-- row -->
                        <div  class="row">
                        <!-- col -->
                            <div class="col-md-12">
                            <!-- general form elements disabled -->
                                <div class="box-header "></div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="form-group ">
                                        <h4><label>Questão :</label></h4>
                                        <div>
                                            <?=$resultQuest['question']?>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <h4><label>Afirmações :</label></h4>
                                            <?php
                                                $resultAltern = $db->prepare("SELECT quest_id, alternative_id, response FROM alternatives WHERE quest_id = :quest_id ORDER BY id ASC");
                                                $resultAltern->bindValue(':quest_id', $resultQuest['quest_id']);
                                                $resultAltern->execute();
                                                $resultAltern = $resultAltern->fetchAll(PDO::FETCH_ASSOC);
                                                for($i=0;$i<count($resultAltern);$i++):
                                                    if($resultQuest['question_type'] == 'P'): 
                                            ?>
                                                <div class="form-group" >
                                                    <div>
                                                        <?=$resultAltern[$i]['response']?>
                                                    </div>
                                                    <select class="peso form-control" name="peso[<?=$resultAltern[$i]['alternative_id']?>]">
                                                        <option value="" selected="selected">Selecione um peso...</option>
                                                        <option value=1>1</option>
                                                        <option value=2>2</option>
                                                        <option value=3>3</option>
                                                        <option value=4>4</option>
                                                        <option value=5>5</option>
                                                        <option value=6>6</option>
                                                        <option value=7>7</option>
                                                        <option value=8>8</option>
                                                        <option value=9>9</option>
                                                        <option value=10>10</option>
                                                        <option value=11>11</option>
                                                        <option value=12>12</option>
                                                        <option value=13>13</option>
                                                        <option value=14>14</option>
                                                        <option value=15>15</option>
                                                    </select>
                                                </div>
                                                <?php elseif($resultQuest['question_type'] == 'M'):?>
                                                    <div class="multipla form-group">
                                                        <input class="form-check-input multiple" type="checkbox" name="mult[]" value="<?=$resultAltern[$i]['alternative_id']?>">
                                                        <label class="form-check-label">
                                                            <?=$resultAltern[$i]['response']?>
                                                        </label>
                                                    </div> 
                                                <?php elseif($resultQuest['question_type'] == 'S'): ?>
                                                    <div class="single form-check form-check-inline">
                                                        <input class="form-check-input single" type="radio" name="single" value="<?=$resultAltern[$i]['alternative_id']?>" >
                                                        <label class="form-check-label" for="inlineRadio1"><?=$resultAltern[$i]['response']?></label>
                                                    </div>
                                                <?php endif;?>
                                            <?php endfor;?>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            <!-- /.box -->
                            </div>
                            <!--/.col (right) -->
                        </div>
                    <!-- /.row -->
                    </section>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button id='btn_save_cont' disabled='disabled' class='btn-primary btn-flat pull-right'>Salvar e Continuar</button>
                </div>
            </form>
        <!-- /.box-footer-->
        </div>
    <!-- /.box -->
    </section>
  </div>
  <!-- /.content-wrapper -->

