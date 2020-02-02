<?php
#----------------------------------------------------------------
# Session Start
session_start();
#-----------------------------------------------------------------
#Error Dump
error_reporting(E_ALL ^ E_NOTICE); 
#ini_set( "display_errors", 0);

#------------------------------------------------------------------
# Session protected
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
  // request 30 minates ago
  session_destroy();
  session_unset();
  header("Location: login-page.php"); exit;
}
if (!isset($_SESSION['userProfile']['user_id'])) { header("Location: login-page.php"); exit; }
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time

#------------------------------------------------------------------
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ANS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Select2 -->
  <link rel="stylesheet" href="css/select2.min.css">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
   <!-- daterange picker -->
  <link rel="stylesheet" type="text/css" href="plugins/datetimepicker-master/jquery.datetimepicker.css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-clockpicker.min.css">
  <link rel="stylesheet" type="text/css" href="css/github.min.css">
 </head>
 
</div>
<!-- ./wrapper -->
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini">
  
  
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        
        <!-- /.control-sidebar-menu -->
          
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  
  
  
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php?option=default" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>ANS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>ANS</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
             <ul class="dropdown-menu">
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                </ul>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          </li>
          <li>
            <a href="logout.php">Sair do Sistema</a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
      <?php 
          if($_SESSION['userProfile']['level'] == 1) {
            echo "  
        <li class='header'>MENU PRINCIPAL</li>        
          <!-- Aqui começa outro Simples-->  
      
            <!-- Aqui começa outro Simples-->    
            <li class='treeview'>
            <a href=index.php?" . base64_encode('cadUsers') . ">
              <i class='fa fa-user-plus'></i> <span>CADASTRO DE USUÁRIOS</span>
            </a>
          </li>  
          <!-- Aqui termina Simples-->
          <li class='treeview'>
            <a href=index.php?" . base64_encode('cadQuest') . ">
              <i class='fa fa-question-circle'></i> <span>CADASTRO DE QUESTÕES</span>
            </a>
          </li>  
          <!-- Aqui começa outro Simples-->    
          <li class='treeview'>
            <a href=index.php?" . base64_encode('cadAltern') . ">
              <i class='fa fa-pencil-square-o'></i> <span>CADASTRO DE ALTERNATIVAS</span>
            </a>
          </li>  
          <!-- Aqui termina Simples-->
          
          <!-- Aqui começa outro Simples-->    
            <li class='treeview'>
            <a href=index.php?" . base64_encode('cadCategoria') . ">
              <i class='fa fa-list-alt'></i> <span>CADASTRO DE CATEGORIAS</span>
            </a>
          </li>  
          <!-- Aqui termina Simples-->
          <!-- Aqui começa outro Simples-->    
            <li class='treeview'>
            <a href=index.php?" . base64_encode('cadBusinessUnit') . ">
              <i class='fa fa-plus-square'></i> <span>CADASTRO DE B.U</span>
            </a>
          </li>  
          <!-- Aqui começa outro Simples-->   
          <li class='treeview'>
            <a href=index.php?" . base64_encode('cadConfig') . ">
              <i class='fa fa-gears'></i> <span>CONFIGURAÇÕES</span>
            </a>
          </li>  
          <!-- Aqui termina Simples-->
            ";
          }

          ?>
    </section>
    <!-- /.sidebar -->
  </aside>

 <?php
$option= explode('&', base64_decode(key($_GET)))[0];
if($_SESSION['userProfile']['level'] == 1)
  $initialOption = 'welcome.php';
else
  $initialOption = 'initialPage.php';
switch ($option) {
    case "cadQuest":
        require_once ('formCadQuestoes.php');
        break;
    case "cadAltern":
      require_once ('formCadAlternativas.php');
      break;
    case "cadUsers":
      require_once ('formCadUsers.php');
      break;
    case "cadCategoria":
      require_once ('formCadCategorias.php');
      break;
    case "cadBusinessUnit":
      require_once ('formCadBusinessUnit.php');
      break;
    case "editUsers":
      require_once ('formEditUsers.php');
      break;
    case "editQuestao":
        require_once ('formEditQuestao.php');
        break;
    case "editAlternativa":
        require_once ('formEditAlternativa.php');
        break;
    case "editCategoria":
      require_once ('formEditCategoria.php');
      break;
    case "editBusinessUnit":
      require_once ('formEditBusinessUnit.php');
      break;
    case "welcome":
      require_once ('welcome.php');
      break;
    case "cadConfig":
      require_once ('formCadConfig.php');
      break;
    case "respondeQuestoes":
      require_once ('paginaQuestoes.php');
      break;
    case "finalPage":
      require_once ('finalPage.php');
      break;
    default:
      require_once ($initialOption);
      break;
    }
?> 
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.9.12
    </div>
    <br>
  </footer>

  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="plugins/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="plugins/demo.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="plugins/chartjs/Chart.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.js"></script>
<!-- DataTables Export Button-->
<script type="text/javascript" src="js/jszip.min.js"></script>
<script type="text/javascript" src="js/pdfmake.min.js"></script>
<script type="text/javascript" src="js/vfs_fonts.js"></script>
<script type="text/javascript" src="js/buttons.html5.min.js"></script>
<script type="text/javascript" src="js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<!-- Input Mask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="plugins/jquery.maskMoney.js"></script>
<!-- DateTime Picker -->
<script src="plugins/datetimepicker-master/build/jquery.datetimepicker.full.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<!-- Password Generator -->
<script src="plugins/pGenerator.jquery.js"></script>
<!-- Editor -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Select2 -->
<script src="js/select2.full.min.js"></script>
<!-- InputMask -->
<script>

function registerEvents(selectors, maxWeight = 15) {
  selectors.on("change", function() {
    populateWeights(selectors, maxWeight);
  });
}

function populateWeights(selectors, maxWeight) {
  const remainingWeight = maxWeight - totalWeight(selectors);

  selectors.each(function(index, select) {
    const selectVal = $("option:selected", select).val().trim();
    const remainingOptions = $("option:selected", select).nextAll().size();

    const selectValNumber = parseInt(selectVal || 0);
    
    if(remainingOptions > remainingWeight) {
      removeLastNOptions($(select), remainingOptions - remainingWeight)
    } else {
      removeLastNOptions($(select), remainingOptions)
      addMOptionsFromN($(select), selectValNumber + 1, remainingWeight);
    }

    
  });
  if(remainingWeight === 0)
  {
    $("#btn_save_cont").prop('disabled', false);
  }
}

function totalWeight(selectors) {
  let total = 0;
  selectors.each(function(index, select) {
    const val = $("option:selected", select).val().trim();
    if(val)
      total += parseInt(val);
  });
  return total;
}

function addMOptionsFromN(select, n, m) {
  for(let i = 0; i < m; i++) {
    const option = $(`<option value="${i+n}">${i+n}</option>`);
    select.append(option);
  }
}

function removeLastNOptions(select, n) {
  //console.log("removing: ", `option:nth-last-child(-n+${n})`);
  $(`option:nth-last-child(-n+${n})`, select).remove();
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

$(document).ready(function() {
  $("#btn_save_cont").prop('disabled', true);
  registerEvents($(".peso"));

  $('#birth-date').mask('00/00/0000');
  $('#phone').mask('(00) 00000-0000');
  $(".textarea").wysihtml5();
  $('#passGen').pGenerator({
        'bind': 'click',
        'passwordElement': '#password',
        'passwordLength': 8,
        'uppercase': true,
        'lowercase': true,
        'numbers':   true,
        'specialChars': false
    });

$('#form_response').submit(function(){
  var dados = $( this ).serialize();
  $.ajax({
    type: "POST",
    url: "functions/updateStatus.php",
    data: dados,
    success: function( data )
    {
      window.location.href = 'index.php?' + data
    }
  });
  return false;
});
 // multiple choice questions
 $('.multiple').click(function(){
  if($('.multiple:checked').size() === 4) {
    $("#btn_save_cont").prop('disabled', false);
  }
  else if($('.multiple:checked').size() > 4){
    $("#btn_save_cont").prop('disabled', true);
    alert('É permitido apenas selecionar 4 alternativas!')
    $('.multiple:checked').prop("checked", false);
  }
  else {
    $("#btn_save_cont").prop('disabled', true);
  }
    
 });

 // single choice questions
 $('.single').click(function(){
    $("#btn_save_cont").prop('disabled', false);
 });
    

$('#delete_button').click(function() {
  $.ajax({
     url: 'functions/deleteQuestao.php',
     type: 'POST',
     data: {id : "<?php echo $_GET['id']; ?>"}
  })
  .done(function(){
    alert('Deletado com sucesso!');
    var redirect = "<?php echo 'index.php?' . base64_encode('cadQuest'); ?>"
    window.location.href = redirect
  })
  .fail(function(){
    alert('Falha ao deletar questao!');
    window.location.href = "<?php echo 'index.php?' . base64_encode('cadQuest'); ?>"
  })
});

$('#delete_button_altern').click(function() {
  $.ajax({
     url: 'functions/deleteAlternativa.php',
     type: 'POST',
     data: {id : "<?php echo $_GET['id']; ?>"}
  })
  .done(function(){
    alert('Deletado com sucesso!');
    var redirect = "<?php echo 'index.php?' . base64_encode('cadAltern'); ?>"
    window.location.href = redirect
  })
  .fail(function(){
    alert('Falha ao deletar alternativa!');
    window.location.href = "<?php echo 'index.php?' . base64_encode('cadAltern'); ?>"
  })
});

$('#delete_button_cat').click(function() {
  $.ajax({
     url: 'functions/deleteCategoria.php',
     type: 'POST',
     data: {id : "<?php echo $_GET['id']; ?>"}
  })
  .done(function(){
    alert('Deletado com sucesso!');
    var redirect = "<?php echo 'index.php?' . base64_encode('cadCategoria'); ?>"
    window.location.href = redirect
  })
  .fail(function(){
    alert('Falha ao deletar categoria!');
    window.location.href = "<?php echo 'index.php?' . base64_encode('cadCategoria'); ?>"
  })
});

$('#delete_button_bu').click(function() {
  $.ajax({
     url: 'functions/deleteBusinessUnit.php',
     type: 'POST',
     data: {id : "<?php echo $_GET['id']; ?>"}
  })
  .done(function(){
    alert('Deletado com sucesso!');
    var redirect = "<?php echo 'index.php?' . base64_encode('cadBusinessUnit'); ?>"
    window.location.href = redirect
  })
  .fail(function(){
    alert('Falha ao deletar business unit!');
    window.location.href = "<?php echo 'index.php?' . base64_encode('cadBusinessUnit'); ?>"
  })
});

$('#delete_buttonUser').click(function() {
  $.ajax({
     url: 'functions/deleteUsers.php',
     type: 'POST',
     data: {id : "<?php echo $_GET['id']; ?>"}
  })
  .done(function(){
    alert('Deletado com sucesso!');
    window.location.href = "<?php echo 'index.php?' . base64_encode('cadUsers'); ?>"
  })
  .fail(function(){
    alert('Falha ao deletar usuário!');
    window.location.href = "<?php echo 'index.php?' . base64_encode('cadUsers'); ?>"
  })
});


  var questoes = $('#tableQuestoes').DataTable( {
      "ajax": {
          url: 'functions/convertQueryConsultaQuestoes.php',
          dataSrc: ''
      },            

      "language": {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ Resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
              "sNext": "Próximo",
              "sPrevious": "Anterior",
              "sFirst": "Primeiro",
              "sLast": "Último"
          },
          "oAria": {
              "sSortAscending": ": Ordenar colunas de forma ascendente",
              "sSortDescending": ": Ordenar colunas de forma descendente"
          }
      },
        "columns": [
            { "data": "quest_id"},
            { "data": "question" },
            { "data": "type_desc" },
            { "data": "title" },
            { "data": null }
        ],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button class='btn-primary btn-flat'>Editar Questão</button>"
          },
          {
            'targets': -1, // column index (start from 0)
            'orderable': false
          },
          {
            "targets": [0],
            "visible": false
          }
        ],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "autoWidth": true,
        "responsive": true,
        "info": true
  });

  $('#tableQuestoes tbody').on( 'click', 'button', function () {
      var data = questoes.row( $(this).parents('tr') ).data();
      window.location.href = "index.php?<?php echo base64_encode('editQuestao'); ?>&id=" + data['quest_id'];
  });

  var listaUsers = $('#tableUsers').DataTable( {
  "ajax": {
      url: 'functions/convertQueryUsers.php',
      dataSrc: ''
  },
  "language": {
      "sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "_MENU_ Resultados por página",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum registro encontrado",
      "sSearch": "Pesquisar",
      "oPaginate": {
          "sNext": "Próximo",
          "sPrevious": "Anterior",
          "sFirst": "Primeiro",
          "sLast": "Último"
      },
      "oAria": {
          "sSortAscending": ": Ordenar colunas de forma ascendente",
          "sSortDescending": ": Ordenar colunas de forma descendente"
      }
  },
    "columns": [
        { "data": "id"},
        { "data": "name" },
        { "data": "email" },
        { "data": "blood_type" },
        { "data": "level" },
        { "data": "status_quest" },
        { "data": null },
        { "data": null },
        { "data": null }
    ],
    "columnDefs": [ {
        "targets": [6],
        "data": null,
        "defaultContent": "<button class='bnt_edit_user btn-primary btn-flat'>Editar Usuário</button>"
    },
    {
        "targets": [7],
        "data": null,
        "defaultContent": "<button class='btn_report btn-primary btn-flat'>Download Relatório</button>"
    },
    {
        "targets": -1,
        "data": null,
        "defaultContent": "<button class='btn_mail btn-success btn-flat'>Enviar E-mail</button>"
    },
    {
          "targets": [0],
          "visible": false
        }
    ],
  "paging": true,
  "lengthChange": true,
  "searching": true,
  "ordering": true,
  "autoWidth": true,
  "responsive": true,
  "info": true
} );
      $('#tableUsers tbody').on( 'click', 'button.bnt_edit_user', function () {
          var data = listaUsers.row( $(this).parents('tr') ).data();
          window.location.href = 'index.php?<?php echo base64_encode('editUsers');?>&id=' + data['id'];
      });
      $('#tableUsers tbody').on( 'click', 'button.btn_report', function () {
        var data = listaUsers.row( $(this).parents('tr') ).data();
        window.open('functions/generateReport.php?id=' + data['id'],'_blank');
      });
      $('#tableUsers tbody').on( 'click', 'button.btn_mail', function () {
        var data = listaUsers.row( $(this).parents('tr') ).data();
        $.ajax({
          url: 'functions/sendMail.php',
          type: 'POST',
          data: {email : data['email'], name : data['name']}
        })
        .done(function(data){
          alert(data);
        })
        .fail(function(){
          alert('Falha ao enviar e-mail!');
        })
      });


     var alternativas =  $('#tableAlternativas').DataTable( {
      "ajax": {
          url: 'functions/convertQueryConsultaAlternativas.php',
          dataSrc: ''
      },
      "language": {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ Resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
              "sNext": "Próximo",
              "sPrevious": "Anterior",
              "sFirst": "Primeiro",
              "sLast": "Último"
          },
          "oAria": {
              "sSortAscending": ": Ordenar colunas de forma ascendente",
              "sSortDescending": ": Ordenar colunas de forma descendente"
          }
      },
     
      "columns": [
            { "data": "id"},
            { "data": "quest_id" },
            { "data": "alternative_id" },
            { "data": "sub_class" },
            { "data": "response" },
            { "data": "type_desc"},
            { "data": null }
        ],
        "columnDefs": [ {
        "targets": -1,
        "data": null,
        "defaultContent": "<button class='btn-primary btn-flat'>Editar Alternativa</button>"
        },
        {
          "targets": [0],
          "visible": false
        }
        ],
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "autoWidth": true,
      "responsive": true,
      "info": true,
    } );
    $('#tableAlternativas tbody').on( 'click', 'button', function () {
      var data = alternativas.row( $(this).parents('tr') ).data();
      window.location.href = "index.php?<?php echo base64_encode('editAlternativa'); ?>&id=" + data['id'];
  });

  var categorias =  $('#tableCategorias').DataTable( {
      "ajax": {
          url: 'functions/convertQueryConsultaCategorias.php',
          dataSrc: ''
      },
      "language": {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ Resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
              "sNext": "Próximo",
              "sPrevious": "Anterior",
              "sFirst": "Primeiro",
              "sLast": "Último"
          },
          "oAria": {
              "sSortAscending": ": Ordenar colunas de forma ascendente",
              "sSortDescending": ": Ordenar colunas de forma descendente"
          }
      },
     
      "columns": [
            { "data": "id"},
            { "data": "class" },
            { "data": "sub_class" },
            { "data": null }
        ],
        "columnDefs": [ {
        "targets": -1,
        "data": null,
        "defaultContent": "<button class='btn-primary btn-flat'>Editar Categoria</button>"
        },
        {
          "targets": [0],
          "visible": false
        }
        ],
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "autoWidth": true,
      "responsive": true,
      "info": true,
    } );
    $('#tableCategorias tbody').on( 'click', 'button', function () {
      var data = categorias.row( $(this).parents('tr') ).data();
      window.location.href = "index.php?<?php echo base64_encode('editCategoria'); ?>&id=" + data['id'];
  });

  var businessUnit =  $('#tableBU').DataTable( {
      "ajax": {
          url: 'functions/convertQueryConsultaBusinessUnit.php',
          dataSrc: ''
      },
      "language": {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ Resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
              "sNext": "Próximo",
              "sPrevious": "Anterior",
              "sFirst": "Primeiro",
              "sLast": "Último"
          },
          "oAria": {
              "sSortAscending": ": Ordenar colunas de forma ascendente",
              "sSortDescending": ": Ordenar colunas de forma descendente"
          }
      },
     
      "columns": [
            { "data": "id"},
            { "data": "title" },
            { "data": null }
        ],
        "columnDefs": [ {
        "targets": -1,
        "data": null,
        "defaultContent": "<button class='btn-primary btn-flat'>Editar B.U</button>"
        },
        {
          "targets": [0],
          "visible": false
        }
        ],
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "autoWidth": true,
      "responsive": true,
      "info": true,
    } );
    $('#tableBU tbody').on( 'click', 'button', function () {
      var data = businessUnit.row( $(this).parents('tr') ).data();
      window.location.href = "index.php?<?php echo base64_encode('editBusinessUnit'); ?>&id=" + data['id'];
  });
} );
</script>
<script>

    $.datetimepicker.setLocale('pt-BR');

    $('#datetimepicker_format').datetimepicker({value:'', format: $("#datetimepicker_format_value").val()});

    $("#datetimepicker_format_change").on("click", function(e){
      $("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
    });
    $("#datetimepicker_format_locale").on("change", function(e){
      $.datetimepicker.setLocale('pt-BR');
    });

    $('#datetimepicker').datetimepicker({
      dayOfWeekStart : 1,
      lang: 'pt-BR',
      disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
      timepicker:true,
      format:'d/m/Y H:i',
      formatDate:'d/m/Y H:i'
    });
</script>
<!-- Webcam -->
<script type="text/javascript" src="plugins/highlight.min.js"></script>
<script type="text/javascript">
hljs.configure({tabReplace: '    '});
hljs.initHighlightingOnLoad();
</script>
</body>
</html>