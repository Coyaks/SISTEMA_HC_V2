<!-- EXTENDER LA PLANTILLA PRINCIPAL -->
<?= $this->extend('layout/plantillabase') ?>
<!-- SECCIONES -->
<?= $this->section('title') ?>
Usuarios
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- DATATABLES + B4 CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/css/estilosUsuario.css">

<?= $this->endSection() ?>


<?= $this->section('contenido') ?>
<div class="container-fluid">
    <fieldset class="border-fielset p-2">
        <legend class="w-auto text-primary">
            <h6 class="m-0 text-uppercase style-title">Usuarios</h6>
        </legend>
        <div class="row mb-3">
            <div class="col-lg-12">
                <button type="button" name="add_record" id="btnNuevoUsuario" class="btn btn-success btn-sm rounded-pill"><i class="fas fa-plus"></i> Nuevo</button>
            </div>
        </div>

        <div class="table-responsive">
            <?php ?>
            <table id="tablaUsuario" class="table table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <!-- SIN tbody -->
            </table>
        </div>
    </fieldset>
</div>

<!-- Modal Usuario-->
<div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- inicio de form -->
        <form id="formUsuario">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <!-- icon close custom -->
                    <img src="<?php echo base_url('assets/img/close.png') ?>" alt="close" class="close" data-dismiss="modal" aria-label="Close">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="">
                                <!-- validacion elegante -->
                                <span id="nombre_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Apellidos</label>
                                <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="">
                                <span id="apellidos_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" id="email" value="@gmail.com" placeholder="">
                                <span id="email_error" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Password <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="password" id="password" placeholder="">
                                <span id="password_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="">Puesto <span class="text-danger">*</span></label>
                                <select name="rol" id="rol" class="form-control">
                                    <option value="">-- Seleccione --</option>
                                    <?php
                                        foreach ($roles as $rol) {
                                            ?>
                                                <option value="<?= $rol->id?>"><?= $rol->nombre?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                <span id="rol_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <!-- AREAS -->
                                <label for="" class="">Área <span class="text-danger">*</span></label>
                                <select name="area" id="area" class="form-control">
                                    <!-- <option value="">-- Seleccione --</option> -->
                                </select>
                                <span id="rol_error" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="">Estado</label>
                                <select name="estado" id="estado" class="form-control">
                                    <option value="1" selected>Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                                <span id="estado_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- HIDDEN -->
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="hidden" name="action" id="action" value="Add" />

                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>

                    <!-- OJO: button tambien tine value="Add" or "Edit" -->
                    <button type="submit" name="submit" id="btnGuardar" class="btn btn-success"><i class="fa fa-fw fa-check-circle" aria-hidden="true"></i> Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('assets/js/mainCrudUsuario.js') ?>"></script>
<?= $this->endSection() ?>