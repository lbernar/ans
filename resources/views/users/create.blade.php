@extends('layouts.app')

@section('title', 'Cadastro de Usuários')

@section('content')
<section class="content-header">
    <h1>Cadastro de Usuários</h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-edit"></i> CADASTROS</li>
        <li class="active">Usuários</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Novo Usuário</h3>
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

                    <form role="form" method="POST" action="{{ route('users.store') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" required name="name" class="form-control" placeholder="João da Silva" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="email" required name="email" class="form-control" placeholder="jsilva@gmail.com" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label>Senha:</label>
                            <input type="text" required name="password" class="form-control" id="password">
                            <button type="button" class="btn-flat btn btn-success" id="passGen">Gerar Senha</button>
                        </div>

                        <div class="form-group">
                            <label>Telefone:</label>
                            <input type="text" name="phone" class="form-control" placeholder="(11) 98765-4321" value="{{ old('phone') }}">
                        </div>

                        <div class="form-group">
                            <label>Nível de Acesso:</label>
                            <select required name="level" class="form-control">
                                <option value="">Selecione um nível...</option>
                                <option value="0" {{ old('level') == '0' ? 'selected' : '' }}>Usuário</option>
                                <option value="1" {{ old('level') == '1' ? 'selected' : '' }}>Administrador</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tipo Sanguíneo:</label>
                            <select name="blood_type" class="form-control">
                                <option value="">Selecione um tipo sanguíneo...</option>
                                <option value="A+" {{ old('blood_type') == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ old('blood_type') == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ old('blood_type') == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ old('blood_type') == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="AB+" {{ old('blood_type') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('blood_type') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="O+" {{ old('blood_type') == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ old('blood_type') == 'O-' ? 'selected' : '' }}>O-</option>
                            </select>
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

@push('scripts')
<script src="{{ asset('adminlte/plugins/pGenerator.jquery.js') }}"></script>
<script>
$(document).ready(function() {
    $('#passGen').pGenerator({
        'bind': 'click',
        'passwordElement': '#password',
        'passwordLength': 8,
        'uppercase': true,
        'lowercase': true,
        'numbers': true,
        'specialChars': false
    });
});
</script>
@endpush

