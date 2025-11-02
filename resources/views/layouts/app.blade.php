<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Análise Neurossistêmica')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('adminlte/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
    
    @stack('styles')
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
    <div class="wrapper">
        <!-- Header -->
        <header class="main-header">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="logo">
                <span class="logo-mini"><b>ANS</b></span>
                <span class="logo-lg"><b>Análise Neurossistêmica</b></span>
            </a>
            
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-link" style="color: #fff; text-decoration: none;">
                                    Sair do Sistema
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Sidebar -->
        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li class="header">MENU PRINCIPAL</li>
                    
                    @if(auth()->user()->isAdmin())
                        <li class="{{ request()->is('questions*') ? 'active' : '' }}">
                            <a href="{{ route('questions.create') }}">
                                <i class="fa fa-question-circle"></i> <span>CADASTRO DE QUESTÕES</span>
                            </a>
                        </li>
                        
                        <li class="{{ request()->is('answers*') ? 'active' : '' }}">
                            <a href="{{ route('answers.create') }}">
                                <i class="fa fa-pencil-square-o"></i> <span>CADASTRO DE RESPOSTAS</span>
                            </a>
                        </li>
                        
                        <li class="{{ request()->is('users/create') ? 'active' : '' }}">
                            <a href="{{ route('users.create') }}">
                                <i class="fa fa-user-plus"></i> <span>CADASTRO DE USUÁRIOS</span>
                            </a>
                        </li>
                        
                        <li class="{{ request()->is('users') && !request()->is('users/create') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}">
                                <i class="fa fa-search"></i> <span>CONSULTA USUÁRIOS</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </section>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible" style="margin: 15px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible" style="margin: 15px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.0.0
            </div>
            <strong>Análise Neurossistêmica</strong>
        </footer>
    </div>

    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('adminlte/plugins/fastclick/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/app.js') }}"></script>
    
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>

