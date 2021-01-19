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
            <?php } else if (empty($_GET['idSchedule'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <?php if(!empty($_GET["idSchedule"]) && isset($_GET["idSchedule"])){
                    $DataS=  \App\Controllers\ScheduleControllers::searchForID($_GET["idSchedule"]);
                if(!empty($DataS)){
                ?>
                <div class="card-header">
                    <h3 class="card-title">Mostrar Grupo</h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <div class="card card-info">
                    <p>
                        <strong><i class="fas fa-calendar-alt"></i> Fecha de Inicio</strong>
                    <p class="text-muted"><?= $DataS->getStartDateSchedule()->translatedFormat('l, j \\de F Y'); ?></p>
                    <hr>
                    <strong><i class="fas fa-calendar-alt"></i> Fecha de Cierre</strong>
                    <p class="text-muted"><?= $DataS->getEndDateSchedule()->translatedFormat('l, j \\de F Y'); ?></p>
                    <hr>
                    <strong><i class= "fas fa-compass"></i>Cant de Horas</strong>
                    <p class="text-muted"><?=$DataS->getCantHours();?></p>
                    <hr>
                    <strong><i class="far fa-compass"></i> Hora de Inicio</strong>
                    <p class="text-muted"><?=$DataS->getStartHourSchedule()->toTimeString();?></p>
                    <hr>
                    <strong><i class="far fa-compass"></i> Hora de Cierre</strong>
                    <p class="text-muted"><?=$DataS->getEndHourSchedule()->toTimeString();?></p>

                    <hr><strong><i class="fas fa-user mr-1"></i> Dias</strong>
                    <p class="text-muted"><?php
                        $checked_arr = explode("|",$DataS->getDaySchedule());
                        $daysArray = array("Lu"=>"Lunes","Ma"=>"Martes","Mi"=>"Miércoles","Ju"=>"Jueves","Vi"=>"Viernes","Sa"=>"Sábado","Do"=>"Domingo");
                        $check=array();
                        foreach($daysArray as $key=>$value) {
                            $checked = "";
                            if(in_array($key,$checked_arr)){
                                array_push($check,$value);
                            }
                        }
                        echo implode(',',$check);
                        ?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-user mr-1"></i> Estado</strong>
                    <p class="text-muted"><?=$DataS->getStateSchedule();?></p>
                    <hr>
                    </p>

                    <!--Datos del Grupo-->
                    <?php
                    if (!empty($_GET["idSchedule"])) {
                        $dataGroup = \App\Models\Group::search("SELECT * FROM iteandes_novatik.Group WHERE Schedule_idSchedule =" . $_GET["idSchedule"]);
                        foreach ($dataGroup as $group) {
                            $DataG = \App\Controllers\GroupControllers::searchForID($group->getIdGroup());
                        }
                        if(!empty($DataG)){?>
                            <div class="card-header">
                                <h3 class="card-title">Grupo</h3>
                            </div>
                            <div class="card-body">
                                <p>
                                    <strong><i class="fas fa-barcode"></i> Codigo</strong>
                                <p class="text-muted"><?=$DataG->getCodeGroup() ?></p>
                                <hr>
                                <strong><i class="fas fa-edit"></i> Nombre</strong>
                                <p class="text-muted"><?=$DataG->getNameGroup(); ?></p>
                                <hr>
                                <strong><i class="fas fa-chalkboard-teacher"></i>Cupo Minimo</strong>
                                <p class="text-muted"><?=$DataG->getMinimumSpaceGroup()?></p>
                                <hr>
                                <strong><i class="fas fa-book-reader"></i> Cupo Maximo</strong>
                                <p class="text-muted"><?= $DataG->getMaximumSpaceGroup()?></p>
                                <hr>
                                <strong><i class="fas fa-file-export"></i> Competencia Asociada</strong>
                                <p class="text-muted"><?=$DataG->getTrainingCompetitionIdTrainingCompetition()->getDenomination() ?></p>
                                <hr>
                                <strong><i class="fas fa-user mr-1"></i> Estado</strong>
                                <p class="text-muted"><?= $DataG->getStateGroup(); ?></p>
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