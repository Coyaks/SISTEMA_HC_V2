<!-- EXTENDER LA PLANTILLA PRINCIPAL -->
<?= $this->extend('layout/plantillabase') ?>
<!-- SECCIONES -->
<?= $this->section('title') ?>
Médico
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- DATATABLES + B4 CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">


<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<div class="container-fluid mt-3">
    <fieldset class="border-fielset p-2">
        <legend class="w-auto text-primary">
            <h6 class="m-0 text-uppercase style-title">Citas pendientes de atención - Médico</h6>
        </legend>

        <div class="table-responsive">
            <table id="tablaMedico" class="table table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Edad</th>
                        <th>Codigo HC</th>
                        <th>Anotaciones de enfermera</th>
                        <th>Anotaciones</th>
                        <th>Fecha y Hora</th>
                        <th>Etapa</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <!-- SIN tbody -->
            </table>
        </div>
    </fieldset>
</div>

<!-- Modal Enfermeria-->
<div class="modal fade" id="modalMedico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- inicio de form -->
        <form id="formMedico">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <!-- icon close custom -->
                    <img src="<?php echo base_url('assets/img/close.png') ?>" alt="close" class="close" data-dismiss="modal" aria-label="Close">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Mis Anotaciones <span class="text-danger">*</span></label>
                                <textarea name="anotaciones" id="anotaciones" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- inputs hidden -->
                    <input type="hidden" id="nombrePaciente" name="nombrePaciente">
                    <input type="hidden" id="apellidosPaciente" name="apellidosPaciente">
                    <input type="hidden" id="cod_hc" name="cod_hc">
                    <input type="hidden" id="anotacionesEnfermera" name="anotacionesEnfermera">
                    <input type="hidden" id="anotacionesMedico" name="anotacionesMedico">
                    <input type="hidden" id="fechaHora" name="fechaHora">

                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Pasar a etapa 3 (Estar seguro de la acciones)</label>
                            <div class="toggle-flip">
                                <label>
                                    <input type="checkbox" name="etapa2" id="etapa2"><span class="flip-indecator" data-toggle-on="SI" data-toggle-off="NO"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- HIDDEN -->
                    <input type="hidden" name="hidden_id" id="hidden_id" />

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
<script src="<?= base_url('assets/js/medico.js') ?>"></script>
<?= $this->endSection() ?>