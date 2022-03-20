<!-- EXTENDER LA PLANTILLA PRINCIPAL -->
<?= $this->extend('layout/plantillabase') ?>
<!-- SECCIONES -->
<?= $this->section('title') ?>
Visualización HC
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- DATATABLES + B4 CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/estilosPaciente.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<div class="container-fluid">
    <div class="card">
        <h5 class="card-header">Visualización HC</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <label for="">Consultar solicitud</label>
                    <div class="input-group mb-3">
                        <!-- ID DE PACIENTE -->
                        <input type="text" name="id" id="id" class="form-control" placeholder="Ingrese su DNI" required>
                        <div class="input-group-append pointer btnBuscarDniPaciente">
                            <button class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div id="rta_consulta">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script src="<?= base_url('assets/js/pacientes.js') ?>"></script>
<?= $this->endSection() ?>