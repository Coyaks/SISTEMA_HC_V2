<!-- EXTENDER LA PLANTILLA PRINCIPAL -->
<?= $this->extend('layout/plantillabase') ?>
<!-- SECCIONES -->
<?= $this->section('title') ?>
Permisos
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
            <h6 class="m-0 text-uppercase style-title">Permisos</h6>
        </legend>
        <div class="row mb-3">
            <div class="col-lg-12">
                <button type="button" name="add_record" id="btnNuevo" class="btn btn-success btn-sm rounded-pill"><i class="fas fa-plus"></i> Nuevo</button>
            </div>
        </div>
        <div class="table-responsive">
            <table id="tablaPer" class="table table-hover table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Rol</th>
                        <th>Módulo</th>
                        <th>Ver</th>
                        <th>Crear</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>

                        <th>Acciones</th>
                    </tr>
                </thead>
                <!-- SIN tbody -->
            </table>
        </div>
    </fieldset>
</div>

<!-- Modal-->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- inicio de form -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <!-- icon close custom -->
                <img src="<?php echo base_url('assets/img/close.png') ?>" alt="close" class="close" data-dismiss="modal" aria-label="Close">
            </div>

            <form id="form">
                <div class="modal-body">
                    <!-- 1er ROW -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Rol <span class="text-danger">*</span></label>
                                <select name="rol" id="rol" class="form-control">

                                </select>
                                <span id="rol_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Módulos</label>
                                <select name="modulo" id="modulo" class="form-control"></select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Permisos Tabla -->
                            <label for="">Asignar Permisos</label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tablaPermisos">
                                    <thead>
                                        <tr>
                                            <th>Ver</th>
                                            <th>Crear</th>
                                            <th>Actualizar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="toggle-flip">
                                                    <label>
                                                        <input type="checkbox" name="r" id="r" checked><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="toggle-flip">
                                                    <label>
                                                        <input type="checkbox" name="c" id="c"><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="toggle-flip">
                                                    <label>
                                                        <input type="checkbox" name="u" id="u"><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="toggle-flip">
                                                    <label>
                                                        <input type="checkbox" name="d" id="d"><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
            </form>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('assets/js/permisos.js') ?>"></script>
<?= $this->endSection() ?>