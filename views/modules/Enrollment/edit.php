<?php
require("../../partials/routes.php");
require_once("../../../app/Controllers/EnrollmentControllers.php");
require_once("../../../app/Controllers/TrainingCompetitionControllers.php");
require_once("../../../app/Controllers/StudentControllers.php");
require_once("../../../app/Controllers/PersonController.php");
use App\Controllers\StudentControllers;
use App\Controllers\PersonController;
use App\Controllers\TrainingProgramController;
use App\Controllers\TrainingCompetitionControllers;
use Carbon\Carbon;
?>
<html lang="es">
<head>
    <title><?= getenv('TITLE_SITE')?> | Editar Matricula</title>
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
                        <h1>Editar Matricula</h1>
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
                        Error al crear la Matricula: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['idEnrollment'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Editar Matricula</h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <!-- /.card-header -->
                <?php if(!empty($_GET["idEnrollment"]) && isset($_GET["idEnrollment"])){ ?>
                    <p>
                    <?php
                    $dataP = \App\Models\Person::search("SELECT * FROM person p INNER JOIN Student st on st.Person_idPerson = p.idPerson INNER JOIN enrollment en on st.idStudent = en.Student_idStudent WHERE en.idEnrollment =" .$_GET["idEnrollment"]);
                    foreach ($dataP as $person) {
                        $DataPersonT =  \App\Controllers\PersonController::searchForID($person->getIdPerson());
                    }
                    if(!empty($DataPersonT)){
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="frmEditPersonE" name="frmEditPersonE"
                              action="../../../../app/Controllers/PersonController.php?action=editStudent">
                            <input id="idPerson" name="idPerson" value="<?php echo $DataPersonT->getIdPerson(); ?>" hidden
                                   required="required" type="text">
                            <div class="card-body">
                                <!--Datos Basicos-->
                                <li class="list-Dates"><i class="fas fa-address-book" id="icon-iconos"></i>Datos Basicos</li>
                                <hr>
                                <!--Documento del Estudiante-->
                                <div class="form-group row">
                                    <label for="documentPerson" class="col-sm-2 col-form-label">Documento</label>
                                    <div class="col-sm-10">
                                        <input required type="number" minlength="6" maxlength="11" class="form-control"
                                               id="documentPerson" name="documentPerson"
                                               value="<?= $DataPersonT->getDocumentPerson(); ?>"
                                               placeholder="Ingrese su documento">
                                    </div>
                                </div>
                                <!--Nombre del Estudiante-->
                                <div class="form-group row">
                                    <label for="namePerson" class="col-sm-2 col-form-label">Nombres</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="namePerson" name="namePerson"
                                               value="<?= $DataPersonT->getNamePerson(); ?>" placeholder="Ingresa los nombres">
                                    </div>
                                </div>
                                <!--Apellidos del Estudiante-->
                                <div class="form-group row">
                                    <label for="lastNamePerson" class="col-sm-2 col-form-label">Apellidos</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="lastNamePerson"
                                               name="lastNamePerson" value="<?= $DataPersonT->getLastNamePerson(); ?>"
                                               placeholder="Ingresa los Apellidos">
                                    </div>
                                </div>
                                <!--RH del Estudiante-->
                                <div class="form-group row">
                                    <label for="rhPerson" class=" col-sm-2 col-form-label">RH</label>
                                    <div class="col-sm-10">
                                        <select id="rhPerson" name="rhPerson" class="custom-select">
                                            <option <?= ($DataPersonT->getRhPerson() == "A+") ? "selected" : ""; ?>
                                                    value="A+">A+
                                            </option>
                                            <option <?= ($DataPersonT->getRhPerson() == "A-") ? "selected" : ""; ?>
                                                    value="A-">A-
                                            </option>
                                            <option <?= ($DataPersonT->getRhPerson() == "B+") ? "selected" : ""; ?>
                                                    value="B+">B+
                                            </option>
                                            <option <?= ($DataPersonT->getRhPerson() == "B-") ? "selected" : ""; ?>
                                                    value="B-">B-
                                            </option>
                                            <option <?= ($DataPersonT->getRhPerson() == "O+") ? "selected" : ""; ?>
                                                    value="O+">O+
                                            </option>
                                            <option <?= ($DataPersonT->getRhPerson() == "O-") ? "selected" : ""; ?>
                                                    value="O-">O-
                                            </option>
                                            <option <?= ($DataPersonT->getRhPerson() == "AB+") ? "selected" : ""; ?>
                                                    value="AB+">AB+
                                            </option>
                                            <option <?= ($DataPersonT->getRhPerson() == "AB-") ? "selected" : ""; ?>
                                                    value="AB-">AB-
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <!--Telefono del Estudiante-->
                                <div class="form-group row">
                                    <label for="phonePerson" class="col-sm-2 col-form-label">Telefono</label>
                                    <div class="col-sm-10">
                                        <input required type="number" minlength="6" maxlength="11" class="form-control"
                                               id="phonePerson" name="phonePerson"
                                               value="<?= $DataPersonT->getPhonePerson(); ?>" placeholder="Ingrese su telefono">
                                    </div>
                                </div>
                                <!--Direccion del Estudiante-->
                                <div class="form-group row">
                                    <label for="adressPerson" class="col-sm-2 col-form-label">Direccion</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="adressPerson" name="adressPerson"
                                               value="<?= $DataPersonT->getAdressPerson(); ?>"
                                               placeholder="Ingrese su direccion">
                                    </div>
                                </div>
                                <!--Fecha de nacimiento del Estudiante-->
                                <div class="form-group row">
                                    <label for="dateBornPerson" class="col-sm-2 col-form-label">Fecha de Nacimiento</label>
                                    <div class="col-sm-10">
                                        <input required type="date" max="<?= Carbon::now()->subYear(12)->format('Y-m-d') ?>"  class="form-control" id="dateBornPerson"
                                               name="dateBornPerson" value="<?= $DataPersonT->getDateBornPerson()->toDateString(); ?>"
                                               placeholder="Ingrese su Fecha de Nacimiento">
                                    </div>
                                </div>
                                <!--Correo Electronico del Estudiante-->
                                <div class="form-group row">
                                    <label for="emailPerson" class="col-sm-2 col-form-label">Correo Electronico</label>
                                    <div class="col-sm-10">
                                        <input required type="email" class="form-control" id="emailPerson" name="emailPerson"
                                               value="<?= $DataPersonT->getEmailPerson(); ?>"
                                               placeholder="Ingrese su Correo Electronico">
                                    </div>
                                </div>
                                <!--Genero del Estudiante-->
                                <div class="form-group row">
                                    <label for="generePerson" class=" col-sm-2 col-form-label">Genero</label>
                                    <div class="col-sm-10">
                                        <select id="generePerson" name="generePerson" class="custom-select">
                                            <option <?= ($DataPersonT->getGenerePerson() == "Masculino") ? "selected" : ""; ?>
                                                    value="Masculino">Masculino
                                            </option>
                                            <option <?= ($DataPersonT->getGenerePerson() == "Femenino") ? "selected" : ""; ?>
                                                    value="Femenino">Femenino
                                            </option>
                                            <option <?= ($DataPersonT->getGenerePerson() == "Otro") ? "selected" : ""; ?>
                                                    value="Otro">Otro
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <!--Correo Electronico del Estudiante-->
                                <div class="form-group row">
                                    <label for="photoPerson" class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="photoPerson" name="photoPerson"
                                               value="<?= $DataPersonT->getPhotoPerson(); ?>" placeholder="Ingrese su Foto">
                                    </div>
                                </div>
                                <!--Tipo Persona-->
                                <div class="form-group row">
                                    <label for="typePerson" class="col-sm-2 col-form-label">Tipo</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="typePerson" name="typePerson"
                                               value="<?= $DataPersonT->getTypePerson(); ?>" placeholder="Tipo Persona">
                                    </div>
                                </div>
                                <!--Estado de la persona-->
                                <div class="form-group row">
                                    <label for="statePerson" class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-10">
                                        <select id="statePerson" name="statePerson" class="custom-select">
                                            <option <?= ($DataPersonT->getStatePerson() == "Activo") ? "selected" : ""; ?>
                                                    value="Activo">Activo
                                            </option>
                                            <option <?= ($DataPersonT->getStatePerson() == "Inactivo") ? "selected" : ""; ?>
                                                    value="Inactivo">Inactivo
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <!-- _______________________________Estudios________________________-->
                                <?php
                                if(!empty($_GET["idEnrollment"])){
                                    $dataStu = \App\Models\Student::search("SELECT * FROM student st INNER JOIN enrollment en on st.idStudent = en.Student_idStudent where en.idEnrollment=".$_GET["idEnrollment"]);
                                    foreach ($dataStu as $studentD) {
                                        $DataStudent =  \App\Controllers\StudentControllers::searchForID($studentD->getIdStudent());
                                    }
                                    if(!empty($DataStudent)){   ?>
                                        <!--Formulario de los datos del estudio del estudiante-->
                                        <li class="list-Dates"><i class ="fas fa-address-book" id="icon-iconos"></i>Estudios</li>
                                        <hr>
                                        <input id="idStudent" name="idStudent" value="<?php echo $DataStudent->getIdStudent(); ?>" hidden
                                               required="required" type="text">
                                        <!--Año de Grado-->
                                        <div class="form-group row">
                                            <input id="idStudent" name="idStudent" value="<?php echo $DataStudent->getIdStudent(); ?>" hidden
                                                   required="required" type="text">
                                            <label for="gradeYear" class="col-sm-2 col-form-label">Año de Grado</label>
                                            <div class="col-sm-10">
                                                <input required type="text" class="form-control" id="gradeYear" name="gradeYear"
                                                       value="<?= $DataStudent->getGradeYear(); ?>" placeholder="Año de Graduacion">
                                            </div>
                                        </div>
                                        <!--Modalidad de grado-->
                                        <div class="form-group row">
                                            <label for="modality" class="col-sm-2 col-form-label">Modalidad</label>
                                            <div class="col-sm-10">
                                                <select id="modality" name="modality" class="custom-select">
                                                    <option <?= ($DataStudent->getModality() == "Bachiller Academico") ? "selected" : ""; ?>
                                                            value="Bachiller Academico">Bachiller Academico
                                                    </option>
                                                    <option <?= ($DataStudent->getModality() == "Bachiller Tecnico") ? "selected" : ""; ?>
                                                            value="Bachiller Tecnico">Bachiller Tecnico
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--Institucion de Grado-->
                                        <div class="form-group row">
                                            <label for="Institution" class="col-sm-2 col-form-label">Institucion Educativa</label>
                                            <div class="col-sm-10">
                                                <input required type="text" class="form-control" id="Institution" name="Institution"
                                                       value="<?= $DataStudent->getInstitution(); ?>" placeholder="Institucion Educativa">
                                            </div>
                                        </div>
                                    <?php }
                                }?>
                                <!--Matricula-->
                                <?php if(!empty($_GET["idEnrollment"])){
                                    $dataE = \App\Models\Enrollment::search("SELECT * FROM enrollment en where en.idEnrollment =" .$_GET["idEnrollment"]);
                                    foreach ($dataE as $enrollment) {
                                        $DataEnrollment=  \App\Controllers\EnrollmentControllers::searchForID($enrollment->getIdEnrollment());
                                    }
                                    if(!empty($DataEnrollment)){?>
                                        <!--Formulario de la Matricula-->
                                        <li class="list-Dates"><i class ="fas fa-address-book" id="icon-iconos"></i>Matricula</li>
                                        <hr>
                                        <input id="idEnrollment" name="idEnrollment" value="<?php echo $DataEnrollment->getIdEnrollment(); ?>" hidden
                                               required="required" type="text">
                                        <!--Fecha de Matricula-->
                                        <div class="form-group row">
                                            <input id="dateEnrollment" name="dateEnrollment" value="<?php echo $DataEnrollment->getDateEnrollment(); ?>" hidden
                                                   required="required" type="text">
                                            <label class="col-sm-2 col-form-label">Fecha de Matricula</label>
                                            <div class="col-sm-10">
                                                <input required type="text" class="form-control" id="gradeYear" name="gradeYear"
                                                       value="<?= $DataEnrollment->getDateEnrollment()->toDateString(); ?>" readonly="readonly">
                                            </div>
                                        </div>
                                        <!--Semestre-->
                                        <div class="form-group row">
                                            <input id="Semester_idSemester" name="Semester_idSemester" value="<?php echo $DataEnrollment->getSemesterIdSemester(); ?>" hidden
                                                   required="required" type="text">
                                            <label class="col-sm-2 col-form-label">Semestre</label>
                                            <div class="col-sm-10">
                                                <input required type="text" class="form-control" id="gradeYear" name="gradeYear"
                                                       value="<?= $DataEnrollment->getSemesterIdSemester()->getNameSemester(); ?>" readonly="readonly">
                                            </div>
                                        </div>
                                        <!--Programa de Formacion-->
                                        <div class="form-group row">
                                            <input id="TrainingProgram_idTrainingProgram" name="TrainingProgram_idTrainingProgram" value="<?php echo $DataEnrollment->getTrainingProgramIdTrainingProgram(); ?>" hidden
                                                   required="required" type="text">
                                            <label class="col-sm-2 col-form-label">Programa de Formacion</label>
                                            <div class="col-sm-10">
                                                <input required type="text" class="form-control" id="gradeYear" name="gradeYear"
                                                       value="<?= $DataEnrollment->getTrainingProgramIdTrainingProgram()->getNameTrainingProgram(); ?>" readonly="readonly">
                                            </div>
                                        </div>
                                    <?php }
                                }?>
                                <!--Matricula Competencia-->
                                <?php
                                $dataDates = \App\Models\EnrollmentCompetition::search("SELECT * FROM trainingcompetition tc INNER JOIN trainingprogram tp on tc.TrainingProgram_idTrainingProgram = tp.idTrainingProgram INNER JOIN enrollmentcompetition ec on tc.idTrainingCompetition = ec.TrainingCompetition_idTrainingCompetition INNER JOIN enrollment e on ec.Enrollment_idEnrollment = e.idEnrollment where e.idEnrollment=".$_GET['idEnrollment']);
                                foreach ($dataDates as $daDe) {
                                    $DataCpm = \App\Controllers\EnrollmentCompetitionControllers::searchForID($daDe->getTrainingCompetitionIdTrainingCompetition()->getIdTrainingCompetition());
                                    $idC = $DataCpm;
                                }
                                //Horario
                                $dataSche = \App\Models\EnrollmentCompetition::search("SELECT * FROM schedule sh  INNER JOIN `group` gr on sh.Group_idGroup = gr.idGroup where gr.TrainingCompetition_idTrainingCompetition =".$idC);
                                foreach ($dataSche as $daSc) {
                                    $daSch = \App\Controllers\EnrollmentCompetitionControllers::searchForID($daSc->getScheduleIdSchedule()->getIdSchedule());
                                    $idS = $daDe->getScheduleIdSchedule();
                                }
                                //EnrollmentCompetition
                                $dataSche = \App\Models\EnrollmentCompetition::search("SELECT * FROM EnrollmentCompetition ec INNER JOIN enrollment e on ec.Enrollment_idEnrollment = e.idEnrollment where e.idEnrollment ".$_GET['idEnrollment']);
                                foreach ($dataSche as $daSc) {
                                    $daSch = \App\Controllers\EnrollmentCompetitionControllers::searchForID($daSc->getScheduleIdSchedule()->getIdSchedule());
                                    $idS = $daDe->getScheduleIdSchedule();
                                }
                                ?>
                                <input id="idEnrollmentCompetition" name="idEnrollmentCompetition"
                                       value="<?php echo $idC; ?>" hidden required="required"
                                       type="text">
                                <input id="TrainingCompetition_idTrainingCompetition" name="TrainingCompetition_idTrainingCompetition"
                                       value="<?php echo $idC; ?>" hidden required="required"
                                       type="text">
                                <input id="Schedule_idSchedule" name="Schedule_idSchedule"
                                       value="<?php echo $idS; ?>" hidden required="required"
                                       type="text">
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