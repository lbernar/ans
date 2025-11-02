@extends('layouts.app')

@section('title', 'Cadastro de Questões')

@section('content')
<section class="content-header">
    <h1>Cadastro de Questões</h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-edit"></i> CADASTROS</li>
        <li class="active">Questões</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Nova Questão</h3>
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

                    <form role="form" method="POST" action="{{ route('questions.store') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label>ID da Questão:</label>
                            <input type="text" required name="quest_id" class="form-control" placeholder="Q001" value="{{ old('quest_id') }}">
                        </div>

                        <div class="form-group">
                            <label>Questão:</label>
                            <textarea required name="question" class="form-control" rows="5" placeholder="Digite a questão aqui...">{{ old('question') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Tipo:</label>
                            <input type="text" name="type" class="form-control" maxlength="1" placeholder="A" value="{{ old('type') }}">
                        </div>

                        <div class="form-group">
                            <label>BU:</label>
                            <input type="text" name="bu" class="form-control" placeholder="BU001" value="{{ old('bu') }}">
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

