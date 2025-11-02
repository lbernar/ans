@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')
<section class="content-header">
    <h1>Editar Usuário</h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-edit"></i> CADASTROS</li>
        <li class="active">Editar Usuário</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar: {{ $user->name }}</h3>
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

                    <form role="form" method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" required name="name" class="form-control" value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="email" required name="email" class="form-control" value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="form-group">
                            <label>Nova Senha (deixe em branco para não alterar):</label>
                            <input type="text" name="password" class="form-control" id="password">
                            <button type="button" class="btn-flat btn btn-success" id="passGen">Gerar Senha</button>
                        </div>

                        <div class="form-group">
                            <label>Telefone:</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                        </div>

                        <div class="form-group">
                            <label>Nível de Acesso:</label>
                            <select required name="level" class="form-control">
                                <option value="0" {{ old('level', $user->level) == '0' ? 'selected' : '' }}>Usuário</option>
                                <option value="1" {{ old('level', $user->level) == '1' ? 'selected' : '' }}>Administrador</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tipo Sanguíneo:</label>
                            <select name="blood_type" class="form-control">
                                <option value="">Selecione um tipo sanguíneo...</option>
                                <option value="A+" {{ old('blood_type', $user->blood_type) == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ old('blood_type', $user->blood_type) == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ old('blood_type', $user->blood_type) == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ old('blood_type', $user->blood_type) == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="AB+" {{ old('blood_type', $user->blood_type) == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('blood_type', $user->blood_type) == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="O+" {{ old('blood_type', $user->blood_type) == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ old('blood_type', $user->blood_type) == 'O-' ? 'selected' : '' }}>O-</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Status:</label>
                            <select required name="status" class="form-control">
                                <option value="1" {{ old('status', $user->status) == '1' ? 'selected' : '' }}>Ativo</option>
                                <option value="0" {{ old('status', $user->status) == '0' ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Atualizar</button>
                            <button type="button" class="btn btn-danger btn-block btn-flat" id="delete_buttonUser">Deletar Usuário</button>
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

    $('#delete_buttonUser').click(function() {
        if (confirm('Tem certeza que deseja deletar este usuário?')) {
            $.ajax({
                url: '{{ route('users.destroy', $user) }}',
                type: 'DELETE',
                success: function(response) {
                    alert('Deletado com sucesso!');
                    window.location.href = "{{ route('users.index') }}";
                },
                error: function() {
                    alert('Falha ao deletar usuário!');
                }
            });
        }
    });
});
</script>
@endpush

