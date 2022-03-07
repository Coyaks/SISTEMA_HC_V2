$(document).ready(function () {

    $('#tablaUsuario').DataTable({
        language: {
            "url": "assets/libs/spanish_datatables.json"
        },
        "order": [],
        "serverSide": true,
        "processing": true,
        "ajax": {
            url: "UsuarioController/fetch_all",
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

    $('#btnNuevoUsuario').click(function () {
        $('#formUsuario').trigger('reset');
        $('.modal-title').text('Agregar Usuario');
        $('.modal-header').css('background-color', '#343a40');
        $('.modal-header').css('color', '#fff');

        reset_campos_errors()

        $('#action').val('Add');
        $('#btnGuardar').val('Add');
        $('#modalUsuario').modal('show');
    });

    function reset_campos_errors() {
        $('#nombre_error').text('');
        $('#apellidos_error').text('');
        $('#email_error').text('');
        $('#password_error').text('');
        $('#rol_error').text('');
    }

    // PETICION MEDIANTE AJAX 
    function fetchRoles(){
        $.ajax({
            type: "POST",
            url: "UsuarioController/fetchRoles2",
            // data: {},
            dataType: "JSON",
            success: function (response) {
                console.log("JSON RTA:",response)
            }
        });
    }
    function fetchAreas(){
        $.ajax({
            type: "POST",
            url: "UsuarioController/fetchAreas",
            // data: {},
            dataType: "JSON",
            success: function (response) {
                //console.log("JSON RTA AREAS:",response)
                let template=''
                response.forEach(area=>{
                    template+=`<option value="${area.id}">${area.nombre}</option>
                    `
                })
                $('#area').html(template);
            }
        });
    }

    fetchAreas()

    // INSERT
    $('#formUsuario').submit(function (e) {
        e.preventDefault();
        // forma elegante de capturar valores de input: $('#formUsuario').serialize();
        $.ajax({
            url: "UsuarioController/action",
            method: "POST",
            data: $(this).serialize(),
            dataType: "JSON",

            // beforeSend: function () {
            // },
            success: function (data) {
                if (data.error == 'yes') {
                    $('#nombre_error').text(data.nombre_error);
                    $('#apellidos_error').text(data.apellidos_error);
                    $('#email_error').text(data.email_error);
                    $('#password_error').text(data.password_error);
                    $('#rol_error').text(data.rol_error);
                } else {
                    $('#modalUsuario').modal('hide');
                    $('#tablaUsuario').DataTable().ajax.reload();

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
            url: "UsuarioController/fetch_single_data",
            method: "POST",
            data: {
                id: id
            },
            dataType: 'JSON',
            success: function (data) {
                // 'data.idRol'-> atributo como viene de la DB
                $('#nombre').val(data.nombre);
                $('#apellidos').val(data.apellidos);
                $('#email').val(data.email);
                $('#password').val(data.password);
                //set value en "select"
                $('#rol').val(data.idRol);
                $('#estado').val(data.estado);

                $('.modal-title').text('Editar Usuario');
                $('.modal-header').css('background-color', '#3164ff');
                $('.modal-header').css('color', '#fff');

                reset_campos_errors();
                $('#action').val('Edit');
                $('#btnGuardar').val('Edit');
                // abrir modal con datos cargados para editar
                $('#modalUsuario').modal('show');
                // Es importante 'hidden_id' para hacer el update a la fila seleccionada
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
                    url: "UsuarioController/delete",
                    method: "POST",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        if (data == 1) {
                            $('#tablaUsuario').DataTable().ajax.reload();
                            Alert.success('Se eliminó correctamente!')
                        }
                    }
                })
            }
        })
    });
});