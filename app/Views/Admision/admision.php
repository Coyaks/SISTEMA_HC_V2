<!-- EXTENDER LA PLANTILLA PRINCIPAL -->
<?= $this->extend('layout/plantillabase') ?>
<!-- SECCIONES -->
<?= $this->section('title') ?>
Solicitud HC
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- DATATABLES + B4 CSS -->
<script src="<?= media('libs/html2pdf/html2pdf.bundle.min.js')?>"></script>

<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<div class="container-fluid">
    <div class="row mt-2 mx-2">
        <h6 class="m-0 text-uppercase style-title text-primary">CREAR HC Y FILIACIÓN</h6>
        <button class="btn btn-danger ml-auto" id="btnGenerarPdfHC">Generar PDF</button>
    </div>
    <form id="formSolicitudPaciente" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" id="cod_cita" name="cod_cita" readonly>
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

        <div class="row">
            <div class="col-lg-12">
                <input type="hidden" id="idEspecialidadHiden" name="idEspecialidadHiden">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </form>
</div>

<!-- Modal ADMISION-->
<div class="modal fade" id="modalAsociarCita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- inicio de form -->
        <form id="formAsociarCita">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <!-- icon close custom -->
                    <img src="<?php echo base_url('assets/img/close.png') ?>" alt="close" class="close" data-dismiss="modal" aria-label="Close">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label for="">Seleccione la especialidad <span class="text-danger">*</span></label>
                                <select name="especialidad" id="especialidad" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="">&nbsp;</label>
                                <button class="btn btn-info form-control" id="btnVerificarEspecialidad">Verificar</button>
                            </div>
                        </div>
                    </div>

                    <div class="row row-observacion">
                        <div class="col-lg-12 rtaNumAtencion">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- HIDDEN -->
                    <input type="hidden" name="num_atencion" id="num_atencion"/>

                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>

                    <button type="submit" name="submit" id="btnGuardarEspecialidad" class="btn btn-success" disabled><i class="fa fa-fw fa-check-circle" aria-hidden="true"></i> Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('assets/js/admision.js') ?>"></script>
<?= $this->endSection() ?>