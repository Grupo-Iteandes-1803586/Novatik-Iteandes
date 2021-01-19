<?php
require("../../partials/routes.php");
require_once ("../../../app/Controllers/GroupControllers.php");
require_once ("../../../app/Controllers/ScheduleControllers.php");
require_once ("../../../app/Controllers/TeacherControllers.php");
require_once ("../../../app/Models/Schedule.php");
require_once ("../../../app/Models/Group.php");
require_once ("../../../app/Models/Teacher.php");

use App\Controllers\GroupControllers;
use App\Controllers\TeacherControllers;
use App\Models\Schedule;
use App\Models\Group;
use App\Models\Teacher;
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
            <?php } else if (empty($_GET['idSchedule'])) { ?>
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
                <?php if(!empty($_GET["idSchedule"]) && isset($_GET["idSchedule"])){ ?>
                    <p>
                    <?php $DataSc = \App\Controllers\ScheduleControllers::searchForID($_GET["idSchedule"]);
                        if(!empty($DataSc)){
                        ?>
                        <!-- form start -->
                    <form class="form-horizontal" method="post" id="frmEditGroup" name="frmEditGroup" action="../../../app/Controllers/GroupControllers.php?action=edit">
                       <div class="card-body">
                            <li class="list-Dates"><i class="fas fa-book mr-1" id="icon-iconos"></i>Horario</li>
                            <hr>
                            <input id="idSchedule" name="idSchedule"
                                   value="<?php echo $DataSc->getIdSchedule(); ?>" hidden
                                   required="required" type="text">
                            <!--Fecha de Inicio -->
                            <div class="form-group row">
                                <label for="startDateSchedule" class="col-sm-2 col-form-label">Fecha de Inicio </label>
                                <div class="col-sm-10">
                                    <input required type="date" max="<?= Carbon::now()->format('Y-m-d') ?>" class="form-control" id="startDateSchedule"
                                           name="startDateSchedule"
                                           value="<?php echo $DataSc->getStartDateSchedule()->toDateString(); ?>"
                                           placeholder="Fecha de Inicio ">
                                </div>
                            </div>
                            <!--Fecha de Fin-->
                            <div class="form-group row">
                                <label for="endDateSchedule" class="col-sm-2 col-form-label">Fecha de Finalizacion</label>
                                <div class="col-sm-10">
                                    <input required type="date" min="<?= Carbon::now()->format('Y-m-d') ?>" class="form-control" id="endDateSchedule"
                                           name="endDateSchedule"
                                           value="<?php echo $DataSc->getEndDateSchedule()->toDateString(); ?>"
                                           placeholder="Fecha de Finalizacion">
                                </div>
                            </div>
                            <!--Cantidad de Horas-->
                            <div class="form-group row">
                                <label for="cantHours" class="col-sm-2 col-form-label">Cant de Horas</label>
                                <div class="col-sm-10">
                                    <input required type="text" maxlength="4"class="form-control" id="cantHours"
                                           name="cantHours"
                                           value="<?php echo $DataSc->getCantHours(); ?>"
                                           placeholder="Cant de Horas">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="daySchedule" class="col-sm-2 col-form-label">Dias</label>
                                <div class="row">
                                    <div class="col">
                                        <table id="tblDays" class="datatable table table-bordered table-striped">
                                            <tr class="inputC">
                                                <!--Dias-->
                                                <?php
                                                $checked_arr = explode("|",$DataSc->getDaySchedule());
                                                $daysArray = array("Lu"=>"Lunes","Ma"=>"Martes","Mi"=>"Miércoles","Ju"=>"Jueves","Vi"=>"Viernes","Sa"=>"Sábado","Do"=>"Domingo");
                                                foreach($daysArray as $key=>$value) {
                                                    $checked = "";
                                                    if(in_array($key,$checked_arr)){
                                                        $checked = "checked";
                                                    }
                                                    echo '<td><input type="checkbox" name="dayS[]" value="'.$key.'" '.$checked.' > '.$value.' </td>';
                                                }

                                                ?>

                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--Hora de Inicio-->
                            <div class="form-group row">
                                <label for="startHourSchedule" class="col-sm-2 col-form-label">Hora</label>
                                <div class="col-sm-10">
                                    <input required type="time" class="form-control" id="startHourSchedule"
                                           name="startHourSchedule"
                                           value="<?php echo $DataSc->getStartHourSchedule()->toTimeString(); ?>"
                                           placeholder="Hora de Inicio">
                                </div>
                            </div>
                            <!--Hora de Fin-->
                            <div class="form-group row">
                                <label for="endHourSchedule" class="col-sm-2 col-form-label">Hora de Finalizacion</label>
                                <div class="col-sm-10">
                                    <input required type="time" class="form-control" id="endHourSchedule"
                                           name="endHourSchedule"
                                           value="<?php echo $DataSc->getEndHourSchedule()->toTimeString(); ?>"
                                           placeholder="Hora de Finalizacion">
                                </div>
                            </div>
                            <!--Estado-->
                            <div class="form-group row">
                                <label for="stateSchedule" class="col-sm-2 col-form-label">Estado</label>
                                <div class="col-sm-10">
                                    <select id="stateSchedule" name="stateSchedule" class="custom-select">
                                        <option <?= ($DataSc->getStateSchedule() == "Activo") ? "selected":""; ?> value="Activo">Activo</option>
                                        <option <?= ($DataSc->getStateSchedule() == "Inactivo") ? "selected":""; ?> value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
                            </div>
            <?php
            $dataGroup = \App\Models\Group::search("SELECT * FROM iteandes_novatik.Group WHERE Schedule_idSchedule =" .$_GET["idSchedule"]);
            foreach ($dataGroup as $group) {
                $DataG = \App\Controllers\GroupControllers::searchForID($group->getIdGroup());
            }
            if (!empty($DataG)) {
                ?>
                <li class="list-Dates"><i class ="fas fa-users" id="icon-iconos"></i>Grupo</li>
                <hr>
                <!--Codigo-->
                <div class="form-group row">
                    <label for="codeGroup" class="col-sm-2 col-form-label">Codigo</label>
                    <div class="col-sm-10">
                        <input required type="number" class="form-control" id="codeGroup" name="codeGroup" value="<?= $DataG->getCodeGroup(); ?>" placeholder="Ingrese el Codigo">
                    </div>
                </div>
                <!--Nombre-->
                <div class="form-group row">
                    <label for="nameGroup" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input required type="text" maxlength="300" class="form-control" id="nameGroup" name="nameGroup" value="<?= $DataG->getNameGroup(); ?>" placeholder="Ingrese el Nombre">
                    </div>
                </div>
                <!--Cupo Minimo-->
                <div class="form-group row">
                    <label for="minimumSpaceGroup" class="col-sm-2 col-form-label">Cupo Minimo</label>
                    <div class="col-sm-10">
                        <input required type="text" maxlength="2" class="form-control" id="minimumSpaceGroup" name="minimumSpaceGroup" value="<?= $DataG->getMinimumSpaceGroup(); ?>" placeholder="Ingrese el Cupo Minimo">
                    </div>
                </div>
                <!--Cupo Maximo-->
                <div class="form-group row">
                    <label for="maximumSpaceGroup" class="col-sm-2 col-form-label">Cupo Maximo</label>
                    <div class="col-sm-10">
                        <input required type="text" maxlength="2" class="form-control" id="maximumSpaceGroup" name="maximumSpaceGroup" value="<?= $DataG->getMaximumSpaceGroup(); ?>" placeholder="Ingrese el Cupo Maximo">
                    </div>
                </div>
                <!--Competencia Asociada-->
                <input id="TrainingCompetition_idTrainingCompetition" name="TrainingCompetition_idTrainingCompetition" value="<?php echo $DataG->getTrainingCompetitionIdTrainingCompetition()->getIdTrainingCompetition(); ?>" hidden required="required" type="text">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Competencia Asociada</label>
                    <div class="col-sm-10">
                        <input class="form-control"value="<?php echo $DataG->getTrainingCompetitionIdTrainingCompetition()->getDenomination(); ?>"
                               type="text"  readonly="readonly">
                    </div>
                </div>
                <!--Docente Asociada-->
                <input id="Teacher_idTeacher" name="Teacher_idTeacher" value="<?php echo $DataG->getTeacherIdTeacher()->getIdTeacher(); ?>" hidden required="required" type="text">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Docente Asociado</label>
                    <div class="col-sm-10">
                            <?= \App\Controllers\TeacherControllers::selectTeacher(false,
                                true,
                                'Teacher_idTeacher',
                                'Teacher_idTeacher',
                                (!empty($dataTeacher)) ? $dataTeacher->getTeacherIdTeacher()->getIdTeacher() : '',
                                'form-control select2bs4 select2-info',
                                " stateTeacher = 'Activo'")
                            ?>
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
<script src="../../components/Js/script.js"></script>
</body>
</html>