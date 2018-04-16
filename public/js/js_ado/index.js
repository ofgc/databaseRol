$(document).ready(function(){
    $('#users-table').DataTable({

        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
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
        ajax: '/datatablesdata',
        columns: [
            { data: 'id', name: 'id', },
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
                    // var input = document.createElement("input");
                    $('<input size="10%">').appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                }
            });
        }
    });
    $('#users-table').on( 'draw.dt', function () {

        ////////////---------DELETE--------------///////////////
        
        $(".btn-delete").click(function(e){
            e.preventDefault();
                                  
            var idUser = $(this).attr('id-delete');
            var row = $(this).parents('tr');
            $('#alert').show();
            console.log(idUser);
            console.log(row);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                data:{'idUser':idUser},
                dataType:"JSON",
                url:'/eliminar-usuario',

                success:function(data){
                    row.fadeOut(); 
                    $('#alert').html(data.message);
                }
            })
        })
    });
})
