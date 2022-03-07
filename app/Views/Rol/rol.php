<!-- EXTENDER LA PLANTILLA PRINCIPAL -->
<?= $this->extend('layout/plantillabase') ?>
<!-- SECCIONES -->
<?= $this->section('title') ?>
Roles
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
            <h6 class="m-0 text-uppercase style-title">Roles</h6>
        </legend>
        <div class="row mb-3">
            <div class="col-lg-12">
                <button type="button" name="add_record" id="btnNuevo" class="btn btn-success btn-sm rounded-pill"><i class="fas fa-plus"></i> Nuevo</button>
            </div>
        </div>

        <div class="table-responsive">
            <table id="tabla" class="table table-hover table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
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
    <div class="modal-dialog">
        <!-- inicio de form -->
        <form id="form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <!-- icon close custom -->
                    <img src="<?php echo base_url('assets/img/close.png') ?>" alt="close" class="close" data-dismiss="modal" aria-label="Close">
                </div>
                <div class="modal-body">
                    <!-- 1er ROW -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="">
                                <span id="nombre_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Descripcion</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="2"></textarea>
                                <span id="descripcion_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Estado</label>
                                <select name="estado" id="estado" class="form-control">
                                    <option value="1">Activo</option>
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

<!-- MODAL PERMISOS -->
<div class="modal fade modalPermisos" id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Permisos Roles de Usuario</h5>
                <img src="<?= media('img/close.png') ?>" alt="close" class="close" data-dismiss="modal" aria-label="Close">
            </div>
            <div class="modal-body">
                <form id="formPermisos">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tile">
                                <div class="tile-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered" id="tableRoles">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Módulo</th>
                                                    <th>Ver</th>
                                                    <th>Crear</th>
                                                    <th>Actualizar</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td>Usuarios</td>
                                                    <td>
                                                        <div class="toggle-flip">
                                                            <label>
                                                                <input type="checkbox" checked><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="toggle-flip">
                                                            <label>
                                                                <input type="checkbox"><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="toggle-flip">
                                                            <label>
                                                                <input type="checkbox"><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="toggle-flip">
                                                            <label>
                                                                <input type="checkbox"><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
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
                    </div>
    
                    <div class="text-center mb-2">
                        <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar</button>
    
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i> Cancelar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('assets/js/mainCrudRol.js') ?>"></script>
<?= $this->endSection() ?>