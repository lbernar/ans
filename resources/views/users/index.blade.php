@extends('layouts.app')

@section('title', 'Consulta Usuários')

@push('styles')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
@endpush

@section('content')
<section class="content-header">
    <h1>Consulta Usuários</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <table id="tableUsers" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome do Usuário</th>
                                <th>E-mail</th>
                                <th>Nível de Acesso</th>
                                <th>Status de Resposta</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script>
$(document).ready(function() {
    var listaUsers = $('#tableUsers').DataTable({
        ajax: {
            url: '{{ route('users.data') }}',
            dataSrc: ''
        },
        language: {
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
            }
        },
        columns: [
            { data: "id" },
            { data: "nome" },
            { data: "user_id" },
            { data: "level" },
            { data: "ativo" },
            { data: null }
        ],
        columnDefs: [{
            targets: -1,
            data: null,
            defaultContent: "<button class='btn btn-primary btn-sm'>Editar Usuário</button>"
        }],
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: false,
        autoWidth: true,
        responsive: true,
        info: true
    });

    $('#tableUsers tbody').on('click', 'button', function() {
        var data = listaUsers.row($(this).parents('tr')).data();
        window.location.href = '{{ url('users') }}/' + data['id'] + '/edit';
    });
});
</script>
@endpush

