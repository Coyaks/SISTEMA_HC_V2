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
                if(r=='ok'){
                    window.location.href='dashboard'
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
});