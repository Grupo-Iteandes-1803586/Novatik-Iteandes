<?php
require ("../../partials/routes.php");

require_once("../../../app/Controllers/TrainingCompetitionControllers.php");
require_once("../../../app/Models/TrainingCompetition.php");

use App\Controllers\TrainingCompetitionControllers;
use App\Models\TrainingCompetition;
use Carbon\Carbon;?>

<!doctype html>
<html lang="en">
<head>
    <head>
        <title><?= getenv('TITLE_SITE');?> | Agregar Materias</title>
        <?php require ("../../partials/head_imports.php");?>
        <?php require("../../partials/header.php");?>
    </head>
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require ("../../partials/navbar_customation.php");?>
    <?php require ("../../partials/sliderbar_main_menu.php")?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Agregar Materias</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/Views/">Iteandes</a></li>
                            <li class="breadcrumb-item active">Inicio</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <?php if(!empty($_GET['respuesta'])){ ?>
                <?php if ($_GET['respuesta'] != "correcto"){ ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        Error al crear el Horario: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>

                    <section class="col-sm-12 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Agregar Materias | Ciclos
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#cicleI" data-toggle="tab">Ciclo I</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#cicleII" data-toggle="tab">Ciclo II</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#cicleIII" data-toggle="tab">Ciclo III</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#cicleIV" data-toggle="tab">Ciclo IV</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#cicleV" data-toggle="tab">Ciclo V</a>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart tab-pane active" id="cicleI" style="position: relative; height: 300px;">
                                        <div class="row">
                                            <div class="col">
                                                <table id="tblCicloI" class="datatable table table-bordered table-striped">

                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Cod</th>
                                                        <th>Competencia</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $arrCompetition = \App\Controllers\TrainingCompetitionControllers::getAll();
                                                    foreach ($arrCompetition as $competition) {
                                                        if ($competition->getOrderTrainingCompetition() == "1" && $competition->getStatusTrainingCompetition() == "Activo" ) {
                                                            ?>
                                                        <tr>
                                                            <td><?php echo $competition->getIdTrainingCompetition(); ?></td>
                                                            <td><?php echo $competition->getCodeAlfaTrainingCompetition(); ?></td>
                                                            <td><a href="show.php?idTrainingCompetition=<?php echo $competition->getIdTrainingCompetition(); ?>">
                                                                <?php echo $competition->getDenomination();?></a></td>
                                                            <td><?php echo $competition->getStatusTrainingCompetition(); ?></td>

                                                        </tr>
                                                        <?php }
                                                    }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chart tab-pane" id="cicleII" style="position: relative; height: 300px;">
                                        <div class="row">
                                            <div class="col">
                                                <table id="tblCicloII" class="datatable table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Cod</th>
                                                        <th>Competencia</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <?php
                                                        $arrCompetition = \App\Controllers\TrainingCompetitionControllers::getAll();
                                                        foreach ($arrCompetition as $competition) {
                                                        if ($competition->getOrderTrainingCompetition() == "2" && $competition->getStatusTrainingCompetition() == "Activo" ) {
                                                        ?>
                                                        <td><?php echo $competition->getIdTrainingCompetition(); ?></td>
                                                        <td><?php echo $competition->getCodeAlfaTrainingCompetition(); ?></td>
                                                        <td><a href="show.php?idTrainingCompetition=<?php echo $competition->getIdTrainingCompetition(); ?>">
                                                                <?php echo $competition->getDenomination();?></a></td>
                                                        <td><?php echo $competition->getStatusTrainingCompetition(); ?></td>

                                                    </tr>
                                                    <?php }
                                                    }?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chart tab-pane" id="cicleIII" style="position: relative; height: 300px;">
                                        <div class="row">
                                            <div class="col">
                                                <table id="tblCicloIII" class="datatable table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Cod</th>
                                                        <th>Competencia</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <?php
                                                        $arrCompetition = \App\Controllers\TrainingCompetitionControllers::getAll();
                                                        foreach ($arrCompetition as $competition) {
                                                        if ($competition->getOrderTrainingCompetition() == "3" && $competition->getStatusTrainingCompetition() == "Activo" ) {
                                                        ?>
                                                        <td><?php echo $competition->getIdTrainingCompetition(); ?></td>
                                                        <td><?php echo $competition->getCodeAlfaTrainingCompetition(); ?></td>
                                                        <td><a href="show.php?idTrainingCompetition=<?php echo $competition->getIdTrainingCompetition(); ?>">
                                                                <?php echo $competition->getDenomination();?></a></td>
                                                        <td><?php echo $competition->getStatusTrainingCompetition(); ?></td>

                                                    </tr>
                                                    <?php }
                                                    }?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chart tab-pane" id="cicleIV" style="position: relative; height: 300px;">
                                        <div class="row">
                                            <div class="col">
                                                <table id="tblCicloIV" class="datatable table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Cod</th>
                                                        <th>Competencia</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <?php
                                                        $arrCompetition = \App\Controllers\TrainingCompetitionControllers::getAll();
                                                        foreach ($arrCompetition as $competition) {
                                                        if ($competition->getOrderTrainingCompetition() == "4" && $competition->getStatusTrainingCompetition() == "Activo" ) {
                                                        ?>
                                                        <td><?php echo $competition->getIdTrainingCompetition(); ?></td>
                                                        <td><?php echo $competition->getCodeAlfaTrainingCompetition(); ?></td>
                                                        <td><a href="show.php?idTrainingCompetition=<?php echo $competition->getIdTrainingCompetition(); ?>">
                                                                <?php echo $competition->getDenomination();?></a></td>
                                                        <td><?php echo $competition->getStatusTrainingCompetition(); ?></td>

                                                    </tr>
                                                    <?php }
                                                    }?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chart tab-pane" id="cicleV" style="position: relative; height: 300px;">
                                        <div class="row">
                                            <div class="col">
                                                <table id="tblCicloV" class="datatable table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Cod</th>
                                                        <th>Competencia</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <?php
                                                        $arrCompetition = \App\Controllers\TrainingCompetitionControllers::getAll();
                                                        foreach ($arrCompetition as $competition) {
                                                        if ($competition->getOrderTrainingCompetition() == "5" && $competition->getStatusTrainingCompetition() == "Activo" ) {
                                                        ?>
                                                        <td><?php echo $competition->getIdTrainingCompetition(); ?></td>
                                                        <td><?php echo $competition->getCodeAlfaTrainingCompetition(); ?></td>
                                                        <td><a href="show.php?idTrainingCompetition=<?php echo $competition->getIdTrainingCompetition(); ?>">
                                                                <?php echo $competition->getDenomination();?></a></td>
                                                        <td><?php echo $competition->getStatusTrainingCompetition(); ?></td>

                                                    </tr>
                                                    <?php }
                                                    }?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </section>
                <!-- /.card-body -->
        </section>
    </div>
    <?php require('../../partials/footer.php'); ?>
</div>
<!-- ./wrapper -->
<?php require('../../partials/scripts.php'); ?>
<script src="../../components/Js/script.js"></script>
<script>
    $(function () {
        $('.datatable').DataTable({
            "dom": 'Bfrtip',
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "language": {
                "url": "../../components/Spanish.json" //Idioma
            },
            "buttons": [
            ],
            "pagingType": "full_numbers",
            "responsive": true,
            "stateSave": true, //Guardar la configuracion del usuario
        });
    });
</script>
</body>
</html>
