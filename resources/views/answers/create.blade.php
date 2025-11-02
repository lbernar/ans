@extends('layouts.app')

@section('title', 'Cadastro de Respostas')

@section('content')
<section class="content-header">
    <h1>Cadastro de Respostas</h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-edit"></i> CADASTROS</li>
        <li class="active">Respostas</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Nova Resposta</h3>
                </div>
                
                <div class="box-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ route('answers.store') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label>ID da Resposta:</label>
                            <input type="text" required name="resp_id" class="form-control" placeholder="R001" value="{{ old('resp_id') }}">
                        </div>

                        <div class="form-group">
                            <label>ID da Questão:</label>
                            <input type="text" required name="quest_id" class="form-control" placeholder="Q001" value="{{ old('quest_id') }}">
                        </div>

                        <div class="form-group">
                            <label>Resposta:</label>
                            <input type="text" required name="response" class="form-control" placeholder="Digite a resposta..." value="{{ old('response') }}">
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

