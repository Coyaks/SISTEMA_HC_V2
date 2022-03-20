<!-- EXTENDER LA PLANTILLA PRINCIPAL -->
<?= $this->extend('layout/plantillabase') ?>
<!-- SECCIONES -->
<?= $this->section('title') ?>
Test
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- DATATABLES + B4 CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/css/estilosUsuario.css">

<style>
    /* USO DE DISABLED */
    .disable-button {
        cursor: not-allowed !important;
    }
</style>

<?= $this->endSection() ?>


<?= $this->section('contenido') ?>
<div class="container-fluid">
    <button class="disable-button btnClick" disabled>Hola</button>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('assets/js/test.js') ?>"></script>
<script>
    $('.btnClick').click(function (e) { 
        e.preventDefault();
        console.log('aaaa')
    });
</script>
<?= $this->endSection() ?>