<?php
include_once "functions/db-connect.php";
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		Cadastro de Business Unit
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-edit"></i>CADASTROS</li>
        <li class="active">Business Unit</li>
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
              <form action="functions/addBU.php" method="POST" id="form_bu" enctype="multipart/form-data">
                <div class="form-group ">
                  <label>Título :</label>
                  <input type="text" required name="title" class="form-control">
                </div>
                <div class="form-group ">
                  <label>Total :</label>
                  <input type="number" required name="total" class="form-control">
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
            <table id="tableBU" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Título</th>
                  <th>Total</th>
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

