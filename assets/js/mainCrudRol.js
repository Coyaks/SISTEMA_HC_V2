$(document).ready(function () {
    // window.addEventListener('load', function(){
    //     fntPermisos()
    // },false);

    $('#tabla').DataTable({
        language: {
            "url": "assets/libs/spanish_datatables.json"
        },
        "order": [],
        "serverSide": true,
        "processing": true,
        "ajax": {
            url: "RolController/fetch_all",
            type: "POST"
        },
        // custom cantidad filas (yo lo puse)
        "lengthMenu": [
            [5, 10, 50, -1],
            [5, 10, 50, "All"]
        ],
        //Botones para exportar
        dom: "B<'row'<'col-sm-12 col-md-6 mt-2'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [{
                "extend": 'copyHtml5',
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-secondary mr-2",
            },
            {
                "extend": 'excelHtml5',
                "text": "<span class='text-white'><i class='fas fa-file-excel'></i> Excel</span>",
                "titleAttr": "Exportar a Excel",
                "className": "btn btn-success-b5 mr-2",
            },
            {
                "extend": 'pdfHtml5',
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "className": "btn btn-danger mr-2",
            },
            {
                "extend": 'csvHtml5',
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr": "Exportar a CSV",
                "className": "btn btn-info mr-2",
            },
            {
                "extend": 'print',
                "text": "<i class='fas fa-print'></i> Imprimir",
                "titleAttr": "Imprimir archivo",
                "className": "btn btn-secondary",
            }
        ]
    });

    $('#btnNuevo').click(function () {
        $('#form').trigger('reset');
        $('.modal-title').text('Agregar Rol');
        $('.modal-header').css('background-color', '#343a40');
        $('.modal-header').css('color', '#fff');

        reset_campos_errors()

        $('#action').val('Add');
        $('#btnGuardar').val('Add');
        $('#modal').modal('show');
    });

    function reset_campos_errors() {
        // validacion errors
        $('#nombre_error').text('');
        $('#descripcion_error').text('');
        $('#estado_error').text('');
    }

    // INSERT
    $('#form').submit(function (e) {
        e.preventDefault();
        // forma elegante de capturar valores de input: $('#formRol').serialize();
        $.ajax({
            url: "RolController/action",
            method: "POST",
            data: $(this).serialize(),
            dataType: "JSON",

            success: function (data) {
                if (data.error == 'yes') {
                    $('#nombre_error').text(data.nombre_error);
                    $('#descripcion_error').text(data.apellidos_error);
                    $('#estado_error').text(data.email_error);
                } else {
                    $('#modal').modal('hide');
                    $('#tabla').DataTable().ajax.reload();

                    // Toast custom
                    Alert.success(data.message)
                }
            }
        })
    });

    // UPDATE
    $(document).on('click', '.edit', function () {
        var id = $(this).data('id');
        $.ajax({
            url: "RolController/fetch_single_data",
            method: "POST",
            data: {
                id: id
            },
            dataType: 'JSON',
            success: function (data) {
                // 'data.idRol'-> atributo como viene de la DB
                $('#nombre').val(data.nombre);
                $('#descripcion').val(data.descripcion);
                $('#estado').val(data.estado);

                $('.modal-title').text('Editar Rol');
                $('.modal-header').css('background-color', '#3164ff');
                $('.modal-header').css('color', '#fff');

                reset_campos_errors();
                $('#action').val('Edit');
                $('#btnGuardar').val('Edit');
                // abrir modal con datos cargados para editar
                $('#modal').modal('show');
                $('#hidden_id').val(id);
            }
        })
    });

    //DELETE
    $(document).on('click', '.delete', function () {
        var id = $(this).data('id');
        Swal.fire({
            //title: 'Are you sure?',
            text: "¿Está seguro de eliminar?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "RolController/delete",
                    method: "POST",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        if (data == 1) {
                            $('#tabla').DataTable().ajax.reload();
                            Alert.success('Se eliminó correctamente!')
                        }
                    }
                })
            }
        })
    });
    //BTN OPEN MODAL -> FETCH MODULOS
    // $(document).on('click', '.btnPermisosRol', function (e){
    //     e.preventDefault();
    //     console.log("Click modal permisos")
    //     $('.modalPermisos').modal('show')
    // });

});