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
                    $('#id').val(r.id);
                    $('#nombre').val(r.nombre);
                    $('#tipo_doc').val(r.tipo_doc);
                    $('#num_doc').val(r.num_doc);
                    $('#email').val(r.email);
                    $('#email').val(r.email);

                    let apellidos = r.apellidos
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

    function buscarPacienteCodigo(){
        $('.btnBuscarDniPaciente').click(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: base_url(carpeta_proy()+'PacienteController/buscarPacienteCodigo'),
                //data: "data",
                dataType: "json",
                success: function (r) {
                    console.log(r[0].apellidos)
                    let nombreCompleto=r[0].nombre+' '+r[0].apellidos
                    let estado_mesa=r[0].estado_mesa
                    let observacion=r[0].observacion
                    let estado_mesa_str=''
                    
                    if(estado_mesa==-1){
                        estado_mesa_str='<span class="badge badge-warning">Pendiente</span>'
                    }else if(estado_mesa==0){
                        estado_mesa_str='<span class="badge badge-danger">Desaprobado</span>'
                    }else if(estado_mesa==1){
                        estado_mesa_str='<span class="badge badge-success">Aprobado</span>'
                    }
                    if(observacion==''){
                        observacion='Ninguno'
                    }

                    let rta_final=`
                    <p>Solicitante: ${nombreCompleto}</p>
                    <p>Estado de solicitud: ${estado_mesa_str}</p>
                    <p>Observación: ${observacion}</p>
                    `

                    $('#rta_consulta').html(rta_final);

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