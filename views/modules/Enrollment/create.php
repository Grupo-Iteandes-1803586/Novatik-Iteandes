<?php require ("../../partials/routes.php");
require_once("../../../app/Controllers/EnrollmentControllers.php");
require_once("../../../app/Controllers/EnrollmentCompetitionControllers.php");
require_once("../../../app/Controllers/TrainingCompetitionControllers.php");
require_once("../../../app/Controllers/TrainingProgramController.php");
require_once("../../../app/Controllers/SemesterControllers.php");
require_once("../../../app/Models/Schedule.php");

use App\Controllers\EnrollmentControllers;
use App\Controllers\SemesterControllers;
use App\Controllers\TrainingCompetitionControllers;
use App\Controllers\TrainingProgramController;
use App\Controllers\EnrollmentCompetitionControllers;
use App\Models\Enrollment;
use App\Models\Schedule;
use App\Models\EnrollmentCompetition;
use Carbon\Carbon;?>

<!doctype html>
<html lang="es">
<head>
    <title><?=getenv('TITLE_SITE');?> | Agregar Matricula</title>
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
                        <h1>Crear Matricula</h1>
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
                        Error al crear la Matricula: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <!--Formulario de la Matricula-->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Agregar Matricula</h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="frmCreateEnrollment" name="frmCreateEnrollment" action="../../../app/Controllers/EnrollmentControllers.php?action=create">
                    <div class="card-body">
                        <?php
                        require ("../Person/formPerson.php"); ?>
                        <!--Formulario de los datos del estudio del estudiante-->
                        <div class="card-body">
                            <li class="list-Dates"><i class ="fas fa-address-book" id="icon-iconos"></i>Estudios</li>
                            <hr>
                            <!--Año de Grado-->
                            <div class="form-group row">
                                <label for="gradeYear" class="col-sm-2 col-form-label">Año de Grado</label>
                                <div class="col-sm-10">
                                    <input required type="text" maxlength="4" class="form-control" id="gradeYear" name="gradeYear" placeholder="Ingrese el año de grado">
                                </div>
                            </div>
                            <!--Modalidad de grado-->
                            <div class="form-group row">
                                <label for="modality" class="col-sm-2 col-form-label">Modalidad</label>
                                <div class="col-sm-10">
                                    <select id="modality" name="modality" class="custom-select">
                                        <option value="Bachiller Academico">Bachiller Academico</option>
                                        <option value="Bachiller Tecnico">Bachiller Tecnico</option>
                                    </select>
                                </div>
                            </div>
                            <!--Institucion de Grado-->
                            <div class="form-group row">
                                <label for="Institution" class="col-sm-2 col-form-label">Institucion Educativa</label>
                                <div class="col-sm-10">
                                    <input required type="text" maxlength="300" class="form-control" id="Institution" name="Institution" placeholder="Ingresa la Institucion Educativa">
                                </div>
                            </div>

                            <!--Datos de la Matricula-->
                            <!--Semestre-->
                            <?php
                            $dataSemester= null;
                            if (!empty($_GET['idSemester'])) {
                                $dataSemester = \App\Controllers\SemesterControllers::searchForID($_GET['idSemester']);
                            }
                            ?>
                            <div class="form-group row">
                                <label for="Semester_idSemester" class="col-sm-2 col-form-label">Semestre</label>
                                <div class="col-sm-10">
                                    <?= \App\Controllers\SemesterControllers::selectSemester(false,
                                        true,
                                        'Semester_idSemester',
                                        'Semester_idSemester',
                                        (!empty($dataSemester)) ? $dataSemester->getSemesterIdSemester()->getIdSemester() : '',
                                        'form-control select2bs4 select2-info',
                                        "statuSemester = 'Activo'")
                                    ?>
                                </div>
                            </div>
                            <!--Programa de Formacion-->
                            <?php
                            $dataProgram= null;
                            if (!empty($_GET['idTrainingProgram'])) {
                                $dataProgram = \App\Controllers\TrainingProgramController::searchForID($_GET['idTrainingProgram']);
                            }
                            ?>
                            <div class="form-group row">
                                <label for="TrainingProgram_idTrainingProgram" class="col-sm-2 col-form-label">Programa de Formacion</label>
                                <div class="col-sm-10">
                                    <?= \App\Controllers\TrainingProgramController::selectCompetition(false,
                                        true,
                                        'TrainingProgram_idTrainingProgram',
                                        'TrainingProgram_idTrainingProgram',
                                        (!empty($dataProgram)) ? $dataProgram->getTrainingProgramIdTrainingProgram()->getIdTrainingProgram() : '',
                                        'form-control select2bs4 select2-info',
                                        "statusTrainingProgram = 'Activo'")
                                    ?>
                                </div>
                            </div>
                            <?php
                            if(!empty($dataProgram)){
                                //Competencias
                            $query = "SELECT * FROM trainingcompetition tc INNER JOIN trainingprogram tp on tp.idTrainingProgram = tc.TrainingProgram_idTrainingProgram WHERE tp.idTrainingProgram=".$dataProgram;
                            $dataDates = \App\Models\EnrollmentCompetition::search($query);

                            foreach ($dataDates as $daDe) {
                                $DataCpm = \App\Controllers\EnrollmentCompetitionControllers::searchForID($daDe->getTrainingCompetitionIdTrainingCompetition()->getIdTrainingCompetition());
                                $idC = $DataCpm;
                            }
                            //Horario
                            $dataSche = \App\Models\schedule::search("SELECT * FROM schedule sh  INNER JOIN `group` gr on sh.Group_idGroup = gr.idGroup where gr.TrainingCompetition_idTrainingCompetition =".$idC);

                            foreach ($dataSche as $daSc) {
                                $daSch = \App\Controllers\EnrollmentCompetitionControllers::searchForID($daSc->getScheduleIdSchedule()->getIdSchedule());
                                $idS = $daSch;
                                var_dump('rg:',$idS);
                            }


                            }?>
                            <input id="TrainingCompetition_idTrainingCompetition" name="TrainingCompetition_idTrainingCompetition"
                                   value="<?php echo $idC; ?>" hidden required="required"
                                   type="text">
                            <input id="Schedule_idSchedule" name="Schedule_idSchedule"
                                   value="<?php echo $idS; ?>" hidden required="required"
                                   type="text">
                            <label><input id="TrainingCompetition_idTrainingCompetition" name="TrainingCompetition_idTrainingCompetition"
                                          value="<?php echo $idS; ?>"
                                          type="text"></label>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Enviar</button>
                        <a href="show.php" role="button" class="btn btn-default float-right">Cancelar</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </section>
    </div>
    <!-- /.content-wrapper -->
    <?php require ("../../partials/footer.php");?>
</div>
<!--</div>-->
<?php require ("../../partials/scripts.php");?>
<script src="../../components/Js/script.js"></script>
</body>
</html>