<?php
require("../../partials/routes.php");
require_once("../../../app/Controllers/PersonController.php");
require_once("../../../app/Controllers/EnrollmentControllers.php");
require_once("../../../app/Controllers/EnrollmentCompetitionControllers.php");
require_once("../../../app/Controllers/StudentControllers.php");
require_once("../../../app/Controllers/TrainingCompetitionControllers.php");
require_once("../../../app/Controllers/TrainingProgramController.php");
require_once("../../../app/Controllers/SemesterControllers.php");
require_once("../../../app/Models/Person.php");
require_once("../../../app/Models/Enrollment.php");
require_once("../../../app/Models/EnrollmentCompetition.php");
require_once("../../../app/Models/Student.php");

use App\Controllers\PersonController;
use App\Controllers\EnrollmentCompetitionControllers;
use App\Controllers\EnrollmentControllers;
use App\Controllers\StudentControllers;
use App\Models\Person;
use App\Models\Enrollment;
use App\Models\EnrollmentCompetition;
use App\Models\Student;
?>

<!doctype html>
<html lang="en">
<head>
    <title><?= getenv('TITLE_SITE') ?> | Agregar Matricula </title>
    <?php require ("../../partials/head_imports.php");
    require ("../../partials/header.php");?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-responsive/css/responsive.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-buttons/css/buttons.bootstrap4.css">
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require ("../../partials/navbar_customation.php");?>
    <?php require ("../../partials/sliderbar_main_menu.php");?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <?php if (!empty($_GET['respuesta'])) { ?>
            <?php if ($_GET['respuesta'] != "correcto") { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Error al agregar la Matricula al estudiante: <?= $_GET['mensaje'] ?>
                </div>
            <?php } ?>
        <?php } ?>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Agregar una Nueva Matricula</h1>
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

        <section class="content">
            <div class="container-fluid">
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-id-card"></i>  Información del Estudiante</h3>
                                <?php require("../../partials/optionMenu.php") ;?>
                            </div>

                            <div class="card-body">
                                <?php
                                $dataEstudentE = null;
                                if (!empty($_GET['idStudent'])) {
                                    $idP= $_GET['idStudent'];
                                    $DataPerson = Person::search("select * from person p inner join student s on p.idPerson  = s.Person_idPerson where s.idStudent = " .$idP);
                                    foreach ($DataPerson as $person){
                                        $person = \App\Controllers\PersonController::searchForID($person->getIdPerson());
                                    }
                                }
                                ?>
                                <!--Datos de Estudiante Asociado-->
                                <div class="form-group row">
                                    <!--Codigo del Estudiante-->
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Documento</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" value="<?php echo $person->getDocumentPerson(); ?>"
                                                   type="text"  readonly="readonly">
                                        </div>
                                    </div>
                                    <!--Nombre del Estudiante-->
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Estudiante</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" value="<?php echo $person->getNamePerson() ; ?>"
                                                   type="text"  readonly="readonly">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card card-lightblue">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-file-signature"></i> Detalles de La Matricula </h3>
                                <?php require("../../partials/optionMenu.php") ;?>
                            </div>
                            <!--Datos de la matricula-->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <?php $idP= $_GET['idStudent'];?>
                                        <a role="button" href="index.php?idEnrollment=<?= $idP;?>" class="btn btn-primary float-right"
                                           style="margin-right: 5px;">
                                            <i class="fas fa-eye"></i> Ver Matricula
                                        </a>
                                    </div>
                                    <div class="col-auto">
                                            <a role="button" href="#" data-toggle="modal" data-target="#modal-add-EnrollmentEstudent"
                                               class="btn btn-primary float-right"
                                               style="margin-right: 5px;">
                                            <i class="fas fa-plus"></i> Añadir Matricula
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table id="tblEnrollmentEstudent" class="datatable table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Fecha de Matricula</th>
                                                <th>Nombre del Estudiante</th>
                                                <th>Semestre</th>
                                                <th>Programa de Formacion</th>
                                                <th>Estado</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $idP = $_GET['idStudent'];
                                            $arrEnrollmentEstudent = \App\Models\Enrollment::search("SELECT * FROM Enrollment where Student_idStudent =".$idP);
                                            foreach ($arrEnrollmentEstudent as $enrEstudent){
                                                ?>
                                                <tr>
                                                    <td><?php echo $enrEstudent->getIdEnrollment(); ?></td>
                                                    <td><?php echo $enrEstudent->getDateEnrollment(); ?></td>
                                                    <td><?php echo $enrEstudent->getStudentIdStudent()->getPersonIdPerson()->getNamePerson(); ?></td>
                                                    <td><?php echo $enrEstudent->getSemesterIdSemester()->getNameSemester(); ?></td>
                                                    <td><?php echo $enrEstudent->getTrainingProgramIdTrainingProgram()->getNameTrainingProgram(); ?></td>
                                                    <td><?php echo $enrEstudent->getStateEnrollment(); ?></td>
                                                </tr>
                                            <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
            </div>
        </section>

    </div>
    <div id="modals">
        <div class="modal fade" id="modal-add-EnrollmentEstudent">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Nueva Matricula</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../../../app/Controllers/EnrollmentControllers.php?action=createEstu" method="post">
                        <div class="modal-body">
                            <input id="idEnrollment" name="idEnrollment" value="<?= !empty($enrEstudent) ? $enrEstudent->getIdEnrollment() : ''; ?>" hidden
                                   required="required" type="text">

                            <?php
                            $idTP= $_GET["idStudent"];?>
                            <input id="Student_idStudent" name="Student_idStudent"
                                   value="<?php echo $idTP; ?>" hidden required="required"
                                   type="text">
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
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" href="createNew.php?idStudent=<?= $idTP?>" class="btn btn-primary"></i> Agregar</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>

    <?php require('../../partials/footer.php'); ?>

</div>
<!-- ./wrapper -->
<?php require('../../partials/scripts.php'); ?>
<script src="../../components/Js/script.js"></script>

</body>
</html>

