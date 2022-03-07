$(document).ready(function () {
    window.addEventListener('load', function(){
        fetchRoles()
        fetchModulos()
    },false);

    let dataTable=$('#tablaPer').DataTable({
        language: {
            "url": "assets/libs/spanish_datatables.json"
        },
        "serverSide": true,
        "processing": true,
        "order": [[ 0, "desc" ]], //ORDER BY id DESC -> default
        "ajax": {
            url: "PermisosController/fetch_all",
            type: "POST"
        },
        "searching": false,
        // custom cantidad filas (yo lo puse)
        "lengthMenu": [
            [5, 10, 50, -1],
            [5, 10, 50, "All"]
        ],
        //Botones para exportar
        dom: "B<'row'<'col-sm-12 col-md-6 mt-2'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: buttonsArray
    });

    $('#btnNuevo').click(function () {
        $('#form').trigger('reset');
        $('.modal-title').text('Agregar Permisos');
        $('.modal-header').css('background-color', '#343a40');
        $('.modal-header').css('color', '#fff');

        reset_campos_errors()

        $('#action').val('Add');
        $('#btnGuardar').val('Add');
        $('#modal').modal('show');
    });

    function reset_campos_errors() {
        // validacion errors
        $('#rol_error').text('');
        $("#c").removeAttr('checked');
        $("#r").removeAttr('checked');
        $("#u").removeAttr('checked');
        $("#d").removeAttr('checked');
        
    }

    // INSERT
    $('#form').submit(function (e) {
        e.preventDefault();
        // capturar valores forma incial con JS
        let action=$('#action').val()
        let hidden_id=$('#hidden_id').val()

        let rol=$('#rol').val()
        let modulo=$('#modulo').val()
        
        let r=0, c=0,u=0,d=0

        if($('#r').is(':checked')){
            r=1
        }
        if($('#c').is(':checked')){
            c=1
        }
        if($('#u').is(':checked')){
            u=1
        }
        if($('#d').is(':checked')){
            d=1
        }

        $.ajax({
            type:"POST",
            url: "PermisosController/action",
            data:{
                rol:rol,
                modulo:modulo,
                c:c,
                r:r,
                u:u,
                d:d,
                action:action,
                hidden_id:hidden_id
            },
            dataType: "JSON",
            success: function (data) {
                if (data.success == 'yes') {
                    $('#modal').modal('hide');
                    dataTable.ajax.reload();
                    Alert.success(data.message)
                } else {
                    $('#rol_error').text(data.rol_error);
                }
            }
        })
    });

    // UPDATE
    $(document).on('click', '.edit', function () {
        var id = $(this).data('id');
        reset_campos_errors();
        $.ajax({
            url: "PermisosController/fetch_single_data",
            method: "POST",
            data: {
                id: id
            },
            dataType: 'JSON',
            success: function (data) {
                $('#rol').val(data.idRol);
                $('#modulo').val(data.idModulo);

                let c=data.c
                let r=data.r
                let u=data.u
                let d=data.d

                if(r==1){ //activo checkbox
                    $('#r').attr('checked','');
                }
                if(c==1){ //activo checkbox
                    $('#c').attr('checked','');
                }
                if(u==1){ //activo checkbox
                    $('#u').attr('checked','');
                }
                if(d==1){ //activo checkbox
                    $('#d').attr('checked','');
                }

                $('.modal-title').text('Editar Permisos');
                $('.modal-header').css('background-color', '#3164ff');
                $('.modal-header').css('color', '#fff');

                $('#action').val('Edit');
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
                    url: "PermisosController/delete",
                    method: "POST",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        if (data == 1) {
                            dataTable.ajax.reload();
                            Alert.success('Se eliminó correctamente!')
                        }else{
                            Alert.error()
                        }
                    }
                })
            }
        })
    });

    function fetchRoles(){
        $.ajax({
            type: "POST",
            url: "UsuarioController/fetchRoles2",
            dataType: "JSON",
            success: function (response) {
                console.log(response)
                let template='<option value="">-- Seleccione --</option>'
                response.forEach(rol=>{
                    template+=`<option value="${rol.id}">${rol.nombre}</option>`
                })
                $('#rol').html(template);
            }
        });
    }
    

    function fetchModulos(){
        $.ajax({
            type: "POST",
            url: "UsuarioController/fetchModulos",
            dataType: "JSON",
            success: function (response) {
                let template=''
                response.forEach(modulo=>{
                    template+=`<option value="${modulo.id}">${modulo.titulo}</option>`
                })
                $('#modulo').html(template);
            }
        });
    }
    

});