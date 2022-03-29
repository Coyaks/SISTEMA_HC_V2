<!-- EXTENDER LA PLANTILLA PRINCIPAL -->
<?= $this->extend('layout/plantillabase') ?>
<!-- SECCIONES -->
<?= $this->section('title') ?>
Solicitud HC
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- DATATABLES + B4 CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">

<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<div class="container-fluid">
    <form id="formSolicitudPaciente" enctype="multipart/form-data">
        <div class="card mt-3">
            <h5 class="card-header text-center">FORMULARIO UNICO DE SOLICITUD DE COPIA FEDATEADA DE HISTORIA CLÍNICA</h5>
            <div class="card-body solicitud-card">
                <h6 class="titulos">DATOS DEL SOLICITANTE</h6>
                <div class="row form-group">
                    <label for="" class="col-lg-1 col-form-label">Nombres</label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" name="nombre" id="nombre">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row form-group">
                            <label for="" class="col-lg-3 col-form-label">Apellido Paterno</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="ape_paterno" id="ape_paterno">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row form-group">
                            <label for="" class="col-lg-3 col-form-label">Apellido Materno</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="ape_materno" id="ape_materno">
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row form-group">
                            <label for="" class="col-lg-3 col-form-label">Tipo de documento</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="tipo_doc" id="tipo_doc" placeholder="Ejemplo: DNI, RUC, CARNET DE EXTRANJERIA">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row form-group">
                            <label for="" class="col-lg-3 col-form-label">N° de documento</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="num_doc" id="num_doc" required>
                            </div>
                        </div>
                    </div>
                </div>
    
                <h6 class="titulos">DIRECCION</h6>
    
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Correo electrónico</label>
                        <input type="text" class="form-control" name="email" id="email">
                    </div>
                    <div class="col-lg-3">
                        <label for="">Celular</label>
                        <input type="text" class="form-control" name="celular" id="celular">
                    </div>
                    <!-- <div class="col-lg-3">
                        <label for="">Fijo</label>
                        <input type="text" class="form-control" name="fijo" id="fijo">
                    </div> -->
                </div>
    
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="">Direccion</label>
                        <input type="text" class="form-control" name="direccion" id="direccion">
                    </div>
                    <div class="col-lg-6">
                        <label for="">Distrito</label>
                        <input type="text" class="form-control" name="distrito" id="distrito">
                    </div>
                </div>
    
                <h6 class="titulos">BREVE SUSTENTO DEL PEDIDO</h6>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <textarea name="sustento" id="sustento" class="form-control" cols="30" rows="5" placeholder="DEBES INGRESAR EL SUSTENTO DE POR QUE NECESITAS LA COPIA FEDATEADA DE LA HISTORIA CLINICA..."></textarea>
                    </div>
                </div>
    
                <h6 class="titulos">ADJUNTOS</h6>
                <div class="row mb-3">
                    <div class="col-lg-12">
                    <label for="">Adjuntar DNI escaneado</label>
                        <input type="file" class="form-control"  name="dni_path" id="dni_path">
                    </div>
                </div>
    
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('assets/js/pacientes.js') ?>"></script>
<?= $this->endSection() ?>