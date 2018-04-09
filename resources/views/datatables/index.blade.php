@extends('layouts.master')

@section('content')
    <table class="table table-bordered" id="users-table">
        <thead >
            <tr class="table-primary alineado_centro">
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Creado</th>
                <th>Modificado</th>
                <th>Acciones</th>

            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        ajax: '{!! route('usuarios') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endpush