function calcularEdad(fecha_nac) {
    fecha_nac = fecha_nac.toString()
    edad = 0
    fecha_now = moment().format('DD/MM/YYYY')
    anioNow = Number(fecha_now.split('/')[2])
    mesNow = Number(fecha_now.split('/')[1])
    diaNow = Number(fecha_now.split('/')[0])

    anioNac = Number(fecha_nac.split('/')[2])
    mesNac = Number(fecha_nac.split('/')[1])
    diaNac = Number(fecha_nac.split('/')[0])
    if (mesNow >= mesNac) {
        if (mesNow == mesNac) {
            if (diaNow >= diaNac) {
                edad = anioNow - anioNac
            } else {
                edad = (anioNow - anioNac) - 1
            }
        } else {
            edad = anioNow - anioNac
        }
    } else {
        edad = (anioNow - anioNac) - 1
    }
    return edad
}

/*
    OBTENER DATOS DE UNA PERSONA CON SU DNI
*/
const api_dni = (dni) => {
    if (dni != "") { //validacion campos vacios
        //validacion longitud
        if (dni.length == 8) {
            $.ajax({
                type: "GET",
                url: "https://dniruc.apisperu.com/api/v1/dni/" + dni + "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNveWFrczE5QGdtYWlsLmNvbSJ9.1NdRT9-w-xvSN0NONmckZLfMLcVixw_7sC30dAW9ALI",
                dataType: "json",
            }).done((data) => {
                let nombres = data.nombres
                let apellidos = data.apellidoPaterno + " " + data.apellidoMaterno;
                if (nombres != null) {
                    console.log(nombres + " " + apellidos)
                    $('#nombre').val(nombres);
                    $('#apellidos').val(apellidos);
                    $('#nombre').attr('autofocus', 'true');
                } else {
                    alert("DNI no existe")
                }
            });
        } else {
            alert("Los digitos deben ser 8")
        }
    } else {
        alert("Es necesario ingresar el DNI!");
    }
}

const api_ruc = (ruc) => {
    if (ruc.length == 11) { //RUC tienen 11 digitos
        $.ajax({
            type: "GET",
            url: "https://dniruc.apisperu.com/api/v1/ruc/" + ruc + "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNveWFrczE5QGdtYWlsLmNvbSJ9.1NdRT9-w-xvSN0NONmckZLfMLcVixw_7sC30dAW9ALI",
            dataType: "json",
        }).done((data) => {
            let razonSocial = data.razonSocial
            let direccion = data.direccion

            console.log("RAZONN: ", razonSocial)
            console.log(direccion)
        });
    } else {
        alert('RUC debe tener 11 dígitos')
    }

}


/**
 * Alert
 */
class Alert {
    static success(message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        // data.message: guardado o actualizado
        Toast.fire({
            icon: 'success',
            title: message
        })
    }
    static success2(message = '') {
        Swal.fire({
            icon: 'success',
            //ext: 'Guardado Correctamente!',
            text: message || 'Guardado Correctamente!'
        })
    }
    static success3(message) {
        Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: message,
            showConfirmButton: false,
            timer: 3000
        })
    }
    static error(message = '') {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message || 'Se produjo un error'
        })
    }
}

var buttonsArray = [
    {
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

function showLoading(){
    $('#divLoading').css('display', 'flex');
}
function hideLoading(){
    $('#divLoading').css('display', 'none');
}

function base_url(valor) {
    //captura solo https + dominio principal
    let url=window.location.origin
    return url+'/'+valor
}
function carpeta_proy() {
    return "SISTEMA_HC/sistema_hc_v2/"
}