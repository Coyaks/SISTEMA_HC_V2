$(document).ready(function () {
    $('#formLogin').submit(function (e) { 
        e.preventDefault();
        //Mostrar loading al hacer click al btn
        showLoading()
        let dataForm=$(this).serialize();
        console.log(dataForm)
        $.ajax({
            type: "POST",
            url: "LoginController/login",
            data: dataForm,
            //dataType: "JSON",
            success: function (r) {
                hideLoading()
                if(r=='admin'){
                    window.location.href='dashboard'
                }else if(r=='paciente'){
                    window.location.href='paciente'
                }else if(r=='mesa'){
                    window.location.href='mesapartes'
                }else if(r=='fedateo'){
                    window.location.href='fedateo'
                }else if(r=='admision'){
                    window.location.href='admision'
                }else if(r=='enfermeria'){
                    window.location.href='enfermeria'
                }else if(r=='medico'){
                    window.location.href='medico'
                }else{
                    Alert.error(r)
                }
            }
        });    
    });

    function register(){
        $('#btnRegister').click(function (e) { 
            e.preventDefault();
            $('.modalRegister').modal('show');
            resetFormRegister()
        });
    }
    register()

    function resetFormRegister(){
        $('#formRegister').trigger('reset');
    }

    // REGISTRO DE USUARIO
    // REGISTRO DE USUARIO
    // REGISTRO DE USUARIO
    $('#formRegister').submit(function (e) { 
        e.preventDefault();
        let dataForm=$(this).serialize();
        console.log(dataForm)
        $.ajax({
            type: "POST",
            url: "LoginController/register",
            data: dataForm,
            dataType: "JSON",
            success: function (r) {
                if(r.rta=='ok'){
                    $('.rta_back').html(r.message);
                }else{
                    Alert.error('Error al registrar')
                }

                setTimeout(function () {
                    $('.modalRegister').modal('hide');     
                },3000)

            }
        });
    });

     //return array
    function buscarDNI(){
        $('.btnBuscarDni').click(function (e) { 
            e.preventDefault();
            let num_doc=$('#num_doc').val();
            api_dni(num_doc)
        });
    }
    buscarDNI()

    $('.btnVerificarHc').click(function (e) { 
        e.preventDefault();
        let num_hc=$('#num_hc').val();
        $.ajax({
            type: 'POST',
            url: 'LoginController/verificarNunHc',
            //data: $(this).serialize(),
            data: {
                num_hc:num_hc
            },
            dataType: 'JSON',
            success: function (r) {
                // console.log("aaaasss: ",r)
                // return false;
                if(r!=''){//existe
                    $('#nombre').val(r[0].nombres_comp);
                    $('#apellidos').val(r[0].apellidos_comp);
                    $('#num_doc').val(r[0].num_doc);
                    $('#tipo_doc').val(r[0].tipo_doc);
                    $('.btnRegister').removeAttr('disabled');
                }else{
                    alert("Codigo no válido")
                }
            }
        });
    });


});