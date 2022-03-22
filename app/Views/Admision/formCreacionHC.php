<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="card-container">
    <div class="card mt-3">
        <h5 class="card-header text-center bold">HOJA DE IDENTIFICACIÓN FORMATO DE FILIACIÓN</h5>
        <div class="card-body solicitud-card">
            <h6 class="titulos">DATOS DE LA HISTORIA CLÍNICA</h6>
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">N° DE HISTORIA CLÍNICA</label>
                            <input type="text" class="form-control" name="num" id="num">
                        </div>

                        <div class="col-lg-12">
                            <label for="">I.E.D.S</label>
                            <input type="text" class="form-control" name="ieds" id="ieds">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                    <div class="row form-group ml-5" id="div_asociar_cita">
                        <button class="btn btn-primary col-lg-5" id="btnAsociarCita">Asociar cita hoy</button>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" id="cod_cita" name="cod_cita" readonly required>
                        </div>
                    </div>
                </div>

            </div>

            <h6 class="titulos mt-3">DATOS DEL PACIENTE</h6>

            <div class="row mb-3">
                <div class="col-lg-6">
                    <label for="">NOMBRE COMPLETO</label>
                    <input type="text" class="form-control" name="nombreCompleto" id="nombreCompleto">
                </div>
                <div class="col-lg-6">
                    <label for="">APELLIDO COMPLETO</label>
                    <input type="text" class="form-control" name="apellidoCompleto" id="apellidoCompleto">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <label for="">EDAD</label>
                    <input type="text" class="form-control" name="edad" id="edad">
                </div>
                <div class="col-lg-6">
                    <label for="">SEXO</label>
                    <input type="text" class="form-control" name="sexo" id="sexo">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label for="">DIRECCIÓN</label>
                    <input type="text" class="form-control" name="direccion" id="direccion">
                </div>
                <div class="col-lg-6">
                    <label for="">DISTRITO</label>
                    <input type="text" class="form-control" name="distrito" id="distrito">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label for="">FECHA DE NACIMIENTO</label>
                    <input type="text" class="form-control" name="fecha_nac" id="fecha_nac">
                </div>
                <div class="col-lg-6">
                    <label for="">TIPO DE DOCUMENTO</label>
                    <input type="text" class="form-control" name="tipo_doc" id="tipo_doc">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label for="">N° DE DOCUMENTO</label>
                    <input type="text" class="form-control" name="num_doc" id="num_doc" required>
                </div>
                <div class="col-lg-6">
                    <label for="">ESTADO CIVIL</label>
                    <input type="text" class="form-control" name="estado_civil" id="estado_civil">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <label for="">OCUPACIÓN</label>
                    <input type="text" class="form-control" name="ocupacion" id="ocupacion">
                </div>
                <div class="col-lg-6">
                    <label for="">N° DE CELULAR</label>
                    <input type="text" class="form-control" name="celular" id="celular">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <label for="">NOMBRE DE LA MADRE</label>
                    <input type="text" class="form-control" name="nombre_madre" id="nombre_madre">
                </div>
                <div class="col-lg-6">
                    <label for="">NOMBRE DEL PADRE</label>
                    <input type="text" class="form-control" name="nombre_padre" id="nombre_padre">
                </div>
            </div>

            <h6 class="titulos mt-3">PERSONA RESPONSABLE O ACOMPAÑANTE</h6>

            <div class="row">
                <div class="col-lg-6">
                    <label for="">NOMBRE COMPLETO</label>
                    <input type="text" class="form-control" name="nombre_acomp" id="nombre_acomp">
                </div>
                <div class="col-lg-6">
                    <label for="">DNI</label>
                    <input type="text" class="form-control" name="dni_acomp" id="dni_acomp">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label for="">DIRECCIÓN</label>
                    <input type="text" class="form-control" name="direccion_acomp" id="direccion_acomp">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/js/admision.js') ?>"></script>
</body>
</html>