$(document).ready(function () {
    let dataTables = $('#tablaBandejaSoliPendientes').DataTable({
        "aServerSide": true,
        "aProcessing": true,
        "responsive": true,
        "language": {
            "url": "assets/libs/spanish_datatables.json",
            searchPlaceholder: "Cualquier columna..."
        },
        "ajax": {
            "url": "FedateoController/fetch_all",
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
                "data": "num_doc"
            },
            {
                "data": "created_at"
            },
            {
                "data": "estado_fedateo"
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
        $('#modalMesapartes').modal('show')
        $('#hidden_id').val(id);
        
    });

    $('.row-observacion').hide()
    $('#estado_mesa').change(function (e) { 
        e.preventDefault();
        let estado_mesa=$(this).val();
        if(estado_mesa==0){
            $('.row-observacion').show()
        }else{
            $('.row-observacion').hide()
        }
    });

    $('#formMesapartes').submit(function (e) { 
        e.preventDefault();

        $.ajax({
            url: "MesaController/updateMesa",
            method: "POST",
            data: $(this).serialize(),
            //dataType: "JSON",
            success: function (data) {
                if (data=='ok') {
                    $('#modalMesapartes').modal('hide');
                    dataTables.ajax.reload();
                    Alert.success3('Guardado correctamente!')
                } else {
                    Alert.success('Error al guardar')
                }
            }
        })
        
    });
    
});