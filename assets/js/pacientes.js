$(document).ready(function () {

    function validarExtensionesFile(valueFile) {
        if (valueFile != '') { //valueFile == C:\fakepath\20211110_161107.jpg
            let extensionFile = valueFile.split('.').pop().toLowerCase(); //OJO: solo extension: 'jpg'
            /*
            *XLS es la de los archivos de Excel en sus versiones del 97 al 2003
            */
            let arrayExtensiones = ['pdf']
            /*//$.inArray return -1 si el item no existe, si existe return la posicion*/
            if ($.inArray(extensionFile, arrayExtensiones) != -1) { //file valido
                return true
            } else { //file no permitido
                return false
            }
        }
    }


    $('#formSolicitudPaciente').submit(function (e) {
        e.preventDefault();

        let dni_path=$('#dni_path').val();
        if(validarExtensionesFile(dni_path)==false){
            Alert.error('Extensión de archivo no permitido. Solo se permite PDF.')
            return false
        }

        $.ajax({
            type: "POST",
            //url: base_url(carpeta_proy()+'PacienteController/saveDatosSolicitud'),
            url: base_url+'/PacienteController/saveDatosSolicitud',
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
            //url: base_url(carpeta_proy()+'PacienteController/fetchDatosPaciente'),
            url: base_url+'/PacienteController/fetchDatosPaciente',
            dataType: "JSON",
            success: function (res) {
                res.forEach(r => {
                    //$('#id').val(r.id);
                    let nombreComp=r.nombres_comp
                    let arrayNom=nombreComp.split(' ')
                    let onlyNombre=arrayNom[0]
                    let onlyApePaterno=arrayNom[1]
                    let onlyApeMaterno=arrayNom[2]

                    $('#nombre').val(onlyNombre);
                    $('#ape_paterno').val(onlyApePaterno);
                    $('#ape_materno').val(onlyApeMaterno);
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
                //url: base_url(carpeta_proy()+'PacienteController/buscarPacienteCodigo'),
                url: base_url+'/PacienteController/buscarPacienteCodigo',
                //data: "data",
                dataType: "json",
                success: function (r) {
                    console.log('aaa ',r)
                    if(r.rta!='error'){
                        r=r.rta
                        console.log(r[0].apellidos)
                        let nombreCompleto=r[0].nombre+' '+r[0].apellidos
                        let estado_mesa=r[0].estado_mesa
                        let observacion=r[0].observacion
                        let estado_mesa_str=''
                        //mostrar path HC
                        let hc_path=base_url2('uploads/historia_clinica/')
                        let cita_path=base_url2('uploads/citas/')
                        let hc=r[0].hc_path_fedateado
                        let cita=r[0].cita_path
                        let hc_complete=hc_path+hc
                        let cita_complete=cita_path+cita
                        
                        let rta_pdf_hc=''
                        let rta_pdf_citas=''
                        if(estado_mesa==-1){
                            estado_mesa_str='<span class="badge badge-warning">Pendiente</span>'
                        }else if(estado_mesa==0){
                            estado_mesa_str='<span class="badge badge-danger">Desaprobado</span>'
                        }else if(estado_mesa==1){
                            estado_mesa_str='<span class="badge badge-success">Aprobado</span>'
                            rta_pdf_hc=`<p>Historia Clinica <a href="${hc_complete}" target="_blank">Descargar</a></p>`
                            rta_pdf_citas=`<p>Atenciones <a href="${cita_complete}" target="_blank">Descargar</a></p>`
                        }
                        if(observacion==''){
                            observacion='Ninguno'
                        }
    
                        let rta_final=`
                        <p>Solicitante: ${nombreCompleto}</p>
                        <p>Estado de solicitud: ${estado_mesa_str}</p>
                        <p>Observación: ${observacion}</p>
                        `

                        $('#rta_consulta').html(rta_final+rta_pdf_hc+rta_pdf_citas)
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