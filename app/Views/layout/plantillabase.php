<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <title>Sistema PRO</title> -->
    <title><?= $this->renderSection('title') ?></title>

    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <!-- Font Awesome 5 PRO-->
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.4/css/pro.min.css">
    <!-- Font Awesome free CDN -->
    <!-- <script src="https://kit.fontawesome.com/3e07f7d7b0.js" crossorigin="anonymous"></script> -->

    <!-- MATERIAL DESIGN CSS -->
    <link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">

    <!-- Material icons -->
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('/assets/adminlte') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- MDB -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" /> -->

    <!-- SWEETALERT2 JS -->
    <script src="<?= base_url('node_modules/sweetalert2/dist/sweetalert2.min.js') ?>"></script>
    <!-- SWEET ALERT2 CSS -->
    <link rel="stylesheet" href="<?= base_url('node_modules/sweetalert2/dist/sweetalert2.min.css') ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('/assets/adminlte') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('/assets/adminlte') ?>/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('/assets/adminlte') ?>/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('/assets/adminlte') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('/assets/adminlte') ?>/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('/assets/adminlte') ?>/plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/main-style-admin.css') ?>">


    <?= $this->renderSection('css') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php
    $session = session();
    ?>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <!-- CERRAR SESION -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <span class="material-icons">
                            person
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user-circle"></i> Editar Perfil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo base_url('/logout') ?>" class="dropdown-item">
                            <i class="fas fa-sign-out "></i> Cerrar Sesión
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container inicio SIDEBAR-->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link text-center">
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo" class="brand-text img-circle elevation-3" style="width:50px">
            </a>

            <!-- MENU LATERAL | Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex text-white">
                    <div class="image">
                        <span class="material-icons" style="font-size:53px">
                            account_circle
                        </span>
                    </div>
                    <div class="info">
                        <a href="#" class="d-block m-0 p-0"><?= session('nombreApellidos') ?></a>
                        <span><small><?= session('email') ?></small></span>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <!-- lista general -->
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- MODULO DASHBOARD -->
                        <?php
                        if ($_SESSION['idRol'] == 1) {
                        ?>
                            <li class="nav-item active">
                                <a href="<?= base_url('dashboard') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>


                        <!-- MODULO DE ADMINISTRACION USUARIOS -->
                        <?php
                        if ($_SESSION['idRol'] == 1) {
                        ?>
                            <li class="nav-item menu-<?= (current_url() == base_url('usuario') || current_url() == base_url('roles') || current_url() == base_url('permisos')) ? 'open' : 'close' ?>">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user-friends"></i>
                                    <p>
                                        Administración
                                        <i class="fas fa-angle-left right"></i>
                                        <span class="badge badge-info right">3</span>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item ml-4">
                                        <a href="<?= base_url('usuario') ?>" class="nav-link <?= (current_url() == base_url('usuario')) ? 'menu-item-active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Usuarios</p>
                                        </a>
                                        </a>
                                    </li>
                                    <li class="nav-item ml-4">
                                        <a href="<?= base_url('roles') ?>" class="nav-link <?= (current_url() == base_url('roles')) ? 'menu-item-active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Puestos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item ml-4">
                                        <a href="<?= base_url('permisos') ?>" class="nav-link <?= (current_url() == base_url('permisos')) ? 'menu-item-active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Permisos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <!-- Vista de paciente -->
                        <?php
                        if ($_SESSION['idRol'] == 8 || $_SESSION['idRol'] == 1) { //eS PACIENTE
                        ?>
                            <li class="nav-item menu-<?= (current_url() == base_url('paciente/solicitud_copia_hc') || current_url() == base_url('paciente/visualizacion_copia_hc')) ? 'open' : 'close' ?>">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Paciente
                                        <i class="fas fa-angle-left right"></i>
                                        <span class="badge badge-info right">2</span>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item ml-4">
                                        <a href="<?= base_url('paciente/solicitud_copia_hc') ?>" class="nav-link <?= (current_url() == base_url('paciente/solicitud_copia_hc')) ? 'menu-item-active' : '' ?>">
                                            <p>Solicitud Copia HC</p>
                                        </a>
                                    </li>
                                    <li class="nav-item ml-4">
                                        <a href="<?= base_url('paciente/visualizacion_copia_hc') ?>" class="nav-link <?= (current_url() == base_url('paciente/visualizacion_copia_hc')) ? 'menu-item-active' : '' ?>">
                                            <p>Visualización Copia HC</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <?php
                        if ($_SESSION['idRol'] == 2 || $_SESSION['idRol'] == 1) {
                        ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url('/admision') ?>" class="nav-link <?= (current_url() == base_url('admision')) ? 'menu-item-active' : '' ?>">
                                    <i class="nav-icon fas fa-clinic-medical"></i>
                                    <p>
                                        HC Admisión
                                    </p>
                                </a>
                            </li>

                        <?php
                        }
                        ?>
                        <?php
                        if ($_SESSION['idRol'] == 7 || $_SESSION['idRol'] == 1) {
                        ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url('/mesapartes') ?>" class="nav-link <?= (current_url() == base_url('mesapartes')) ? 'menu-item-active' : '' ?>">
                                    <i class="nav-icon fas fa-clipboard-list"></i>
                                    <p>
                                        Bandeja Mesa Partes
                                    </p>
                                </a>
                            </li>

                        <?php
                        }
                        ?>

                        <?php
                        if ($_SESSION['idRol'] == 4 || $_SESSION['idRol'] == 1) {
                        ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url('/fedateo') ?>" class="nav-link <?= (current_url() == base_url('fedateo')) ? 'menu-item-active' : '' ?>">
                                    <i class="nav-icon fas fa-clipboard-list"></i>
                                    <p>
                                        Bandeja Fedateo
                                    </p>
                                </a>
                            </li>

                        <?php
                        }
                        ?>

                        <?php
                        if ($_SESSION['idRol'] == 6 || $_SESSION['idRol'] == 1) {
                        ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url('/enfermeria') ?>" class="nav-link <?= (current_url() == base_url('enfermeria')) ? 'menu-item-active' : '' ?>">
                                    <i class="nav-icon fas fa-clipboard-list"></i>
                                    <p>
                                        Bandeja Enfermería
                                    </p>
                                </a>
                            </li>

                        <?php
                        }
                        ?>

                        <?php
                        if ($_SESSION['idRol'] == 6 || $_SESSION['idRol'] == 1) {
                        ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url('/medico') ?>" class="nav-link <?= (current_url() == base_url('medico')) ? 'menu-item-active' : '' ?>">
                                    <i class="nav-icon fas fa-clipboard-list"></i>
                                    <p>
                                        Bandeja Médico
                                    </p>
                                </a>
                            </li>

                        <?php
                        }
                        ?>

                        <li class="nav-item">
                            <a href="<?php echo base_url('/logout') ?>" class="nav-link">
                                <i class="nav-icon fas fa-sign-out "></i>
                                <p>
                                    Cerrar sesión
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- FIN MENU LATERAL /.sidebar -->
        </aside>

        <!-- TODO EL CONTENIDO DINÁMICO AQUÍ -->
        <div class="content-wrapper">
            <?= $this->renderSection('contenido') ?>
        </div>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <!-- <script src="<?= base_url('/assets/adminlte') ?>/plugins/jquery/jquery.min.js"></script> -->
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('/assets/adminlte') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('/assets/adminlte') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- MDB -->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script> -->
    <!-- ChartJS -->
    <script src="<?= base_url('/assets/adminlte') ?>/plugins/chart.js/Chart.min.js"></script>

    <!-- JQVMap -->
    <script src="<?= base_url('/assets/adminlte') ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= base_url('/assets/adminlte') ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url('/assets/adminlte') ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url('/assets/adminlte') ?>/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url('/assets/adminlte') ?>/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('/assets/adminlte') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?= base_url('/assets/adminlte') ?>/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('/assets/adminlte') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('/assets/adminlte') ?>/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?= base_url('/assets/adminlte') ?>/dist/js/pages/dashboard.js"></script>

    <!-- CORE FUNCIONES JAVASCRIPT REUTILIZABLE -->
    <script src="<?= base_url('assets/js/core.js') ?>"></script>

    <!-- === Material Design Web JS === -->
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <!-- === Instantiate single textfield component rendered in the document ===  -->
    <script src="<?php echo base_url('assets/js/app_material.js') ?>"></script>

    <!-- DATATABLES JQUERY + B4 JS -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

    <!-- DATATABLES FILTRO POR COLUMNA -->
    <!-- <script src="assets/libs/datatables/dataTables.fixedHeader.min.js"></script> -->
    <script src="https://cdn.datatables.net/fixedheader/3.2.1/js/dataTables.fixedHeader.min.js"></script>

    <!-- 6 CDN BUTTONS DATATABLES -->
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <!-- FIN CDN BUTTONS DATATABLES -->

    <?= $this->renderSection('js') ?>

</body>

</html>