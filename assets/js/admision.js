$(document).ready(function () {

    function generarPdfHC() {
        $('#btnGenerarPdfHC').click(function (e) {
            let num = $('#num').val();
            let num_doc = $('#num_doc').val();
            let nameDoc = num + '_' + num_doc + '.pdf'

            $('#div_asociar_cita').hide();

            const $elementoParaConvertir = document.querySelector(".card-container"); // <-- Aquí puedes elegir cualquier elemento del DOM
            html2pdf()
                .set({
                    margin: 0.3,
                    filename: nameDoc,
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 3, // A mayor escala, mejores gráficos, pero más peso
                        letterRendering: true,
                    },
                    jsPDF: {
                        unit: "in",
                        format: "a3",
                        orientation: 'portrait' // landscape o portrait
                    }
                })
                .from($elementoParaConvertir)
                .save()
                .catch(err => console.log(err));

            setTimeout(() => {
                $('#div_asociar_cita').show();
            }, 2000)

        });
    }
    generarPdfHC()


    function generarPdfHC2() {
        $('#btnGenerarPdfHC').click(function (e) {
            var doc = new jsPDF();
            //var source = window.document.querySelector(".card-container");    
            var elementHTML = $('.card-container').html();

            doc.fromHTML(
                elementHTML,
                15,
                15, {
                    'width': 170
                });
            // la clave esta en blob: formato de archivos
            var blob = doc.output('blob');
            var formData = new FormData();
            formData.append('file', blob);

            $.ajax({
                type: 'POST',
                //url: 'upload.php',
                url: 'AdmisionController/movePDF',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log('PDF enviado', data)
                },
                error: function (data) {
                    console.log("Error Ajax: ", data)
                }
            });
        });
    }
    //generarPdfHC2()

    $('#btnAsociarCita').click(function (e) {
        e.preventDefault();
        $('#btnGuardarEspecialidad').show();
        $('.rtaNumAtencion').html('')
        $('#modalAsociarCita').modal('show')
    });

    function resetForm() {
        $('#formAsociarCita')[0].reset()
    }

    function fetchEspecialidad() {
        $.ajax({
            type: 'POST',
            url: 'AdmisionController/fetchEspecialidad',
            dataType: 'JSON',
            success: function (r) {
                let template = ''
                r.forEach(especialidad => {
                    template += `<option value="${especialidad.id}">${especialidad.nombre}</option>`
                })
                $('#especialidad').html(template);
            }
        });
    }
    fetchEspecialidad()
    // $('#especialidad').select2()

    $('#btnVerificarEspecialidad').click(function (e) {
        e.preventDefault();
        let especialidadSelect = $('#especialidad').val();
        $.ajax({
            type: 'POST',
            url: 'AdmisionController/verificarStock',
            data: {
                especialidadSelect: especialidadSelect
            },
            dataType: 'JSON',
            success: function (r) {
                let id = r[0].id
                let nombre = r[0].nombre
                // HIDEN NUM ATENCION ACTUAL
                $('#num_atencion').val(r[0].num_atencion);
                let num_atencion = ''
                if (r[0].num_atencion < 1) {
                    num_atencion = `<div class="alert alert-danger" role="alert">
                                    N° de atenciones disponibles: <strong>${r[0].num_atencion}</strong>
                                </div></p>`
                    $('#btnGuardarEspecialidad').hide();
                } else {
                    $('#btnGuardarEspecialidad').show();
                    num_atencion = `<div class="alert alert-success" role="alert">
                                N° de atenciones disponibles: <strong>${r[0].num_atencion}</strong>
                                </div></p>`

                }
                $('.rtaNumAtencion').html(num_atencion)
                $('#btnGuardarEspecialidad').removeAttr('disabled');
            }
        });
    });

    // clik RESERVAR CITA
    $('#formAsociarCita').submit(function (e) {
        e.preventDefault();
        let idEspecialidad = $('#especialidad').val();

        let numAtencionActual = $('#num_atencion').val();

        $.ajax({
            type: 'POST',
            url: 'AdmisionController/restarStock',
            data: {
                idEspecialidad: idEspecialidad,
                numAtencionActual: numAtencionActual
            },
            success: function (r) {
                //console.log(r)
                let numRandon = Math.floor(Math.random() * 899999 + 100000)
                if (r == 'ok') {
                    $('#cod_cita').val(numRandon);
                    $('#modalAsociarCita').modal('hide')
                    let idEspecialidad = $('#especialidad').val();
                    $('#idEspecialidadHiden').val(idEspecialidad);

                } else {
                    Alert.error('Ocurrió un error')
                }
            }
        });

    });

    // click GUARDAR CREACION DE HC
    $('#formSolicitudPaciente').submit(function (e) {
        e.preventDefault();
        let cod_cita = $('#cod_cita').val();
        if (cod_cita == '') {
            Alert.error('Es necesario asociar cita')
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'AdmisionController/saveHC',
            //data: $(this).serialize(),
            data: new FormData(this),
            contentType: false,
            processData: false,
            //dataType: 'JSON',
            success: function (r) {
                if (r == 'ok') {
                    Alert.success3('Guardado correctamente!')
                } else {
                    Alert.error('Error al guardar')
                }
            }
        });

    });

    function autoNumHistoria() {
        let numRandon = Math.floor(Math.random() * 8999999 + 1000000)
        $('#num').val(numRandon);
    }
    autoNumHistoria()

    function subirPdfAdmision() {
        $('#formSubirPdfAdmision').submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'AdmisionController/subirAdmisionPDF',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response)
                    if (response == 'ok') {
                        Alert.success3('Se guardo los cambios')
                        fetchLogoPath()
                    } else {
                        Alert.error('Se produjo un error')
                    }
                }
            });
        });
    }
    subirPdfAdmision()

});