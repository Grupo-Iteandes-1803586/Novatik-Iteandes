<?php
require("../../partials/routes.php");
require_once ("../../../app/Controllers/GroupControllers.php");
require_once ("../../../app/Controllers/ScheduleControllers.php");
require_once ("../../../app/Models/Schedule.php");

use App\Controllers\GroupControllers;
use App\Models\Schedule;
use App\Controllers\ScheduleControllers;
use Carbon\Carbon;
?>
<html lang="es">
<head>
    <title><?= getenv('TITLE_SITE')?> | Editar Grupos</title>
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
                        <h1>Editar Grupo</h1>
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
                        Error al editar el Grupo: <?= ($_GET['mensaje']) ?? "" ?>
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
                <div class="card-header">

                    <h3 class="card-title">Editar Grupo</h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <!-- /.card-header -->
                <?php if(!empty($_GET["idGroup"]) && isset($_GET["idGroup"])){ ?>
                    <p>
                    <?php
                    $DataGroup = \App\Controllers\GroupControllers::searchForID($_GET["idGroup"]);
                    if(!empty($DataGroup)){
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="frmEditGroup" name="frmEditGroup" action="../../../app/Controllers/GroupControllers.php?action=edit">
                            <input id="idGroup" name="idGroup" value="<?php echo $DataGroup->getIdGroup(); ?>" hidden required="required" type="text">
                            <div class="card-body">
                                <!--Codigo-->
                                <div class="form-group row">
                                    <label for="codeGroup" class="col-sm-2 col-form-label">Codigo</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="codeGroup" name="codeGroup" value="<?= $DataGroup->getCodeGroup(); ?>" placeholder="Ingrese el Codigo">
                                    </div>
                                </div>
                                <!--Nombre-->
                                <div class="form-group row">
                                    <label for="nameGroup" class="col-sm-2 col-form-label">Nombre</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="nameGroup" name="nameGroup" value="<?= $DataGroup->getNameGroup(); ?>" placeholder="Ingrese el Nombre">
                                    </div>
                                </div>
                                <!--Cupo Minimo-->
                                <div class="form-group row">
                                    <label for="minimumSpaceGroup" class="col-sm-2 col-form-label">Cupo Minimo</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="minimumSpaceGroup" name="minimumSpaceGroup" value="<?= $DataGroup->getMinimumSpaceGroup(); ?>" placeholder="Ingrese el Cupo Minimo">
                                    </div>
                                </div>
                                <!--Cupo Maximo-->
                                <div class="form-group row">
                                    <label for="maximumSpaceGroup" class="col-sm-2 col-form-label">Cupo Maxio</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="maximumSpaceGroup" name="maximumSpaceGroup" value="<?= $DataGroup->getMaximumSpaceGroup(); ?>" placeholder="Ingrese el Cupo Maximo">
                                    </div>
                                </div>
                                <!--Competencia Asociada-->
                                <input id="TrainingCompetition_idTrainingCompetition" name="TrainingCompetition_idTrainingCompetition" value="<?php echo $DataGroup->getTrainingCompetitionIdTrainingCompetition()->getIdTrainingCompetition(); ?>" hidden required="required" type="text">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Competencia Asociada</label>
                                    <div class="col-sm-10">
                                        <input class="form-control"value="<?php echo $DataGroup->getTrainingCompetitionIdTrainingCompetition()->getDenomination(); ?>"
                                               type="text"  readonly="readonly">
                                    </div>
                                </div>
                                <!--Estado-->
                                <div class="form-group row">
                                    <label for="stateGroup" class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-10">
                                        <select id="stateGroup" name="stateGroup" class="custom-select">
                                            <option <?= ($DataGroup->getStateGroup() == "Activo") ? "selected":""; ?> value="Activo">Activo</option>
                                            <option <?= ($DataGroup->getStateGroup() == "Inactivo") ? "selected":""; ?> value="Inactivo">Inactivo</option>
                                        </select>
                                    </div>
                                </div>

                                <!--Horarios-->
                                <?php
                                $dataSchedule = Schedule::search("SELECT * FROM Schedule WHERE Group_idGroup =" . $_GET["idGroup"]);
                                foreach ($dataSchedule as $schedule) {
                                    $DataS = \App\Controllers\ScheduleControllers::searchForID($schedule->getIdSchedule());
                                }
                                if (!empty($DataS)) {
                                    ?>
                                    <li class="list-Dates"><i class="fas fa-book mr-1" id="icon-iconos"></i>Horario
                                    </li>
                                    <hr>
                                    <input id="idSchedule" name="idSchedule"
                                           value="<?php echo $DataS->getIdSchedule(); ?>" hidden
                                           required="required" type="text">
                                    <!--Fecha de Inicio -->
                                    <div class="form-group row">
                                        <label for="startDateSchedule" class="col-sm-2 col-form-label">Fecha de Inicio </label>
                                        <div class="col-sm-10">
                                            <input required type="date" max="<?= Carbon::now()->format('Y-m-d') ?>" class="form-control" id="startDateSchedule"
                                                   name="startDateSchedule"
                                                   value="<?php echo $DataS->getStartDateSchedule()->toDateString(); ?>"
                                                   placeholder="Fecha de Inicio ">
                                        </div>
                                    </div>
                                    <!--Fecha de Fin-->
                                    <div class="form-group row">
                                        <label for="endDateSchedule" class="col-sm-2 col-form-label">Fecha de Finalizacion</label>
                                        <div class="col-sm-10">
                                            <input required type="date" max="<?= Carbon::now()->format('Y-m-d') ?>" class="form-control" id="endDateSchedule"
                                                   name="endDateSchedule"
                                                   value="<?php echo $DataS->getEndDateSchedule()->toDateString(); ?>"
                                                   placeholder="Fecha de Finalizacion">
                                        </div>
                                    </div>
                                    <!--Cantidad de Horas-->
                                    <div class="form-group row">
                                        <label for="cantHours" class="col-sm-2 col-form-label">Cant de Horas</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control" id="cantHours"
                                                   name="cantHours"
                                                   value="<?php echo $DataS->getCantHours(); ?>"
                                                   placeholder="Cant de Horas">
                                        </div>
                                    </div>
                                    <!--Dias-->
                                    <div class="form-group row">
                                        <label for="daySchedule" class="col-sm-2 col-form-label">Dias</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control" id="daySchedule"
                                                   name="daySchedule"
                                                   value="<?php echo $DataS->getDaySchedule(); ?>"
                                                   placeholder="Dias">
                                        </div>
                                    </div>
                                    <!--Hora de Inicio-->
                                    <div class="form-group row">
                                        <label for="startHourSchedule" class="col-sm-2 col-form-label">Hora</label>
                                        <div class="col-sm-10">
                                            <input required type="time" max="<?= Carbon::now()?>" class="form-control" id="startHourSchedule"
                                                   name="startHourSchedule"
                                                   value="<?php echo $DataS->getStartHourSchedule(); ?>"
                                                   placeholder="Hora de">
                                        </div>
                                    </div>
                                    <!--Hora de Fin-->
                                    <div class="form-group row">
                                        <label for="endHourSchedule" class="col-sm-2 col-form-label">Hora de Finalizacion</label>
                                        <div class="col-sm-10">
                                            <input required type="time" max="<?= Carbon::now() ?>" class="form-control" id="endHourSchedule"
                                                   name="endHourSchedule"
                                                   value="<?php echo $DataS->getEndHourSchedule(); ?>"
                                                   placeholder="Hora     de Finalizacion">
                                        </div>
                                    </div>

                                <?php } ?>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Enviar</button>
                                <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    <?php }else{ ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            No se encontro ningun registro con estos parametros de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                        </div>
                    <?php } ?>
                    </p>
                <?php } ?>
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