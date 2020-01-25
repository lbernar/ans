<?php 
include 'functions/db-connect.php';
$db->beginTransaction();
// Define your SQL statement //
$query = $db->prepare("SELECT last_page FROM status");
$query->execute();
$lastPage = $query->fetchAll(PDO::FETCH_ASSOC)[0];

//Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina 
$num_pag = str_replace('page=', '', explode('&',base64_decode(key($_GET)))[1]);
$pagina = (!empty($num_pag) && is_numeric($num_pag)) ? $num_pag : 0;

if($lastPage == $pagina && !empty($lastPage)){
    $next = $page + 1;
    $option = base64_encode("respondeQuestoes&page=$next");
    echo "<script>
    alert('Você já respondeu essa questão, por favor responda a próxima!')
    window.location.href = 'index.php?$option'
    </script>"; 
}

//Contar o total de cursos
$totalQuestions = $db->prepare("SELECT q.quest_id, q.question, t.type_desc FROM questions AS q 
                                INNER JOIN type_questions AS t ON q.type_id = t.id");
$totalQuestions->execute();
$totalQuestions = count($totalQuestions->fetchAll(PDO::FETCH_ASSOC));

//Selecionar os cursos a serem apresentado na página
$resultQuest = $db->prepare("SELECT q.quest_id, q.question, t.type_desc FROM questions AS q 
                            INNER JOIN type_questions AS t ON q.type_id = t.id LIMIT $pagina, 1");
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
                                                $resultAltern = $db->prepare("SELECT quest_id, alternative_id, response FROM alternatives WHERE quest_id = :quest_id");
                                                $resultAltern->bindValue(':quest_id', $resultQuest['quest_id']);
                                                $resultAltern->execute();
                                                $resultAltern = $resultAltern->fetchAll(PDO::FETCH_ASSOC);
                                                for($i=0;$i<count($resultAltern);$i++):
                                                    if($resultQuest['type_desc'] == 'Peso'): 
                                            ?>
                                                <div class="form-group" >
                                                    <div>
                                                        <?=$resultAltern[$i]['response']?>
                                                    </div>
                                                    <select required class="peso form-control" name="peso[<?=$resultAltern[$i]['alternative_id']?>]">
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
                                                <?php elseif($resultQuest['type_desc'] == 'M'): ?>
                                                    <div class="multipla form-group">
                                                        <input class="form-check-input" type="checkbox" name="mult[]" value="<?=$resultAltern[$i]['alternative_id']?>" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            <?=$resultAltern[$i]['response']?>
                                                        </label>
                                                    </div> 
                                                <?php elseif($resultQuest['type_desc'] == 'S'): ?>
                                                    <div class="single form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="single" id="inlineRadio1" value="<?=$resultAltern[$i]['alternative_id']?>" >
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
