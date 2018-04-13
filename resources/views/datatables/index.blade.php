@extends('layouts.master')

@section('content')
    <table class="table table-bordered table-striped" id="users-table">
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
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="non_searchable"></td>
            </tr>
        </tfoot>
    </table>
    <div id="alert" class="alert alert-info"></div>
@stop

@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({

        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        //Traduccion a español de la interfaz de la tabla
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        ajax: '{!! route('usuarios') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function () {

            $('#alert').hide();
            this.api().columns().every(function () {
                var column = this;
                var columnClass = column.footer().className;
                if(columnClass != 'non_searchable'){
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                }
            });


            // $(".btn-delete").click(function(e){

            //     e.preventDefault();
            //     if( ! confirm("¿esta seguro de eliminar al usuario?")){
            //         return false;
            //     }

            //     $('#alert').show();

            //     var row = $(this).parents('tr');
            //     var url = $(this).attr('href');
            //     var id = $(this).attr('id');

            //     $.post(url,id, function(result){
            //         row.fadeOut();
            //         $('#alert').html('usuario eliminado correctamente');
            //     }).fail(function(){
            //         $('#alert').html('Algo salio mal');
            //     })
            // })
                        ///////////////////////////

            $(".btn-delete").click(function(e){
                e.preventDefault();
                                      
                var idRow = this.id;
                $('#alert').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"POST",
                    data:{'idRow':1},
                    dataType:"JSON",
                    url:"{!! route('borrarUser' ) !!}",

                        success:function(data){
                            var row = $(this).parents('tr');
                            row.fadeOut(); 
                            $('#alert').html(data.message);
                        }
                    })
                })

                        /////////////////////////

            // $('.btn-delete').click(function(e){
            //     e.preventDefault();
                
                
            //     if(! confirm("¿Esta seguro de eleminar el usuario?")){
            //         return false;
            //     }
            //     var url = $(this).attr('href');
            //     var row = $(this).parents('tr');
            //     var idRow = $(this).attr('id');
            //     console.log(idRow);
            //     console.log(url);
            //     $('#alert').show();

            //     $.post(url, $(this).serialize(), function(result){
            //         row.fadeOut();
            //         $('#alert').html(result.message);
            //     }).fail(function(){
            //         $('#alert').html('Algo salio mal');
            //     });
            // });
        }
    });
});

</script>
@endpush