<?php 
 if($_SESSION['level'] == 0) {
  $option = base64_encode('welcome');
  echo "<script>
  
        alert('Você não tem permissão para acessar essa página!')
        window.location.href = 'index.php?' . $option
        </script>";
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
		  Consulta Respostas
    </h1>
  </section>
  <!-- Main content -->
  <section class="content-header">
    <!-- row -->
    <div  class="row">
      <div class="col-md-12 ">
        <div class="box">
          <div class="box-body">
            <table id="tableRespostas" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>ID Questão</th>
                  <th>Enunciado</th>
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

