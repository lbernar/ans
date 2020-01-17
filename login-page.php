<?php
#-----------------------------------------------------------------
#Error Dumps
error_reporting(E_ALL ^ E_NOTICE);
ini_set( "display_errors", 0);

#-----------------------------------------------------------------
#Authorization Check
$AD = $_GET['authorization_check'];

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Análise Neurossistêmica | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="styles/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="styles/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="styles/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="styles/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="styles/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
	<a href="#"><b>Análise Neurossistêmica</b>
  </div>
 
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Faça o login com seu email cadastrado para iniciar sua sessão</p>

    <form action="w3/valida.php" enctype="multipart/form-data" method="post">
         <div class="form-group has-feedback">
        <input required name="email" type="text" class="form-control" placeholder="joao@gmail.com">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="pass" name="pass" type="password" class="form-control" placeholder="Senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Logar</button>
        </div>
        <!-- /.col -->
        
      </div>
    </form>
    </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="plugins/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/icheck.min.js"></script>
  <?php 
  $msg = array_keys($_GET);
  $msg = base64_decode($msg[0]);
  if(!empty($msg)){?>
      <script>
      $(function() {
          alert("<?php echo $msg; ?>");
      });
  </script>
  <?php }?> 
</body>
</html>
