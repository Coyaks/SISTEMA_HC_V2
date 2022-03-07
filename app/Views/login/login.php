<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- MATERIAL DESIGN CSS -->
    <link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">

    <!-- MATERIAL ICONS FULL -->
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />

    <!-- B5 CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

    <!-- B4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- SWEETALERT2 JS -->
    <script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <!-- SWEET ALERT2 CSS -->
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <!-- CSS CUSTOM -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style-login.css') ?>">

</head>

<body>
    <?php
        include_once 'register.php';
    ?>
    <div class="contenedor">
        <div class="box-login shadow-lg border p-5 rounded">
            <!-- loading -->
            <div id="divLoading">
                <div>
                    <img src="<?= media('img/loading.svg')?>" alt="Loading">
                </div>
            </div>

            <form id="formLogin">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <img src="<?php echo base_url('assets/img/skoy_color.png') ?>" alt="Logo" id="logoSkoy">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="text-center">Log In</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <label class="mdc-text-field mdc-text-field--outlined w-100">
                            <span class="mdc-notched-outline">
                                <span class="mdc-notched-outline__leading"></span>
                                <span class="mdc-notched-outline__notch">
                                    <span class="mdc-floating-label" id="my-label-id">Email</span>
                                </span>
                                <span class="mdc-notched-outline__trailing"></span>
                            </span>
                            <!-- Email -->
                            <input type="text" class="mdc-text-field__input" id="email" name="email" autofocus autocomplete="off" value="admin@gmail.com">
                            <span class="material-icons-outlined mdc-text-field__icon mdc-text-field__icon--trailing">
                                face
                            </span>
                        </label>
                    </div>
                </div>

                <!-- row 2 -->
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <label class="mdc-text-field mdc-text-field--outlined w-100 text-field-pass">
                            <span class="mdc-notched-outline">
                                <span class="mdc-notched-outline__leading"></span>
                                <span class="mdc-notched-outline__notch">
                                    <span class="mdc-floating-label" id="my-label-id">Password</span>
                                </span>
                                <span class="mdc-notched-outline__trailing"></span>
                            </span>
                            <!-- Password -->
                            <input type="password" class="mdc-text-field__input toggle-password" id="password" name="password" autocomplete="off">
                            <!-- ICON EYE -->
                            <span id="icon-view-pass2">
                                <span class="material-icons-outlined mdc-text-field__icon mdc-text-field__icon--trailing">
                                    visibility_off
                                </span>
                            </span>

                        </label>
                    </div>

                    <div class="col-lg-12">
                        <p class="text-end mt-3 link-custom"><a href="#" class="text-primario">¿Olvidaste tu contraseña?</a></p>
                    </div>
                </div>

                <!-- row 2 -->
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btnLogin w-100 rounded-pill">Iniciar Sesión</button>
                        <!-- <p class="mt-2 text-center link-custom">¿No tiene una cuenta? <span class="text-primario pointer" id="btnRegister">Abrir cuenta</span>
                        </p> -->

                        <p class="mt-2 text-center link-custom">¿No tiene una cuenta? <span class="text-primario pointer" id="btnRegister">Crear cuenta como paciente</span>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <!-- Material Design Web JS -->
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <!-- Instantiate single textfield component rendered in the document -->
    <script src="<?php echo base_url('assets/js/app_material.js') ?>"></script>

    <script>
        //Logica para show y hiden del icon 'ojo' input password
        $(document).ready(function() {
            $('#icon-view-pass2').click(function(e) {
                let input_type = $('.toggle-password').attr('type');
                if (input_type == 'password') {
                    $('.toggle-password').attr('type', 'text');
                    $('#icon-view-pass2 span').text('visibility');
                } else {
                    $('.toggle-password').attr('type', 'password');
                    $('#icon-view-pass2 span').text('visibility_off');
                }
            });
        });
    </script>

    <script src="assets/js/core.js"></script>
    <script src="assets/js/login.js"></script>
</body>

</html>