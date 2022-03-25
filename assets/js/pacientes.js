$(document).ready(function () {

    $('#formSolicitudPaciente').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            //url: base_url('PacienteController/saveDatosSolicitud'),
            url: base_url(carpeta_proy()+'PacienteController/saveDatosSolicitud'),
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (response) {
                if (response.rta == 'ok') {
                    Alert.success2('Se envió la solicitud para la copia de H.C. Por favor volver a ingresar en 24 H para la descarga.Código de solicitud: ' + response.dni);
                } else {
                    Alert.error('Error al generar solicitud!');
                }
                console.log(response)
            }
        });

    });
    //autocompletar datos existentes del paciente
    function fetchDatosPacienteLogeado() {
        $.ajax({
            type: "POST",
            url: base_url(carpeta_proy()+'PacienteController/fetchDatosPaciente'),
            //url: base_url('PacienteController/fetchDatosPaciente'),
            dataType: "JSON",
            success: function (res) {
                res.forEach(r => {
                    //$('#id').val(r.id);
                    $('#nombre').val(r.nombres_comp);
                    $('#tipo_doc').val(r.tipo_doc);
                    $('#num_doc').val(r.num_doc);
                    $('#celular').val(r.celular);
                    $('#direccion').val(r.direccion);
                    $('#distrito').val(r.distrito);
                    $('#email').val(r.email);
                    

                    let apellidos = r.apellidos_comp
                    if (apellidos != '') {
                        let arrayApe = apellidos.split(" ")
                        $('#ape_paterno').val(arrayApe[0]);
                        $('#ape_materno').val(arrayApe[1]);
                    }
                })
            }
        });
    }
    fetchDatosPacienteLogeado()

    // BTN BUSCAR CON DNI PARA VER PDFs
    function buscarPacienteCodigo(){
        $('.btnBuscarDniPaciente').click(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: base_url(carpeta_proy()+'PacienteController/buscarPacienteCodigo'),
                //data: "data",
                dataType: "json",
                success: function (r) {
                    if(r.rta!='error'){
                        r=r.rta
                        console.log(r[0].apellidos)
                        let nombreCompleto=r[0].nombre+' '+r[0].apellidos
                        let estado_mesa=r[0].estado_mesa
                        let observacion=r[0].observacion
                        let estado_mesa_str=''
                        //mostrar path HC
                        let hc_path=base_url2('uploads/historia_clinica/')
                        let hc=r[0].hc_path_fedateado
                        let hc_complete=hc_path+hc
                        
                        let rta_pdf_hc=''
                        let rta_pdf_citas=''
                        if(estado_mesa==-1){
                            estado_mesa_str='<span class="badge badge-warning">Pendiente</span>'
                        }else if(estado_mesa==0){
                            estado_mesa_str='<span class="badge badge-danger">Desaprobado</span>'
                        }else if(estado_mesa==1){
                            estado_mesa_str='<span class="badge badge-success">Aprobado</span>'
                            rta_pdf_hc=`<p>Historia Clinica <a href="${hc_complete}" target="_blank">Descargar</a></p>`
                        }
                        if(observacion==''){
                            observacion='Ninguno'
                        }
    
                        let rta_final=`
                        <p>Solicitante: ${nombreCompleto}</p>
                        <p>Estado de solicitud: ${estado_mesa_str}</p>
                        <p>Observación: ${observacion}</p>
                        `

                        $('#rta_consulta').html(rta_final+rta_pdf_hc)
                    }else{
                        Alert.error('Ud. aún no hizo la solicitud de copia de HC')
                    }


                    /*
                    -1 -> pendiente
                    0 -> desaprobado
                    1 -> Aprobado
                    */
                }
            });
            
        });
    }
    buscarPacienteCodigo()
});