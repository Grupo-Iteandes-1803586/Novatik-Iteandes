<?php
require ("../../partials/routes.php");
require ("../../../app/Controllers/GroupControllers.php");
require ("../../../app/Controllers/ScheduleControllers.php");

use App\Controllers\GroupControllers;
use App\Controllers\ScheduleControllers;
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE');?>| Consultar Grupos</title>
    <?php require ("../../partials/head_imports.php");?>
    <?php require("../../partials/header.php");?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php require ("../../partials/navbar_customation.php");?>
    <?php require ("../../partials/sliderbar_main_menu.php")?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Informacion Grupo</h1>
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
                        Error al consultar los Grupos: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['idGroup'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <?php if(!empty($_GET["idGroup"]) && isset($_GET["idGroup"])){
                    $DataGroup=  \App\Controllers\GroupControllers::searchForID($_GET["idGroup"]);
                    if(!empty($DataGroup)){
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php $DataGroup->getNameGroup()?></h3>
                            <?php require("../../partials/optionMenu.php") ;?>
                        </div>
                        <div class="card card-info">
                            <p>
                            <strong><i class="fas fa-user mr-1"></i> Codigo</strong>
                            <p class="text-muted"><?=$DataGroup->getCodeGroup() ?></p>
                            <hr>
                            <strong><i class="fas fa-user mr-1"></i> Nombre</strong>
                            <p class="text-muted"><?=$DataGroup->getNameGroup(); ?></p>
                            <hr>
                            <strong><i class="fas fa-user mr-1"></i>Cupo Minimo</strong>
                            <p class="text-muted"><?=$DataGroup->getMinimumSpaceGroup()?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Cupo Maximo</strong>
                            <p class="text-muted"><?= $DataGroup->getMaximumSpaceGroup()?></p>
                            <hr>
                            <strong><i class="fas fa-user mr-1"></i> Competencia Asociada</strong>
                            <p class="text-muted"><?=$DataGroup->getTrainingCompetitionIdTrainingCompetition()->getDenomination() ?></p>
                            <hr>
                            <strong><i class="fas fa-phone mr-1"></i> Estado</strong>
                            <p class="text-muted"><?= $DataGroup->getStateGroup(); ?></p>
                            <hr>
                            </p>

                            <!--Datos de Horario-->
                            <?php
                            if (!empty($_GET["idGroup"])) {
                                $dataSchedule = \App\Models\Schedule::search("SELECT * FROM Schedule WHERE Group_idGroup =" . $_GET["idGroup"]);
                                foreach ($dataSchedule as $schedule) {
                                    $DataS = \App\Controllers\ScheduleControllers::searchForID($schedule->getIdSchedule());
                                }
                                if(!empty($DataS)){?>
                                    <div class="card-header">
                                        <h3 class="card-title">Horario</h3>
                                    </div>
                                    <div class="card-body">
                                        <p>
                                        <strong><i class="fas fa-calendar mr-1"></i> Fecha de Inicio</strong>
                                        <p class="text-muted"><?= $DataS->getStartDateSchedule()->translatedFormat('l, j \\de F Y'); ?></p>
                                        <hr>
                                        <strong><i class="fas fa-calendar mr-1"></i> Fecha de Cierre</strong>
                                        <p class="text-muted"><?= $DataS->getEndDateSchedule()->translatedFormat('l, j \\de F Y'); ?></p>
                                        <hr>
                                        <strong><i class="fas fa-user mr-1"></i>Cant de Horas</strong>
                                        <p class="text-muted"><?=$DataS->getCantHours();?></p>
                                        <hr>
                                        <strong><i class="fas fa-user mr-1"></i> Hora de Inicio</strong>
                                        <p class="text-muted"><?=$DataS->getStartHourSchedule()->toTimeString();?></p>
                                        <hr>
                                        <strong><i class="fas fa-user mr-1"></i> Hora de Cierre</strong>
                                        <p class="text-muted"><?=$DataS->getEndHourSchedule()->toTimeString();?></p>
                                        <hr>
                                        <strong><i class="fas fa-user mr-1"></i> Estado</strong>
                                        <p class="text-muted"><?=$DataS->getStateSchedule();?></p>
                                        <hr>
                                        </p>
                                    </div>
                                <?php }?>
                            <?php }?>
                        </div>
                        <!--Sub menu-->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <a role="button" href="index.php" class="btn btn-success float-right" style="margin-right: 5px;">
                                        <i class="fas fa-tasks"></i> Consultar Grupos
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a role="button" href="create.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-plus"></i> Crear Grupos
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
    </div>
    <?php require ("../../partials/footer.php");?>
    <!--</div>-->
</div>
<?php require ("../../partials/scripts.php");?>
</body>
</html>