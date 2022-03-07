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

<?= $this->endSection() ?>


<?= $this->section('contenido') ?>
<div class="container-fluid">

    <?php
    //print_r($datos2);
    var_dump($datos2);
    ?>
    <ul>
        <?php
        foreach ($datos as $dato) {
        ?>
            <li><?php
                if ($dato->estado == 1) {
                ?>
                    <span class="badge rounded-pill bg-success">Activo</span>
                <?php
                }
                ?>
            </li>

        <?php } ?>
    </ul>


</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('assets/js/test.js') ?>"></script>
<?= $this->endSection() ?>