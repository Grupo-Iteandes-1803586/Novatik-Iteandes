<?php
require("../../partials/routes.php");
require("../../../app/Controllers/TrainingProgramController.php");

use App\Controllers\TrainingProgramController; ?>
<!doctype html>
<html lang="es">
<head>
    <title><?=getenv('TITLE_SITE');?> | Ver Programa</title>
    <?php
    require ("../../partials/head_imports.php");
    require ("../../partials/header.php");
    ?>
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require ("../../partials/navbar_customation.php");?>
    <?php require ("../../partials/sliderbar_main_menu.php");?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Informacion del Programa de Formacion</h1>
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
                <?php if ($_GET['respuesta'] == "error"){ ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        Error al consultar el Programa de Formacion: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['idTrainingProgram'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <?php if(!empty($_GET["idTrainingProgram"]) && isset($_GET["idTrainingProgram"])){
                    $DataPrograming = TrainingProgramController::searchForID($_GET["idTrainingProgram"]);
                    if(!empty($DataPrograming)){
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?= $DataPrograming->getNameTrainingProgram();?></h3>
                            <?php require("../../partials/optionMenu.php") ;?>
                        </div>
                        <div class="card-body">
                            <p>
                            <strong><i class="fas fa-user mr-1"></i> Codigo del Programa</strong>
                                <p class="text-muted"><?= $DataPrograming->getCodeTrainingProgram();?></p>
                            <hr>
                            <strong><i class="fas fa-user mr-1"></i> Codigo del Programa corto</strong>
                            <p class="text-muted"><?= $DataPrograming->getCodeAlfaTrainingProgram();?></p>
                            <hr>
                            <strong><i class="fas fa-book mr-1"></i> Nombre Programa de Formacion</strong>
                            <p class="text-muted">
                                <?= $DataPrograming->getNameTrainingProgram();?>
                            </p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Version</strong>
                            <p class="text-muted"><?= $DataPrograming->getVersion() ?></p>
                            <hr>
                            <strong><i class="fas fa-phone mr-1"></i> Estado</strong>
                            <p class="text-muted"><?= $DataPrograming->getStatusTrainingProgram() ?></p>
                            <hr>
                            </p>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <a role="button" href="index.php" class="btn btn-success float-right" style="margin-right: 5px;">
                                        <i class="fas fa-tasks"></i> Gestionar Programa
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a role="button" href="create.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-plus"></i> Crear Programa
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            No se encontro ningun registro con estos parametros de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                        </div>
                    <?php }
                } ?>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require ('../../partials/footer.php');?>
</div>
<!-- ./wrapper -->
<?php require ('../../partials/scripts.php');?>
</body>
</html>