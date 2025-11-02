@extends('layouts.app')

@section('title', 'Dashboard - Análise Neurossistêmica')

@section('content')
<section class="invoice">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> Bem Vindo ao Sistema de Análise Neurossistêmica!
            </h2>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Informações do Usuário</h3>
                </div>
                <div class="box-body">
                    <p><strong>Nome:</strong> {{ auth()->user()->name }}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p><strong>Nível:</strong> {{ auth()->user()->isAdmin() ? 'Administrador' : 'Usuário' }}</p>
                    @if(auth()->user()->blood_type)
                        <p><strong>Tipo Sanguíneo:</strong> {{ auth()->user()->blood_type }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

