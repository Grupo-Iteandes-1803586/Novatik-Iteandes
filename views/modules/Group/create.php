<?php require ("../../partials/routes.php");
require_once("../../../app/Controllers/TrainingCompetitionControllers.php");
use Carbon\Carbon;
?>

<!doctype html>
<html lang="es">
<head>
    <title><?= getenv('TITLE_SITE');?> | Crear Grupo</title>
    <?php require ("../../partials/head_imports.php");?>
    <?php require("../../partials/header.php");?>
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
                        <h1>Crear Grupo</h1>
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
                        Error al crear el Grupo: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Agregar Grupo</h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="frmCreateGroup" name="frmCreateGroup" action="../../../app/Controllers/GroupControllers.php?action=create">

                    <!--Formulario de los datos de la actividad-->
                    <div class="card-body">
                        <li class="list-Dates"><i class ="fas fa-address-book" id="icon-iconos"></i>Grupo</li>
                        <hr>
                        <!--Codigo del Grupo-->
                        <div class="form-group row">
                            <label for="codeGroup" class="col-sm-2 col-form-label">Codigo Grupo</label>
                            <div class="col-sm-10">
                                <input required type="Number" class="form-control" id="codeGroup" name="codeGroup" placeholder="Codigo del Grupo">
                            </div>
                        </div>
                        <!--nombre del Grupo-->
                        <div class="form-group row">
                            <label for="nameGroup" class="col-sm-2 col-form-label">Nombre Del Grupo</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="nameGroup" name="nameGroup" placeholder="Nombre del Grupo">
                            </div>
                        </div>
                        <!--Cupo Minimo-->
                        <div class="form-group row">
                            <label for="minimumSpaceGroup" class="col-sm-2 col-form-label">Cupo Minimo</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="minimumSpaceGroup" name="minimumSpaceGroup" placeholder="Cupo Minimo">
                            </div>
                        </div>
                        <!--Cupo Maximo-->
                        <div class="form-group row">
                            <label for="maximumSpaceGroup" class="col-sm-2 col-form-label">Cupo Maximo</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="maximumSpaceGroup" name="maximumSpaceGroup" placeholder="Cupo Maximo">
                            </div>
                        </div>
                        <?php
                        $dataGroup = null;
                        if (!empty($_GET['idGroup'])) {
                            $dataGroup = \App\Controllers\GroupControllers::searchForID($_GET['idGroup']);
                        }
                        ?>
                        <div class="form-group row">
                            <label for="TrainingCompetition_idTrainingCompetition" class="col-sm-2 col-form-label">Competencia</label>
                            <div class="col-sm-10">
                                <?= \App\Controllers\TrainingCompetitionControllers::selectCompetition(false,
                                    true,
                                    'TrainingCompetition_idTrainingCompetition',
                                    'TrainingCompetition_idTrainingCompetition',
                                    (!empty($dataGroup)) ? $dataGroup->getTrainingCompetitionIdTrainingCompetition()->getIdTrainingCompetition() : '',
                                    'form-control select2bs4 select2-info',
                                    "statusTrainingCompetition = 'Activo'")
                                ?>
                            </div>
                        </div>
                        <!------------------------Horario o Jornada-------------------------->

                        <li class="list-Dates"><i class ="fas fa-address-book" id="icon-iconos"></i>Horario</li>
                        <hr>
                        <!--Fecha de Inicio-->
                        <div class="form-group row">
                            <label for="startDateSchedule" class="col-sm-2 col-form-label">Fecha de Inicio</label>
                            <div class="col-sm-10">
                                <input required type="date" max="<?= Carbon::now()->format('Y-m-d') ?>" class="form-control" id="startDateSchedule"
                                       name="startDateSchedule" placeholder="Ingrese la fecha de Iniciaizacion de la Competencia">
                            </div>
                        </div>
                        <!--Fecha de Cierre-->
                        <div class="form-group row">
                            <label for="endDateSchedule" class="col-sm-2 col-form-label">Fecha de Fin</label>
                            <div class="col-sm-10">
                                <input required type="date" min="<?= Carbon::now()->format('Y-m-d') ?>" class="form-control" id="endDateSchedule"
                                       name="endDateSchedule" placeholder="Ingrese la fecha de Finalizacion de la Competencia">
                            </div>
                        </div>
                        <!--Cantidad de horas-->
                        <div class="form-group row">
                            <label for="cantHours" class="col-sm-2 col-form-label">Cantidad de Horas</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="cantHours" name="cantHours" placeholder="Cantidad de Horas">
                            </div>
                        </div>
                        <!--Dias-->
                        <div class="form-group row">
                            <label for="daySchedule" class="col-sm-2 col-form-label">Dias</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="daySchedule" name="daySchedule" placeholder="Dias">
                            </div>
                        </div>
                        <!--Hora de inicio-->
                        <div class="form-group row">
                            <label for="startHourSchedule" class="col-sm-2 col-form-label">Hora de Inicio</label>
                            <div class="col-sm-10">
                                <input required type="time" max="<?= Carbon::now()->format('HH:MM:SS') ?>" class="form-control" id="startHourSchedule"
                                       name="startHourSchedule" placeholder="Ingrese la Hora de Inicio de la Competencia">
                            </div>
                        </div>
                        <!--Hora de Finaizacion-->
                        <div class="form-group row">
                            <label for="endHourSchedule" class="col-sm-2 col-form-label">Hora de Inicio</label>
                            <div class="col-sm-10">
                                <input required type="time" max="<?= Carbon::now()->format('HH:MM:SS') ?>" class="form-control" id="endHourSchedule"
                                       name="endHourSchedule" placeholder="Ingrese la Hora de Cierre de la Competencia">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Enviar</button>
                        <a href="show.php" role="button" class="btn btn-default float-right">Cancelar</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
        </section>
    </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php require ("../../partials/footer.php");?>
    <!--</div>-->
<?php require ("../../partials/scripts.php");?>
</body>
</html>
