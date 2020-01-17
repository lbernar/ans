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
//if (!isset($_SESSION['user_id'])) { Header("Location: login-page.php"); exit; }
#------------------------------------------------------------------
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>QuestionaME</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!--FavIcon Tetris-->
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
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
      <span class="logo-lg"><b>Análise Neurossistêmica</b></span>
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
        <li class="header">MENU PRINCIPAL</li>        
          <!-- Aqui começa outro Simples-->  
          <?php 
          if($_SESSION['level'] == 0) {
            echo "  
          <li class='treeview'>
            <a href=index.php?" . base64_encode('cadQuest') . ">
              <i class='fa fa-question-circle'></i> <span>CADASTRO DE QUESTÕES</span>
            </a>
          </li>  
          <!-- Aqui começa outro Simples-->    
          <li class='treeview'>
            <a href=index.php?" . base64_encode('cadResp') . ">
              <i class='fa fa-pencil-square-o'></i> <span>CADASTRO DE RESPOSTAS</span>
            </a>
          </li>  
          <!-- Aqui termina Simples-->
          <!-- Aqui começa outro Simples-->    
        
            <li class='treeview'>
            <a href=index.php?" . base64_encode('cadUsers') . ">
              <i class='fa fa-user-plus'></i> <span>CADASTRO DE USUÁRIOS</span>
            </a>
          </li>  
    
          <li class='treeview'>
            <a href=index.php?" . base64_encode('consultaUsers') . ">
              <i class='fa fa-search'></i> <span>CONSULTA USUÁRIOS</span>
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
$option= base64_decode(key($_GET));
switch ($option) {
    case "cadQuest":
        require_once ('formCadQuestoes.php');
        break;
    case "cadResp":
      require_once ('formCadRespostas.php');
      break;
    case "cadUsers":
      require_once ('formCadUsers.php');
      break;
    case "consultaUsers":
      require_once ('consultaUsers.php');
      break;
    case "editUsers":
      require_once ('formEditUsers.php');
      break;
    case "editUsers":
      require_once ('welcome.php');
      break;
    default:
      require_once('welcome.php');
      break;
    }
?> 
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
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
$(document).ready(function() {
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

$('#delete_button').click(function() {
  $.ajax({
     url: 'functions/deleteSinal.php',
     type: 'POST',
     data: {id : "<?php echo $_GET['id']; ?>"}
  })
  .done(function(){
    alert('Deletado com sucesso!');
    var redirect = "<?php echo 'index.php?' . base64_encode('consultaSinais'); ?>"
    window.location.href = redirect
  })
  .fail(function(){
    alert('Falha ao deletar sinal!');
    window.location.href = "<?php echo 'index.php?' . base64_encode('consultaSinais'); ?>"
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
    window.location.href = "<?php echo 'index.php?' . base64_encode('consultaUsers'); ?>"
  })
  .fail(function(){
    alert('Falha ao deletar usuário!');
    window.location.href = "<?php echo 'index.php?' . base64_encode('consultaUsers'); ?>"
  })
});


  var controleSinais = $('#tableControleSinais').DataTable( {
      "ajax": {
          url: 'functions/convertQueryConsultaSinais.php',
          dataSrc: ''
      },
      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            // Total over all pages
            total = api
                .column(8)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Total over this page
            pageTotal = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
              if(total != 0)
               var total = '$ '+ total.toFixed(2)
              else {
                total = 0
               var total = '$ '+ total.toFixed(2)
              }
            // Update footer
            $( api.column(7).footer() ).html(
                total
            );
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
            { "data": "nome" },
            { "data": "data_sinal" },
            { "data": "direcao" },
            { "data": "valor" },
            { "data": "expiracao" },
            { "data": "gale" },
            { "data": "result" },
            { "data": "lucro_preju" },
            { "data": null },
            { "data": "action" }
        ],
        "columnDefs": [ {
            "targets": [9],
            "data": null,
            "defaultContent": "<button class='btn-primary btn-flat'>Editar Sinal</button>"
          },
          {
              "targets": [0],
              "visible": false,
              "searchable": false
          },
          {
            'targets': -1, // column index (start from 0)
            'orderable': false
          }
        ],
        
        "createdRow": function( row, data, dataIndex){
          if( data['result'] == 'Ganhou'){
              $(row).addClass('success');
          }
          else if(data['result'] == 'Perdeu')
            $(row).addClass('danger');
        },
        "paging": false,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "autoWidth": true,
        "responsive": true,
        "info": true,
        "stateSave": true,
        "dom": 'Bflrtip',
          "buttons": [
            {
              extend: 'excelHtml5',
              exportOptions: {
                  columns: [ 1,2,3,4,5,6,7 ]
              }
            },
            {
              extend: 'pdfHtml5',
              exportOptions: {
                  columns: [ 1,2,3,4,5,6,7 ]
              }
            }
          ]
  });
    // Check all 
    $('#checkall').click(function(){
        if($(this).is(':checked')){
            $('.delete_check').prop('checked', true);
        }else{
            $('.delete_check').prop('checked', false);
        }
    });

    // Delete record
    $('#delete_record').click(function(){
        var deleteids_arr = [];
        // Read all checked checkboxes
        $("input:checkbox[class=delete_check]:checked").each(function () {
            deleteids_arr.push($(this).val());
        });
        
        // Check checkbox checked or not
        if(deleteids_arr.length > 0){

            // Confirm alert
            var confirmdelete = confirm("Você realmente deseja deletar os sinais selecionados?");
            if (confirmdelete == true) {
                $.ajax({
                    url: 'functions/deleteSinal.php',
                    type: 'post',
                    data: {request: 2,deleteids_arr: deleteids_arr},
                    success: function(response){
                      controleSinais.ajax.reload();
                    }
                });
            } 
        }
    });
  $('#tableControleSinais tbody').on( 'click', 'button', function () {
      var data = controleSinais.row( $(this).parents('tr') ).data();
      window.location.href = "index.php?<?php echo base64_encode('editSinais'); ?>&id=" + data['id'];
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
        { "data": "nome" },
        { "data": "user_id" },
        { "data": "level" },
        { "data": "ativo" },
        { "data": null }
    ],
    "columnDefs": [ {
        "targets": -1,
        "data": null,
        "defaultContent": "<button>Editar Usuário</button>"
        
    }
    ],
    
  "paging": true,
  "lengthChange": true,
  "searching": true,
  "ordering": false,
  "autoWidth": true,
  "responsive": true,
  "info": true
} );
    $('#tableUsers tbody').on( 'click', 'button', function () {
          var data = listaUsers.row( $(this).parents('tr') ).data();
          window.location.href = 'index.php?<?php echo base64_encode('editUsers');?>&id=' + data['id'];
      });


      $('#tableControleSinais tbody').on( 'click', 'button', function () {
          var data = controleSinais.row( $(this).parents('tr') ).data();
          window.location.href = "index.php?<?php echo base64_encode('editSinais'); ?>&id=" + data['id'];
      });

      $('#tableSinaisHist').DataTable( {
      "ajax": {
          url: 'functions/convertQueryConsultaSinaisHist.php',
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
      "createdRow": function( row, data, dataIndex){
          if( data['result'] == 'Ganhou'){
              $(row).addClass('success');
          }
          else if(data['result'] == 'Perdeu')
            $(row).addClass('danger');
        },
      "columns": [
            { "data": "id"},
            { "data": "nome" },
            { "data": "data_sinal" },
            { "data": "direcao" },
            { "data": "valor" },
            { "data": "gale" },
            { "data": "result" },
            { "data": "lucro_preju" }
        ],
        "dom": 'Bflrtip',
        "buttons": [
          {
            extend: 'excelHtml5',
            exportOptions: {
                columns: [ 1,2,3,4,5,6,7 ]
            }
          },
          {
            extend: 'pdfHtml5',
            exportOptions: {
                columns: [ 1,2,3,4,5,6,7 ]
            }
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