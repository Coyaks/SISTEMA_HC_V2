$(document).ready(function () {
    let dataTables = $('#tablaMedico').DataTable({
        "aServerSide": true,
        "aProcessing": true,
        "responsive": true,
        "language": {
            "url": "assets/libs/spanish_datatables.json",
            searchPlaceholder: "Cualquier columna..."
        },
        "ajax": {
            "url": "MedicoController/fetch_all",
            "dataSrc": "" //Obligatorio
        },
        //"searching": false,
        "columns": [{
                "data": "id"
            },
            {
                "data": "nombre"
            },
            {
                "data": "apellidos"
            },
            {
                "data": "edad"
            },
            {
                "data": "num"
            },
            {
                "data": "anotacion_enfermera"
            },
            {
                "data": "anotacion_medico"
            },
            {
                "data": "created_at"
            },
            {
                "data": "etapa"
            },
            {
                "data": "options"
            }
        ],
        // custom cantidad filas (yo lo puse)
        "lengthMenu": [
            [5, 10, 50, -1],
            [5, 10, 50, "Todos"]
        ],
        //Botones para exportar
        dom: "B<'row'<'col-sm-12 col-md-6 mt-2'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: buttonsArray,

        "order": [
            [0, "desc"]
        ], //ORDER BY id DESC -> default
    });

    // UPDATE
    $(document).on('click', '.edit', function () {
        var id = $(this).data('id');
        $('#modalMedico').modal('show')
        $('#hidden_id').val(id);
        
    });


    $('#formMedico').submit(function (e) { 
        e.preventDefault();
        let anotaciones=$('#anotaciones').val();
        let hidden_id=$('#hidden_id').val();
        console.log('aaa: ',$('#etapa2').is(':checked'))
        
        let etapa2=0;

        if($('#etapa2').is(':checked')){
            etapa2=1
        }
        $.ajax({
            url: "MedicoController/saveAnotaciones",
            method: "POST",
            data: {
                anotaciones:anotaciones,
                etapa2:etapa2,
                hidden_id:hidden_id
            },
            dataType: "JSON",
            success: function (data) {
                if (data.rta=='ok') {
                    dataTables.ajax.reload()
                    $('#modalMedico').modal('hide');
                    //dataTables.ajax.reload();
                    Alert.success3('Guardado correctamente!')
                } else {
                    Alert.success('Error al guardar')
                }
            }
        })
        
    });
    
});