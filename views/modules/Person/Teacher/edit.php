<?php
require("../../../partials/routes.php");
require_once("../../../../app/Controllers/PersonController.php");
require_once("../../../../app/Controllers/TeacherControllers.php");
require_once("../../../../app/Models/Teacher.php");
require_once("../../../../app/Models/TeacherLenguages.php");
require_once("../../../../app/Controllers/TeacherStudiesControllers.php");
require_once("../../../../app/Controllers/TeacherLenguagesControllers.php");
require_once("../../../../app/Controllers/ExperienceControllers.php");
require_once("../../../../app/Controllers/LenguagesControllers.php");

use App\Controllers\PersonController;
use App\Controllers\TeacherControllers;
use App\Models\Teacher;
use App\Models\TeacherLenguages;
use App\Controllers\TeacherStudiesControllers;
use App\Controllers\TeacherLenguagesControllers;
use App\Controllers\ExperienceControllers;
use App\Controllers\LenguagesControllers;
use Carbon\Carbon;?>
<!doctype html>
<html lang="es">
<head>
    <title><?= getenv('TITLE_SITE');?>| Editar Docente</title>
    <?php
    require ("../../../partials/head_imports.php");
    require ("../../../partials/header.php");
    ?>
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require ("../../../partials/navbar_customation.php");?>
    <?php require ("../../../partials/sliderbar_main_menu.php");?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Editar Docente</h1>
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
                        Error al crear el usuario: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['idPerson'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Docente</h3>
                    <?php require("../../../partials/optionMenu.php") ;?>
                </div>
                <!-- /.card-header -->
                <?php if(!empty($_GET["idPerson"]) && isset($_GET["idPerson"])){ ?>
                    <p>
                    <?php
                    $DataPersonT= \App\Controllers\PersonController::searchForID($_GET["idPerson"]);
                    if(!empty($DataPersonT)){
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="frmEditPersonT" name="frmEditPersonT"
                              action="../../../../app/Controllers/PersonController.php?action=edit">
                            <input id="idPerson" name="idPerson" value="<?php echo $DataPersonT->getIdPerson(); ?>" hidden
                                   required="required" type="text">
                            <div class="card-body">
                                <!--Datos Basicos-->
                                <li class="list-Dates"><i class="fas fa-edit" id="icon-iconos"></i>Datos Basicos</li>
                                <hr>
                                <!--Documento del Docente-->
                                <div class="form-group row">
                                    <label for="documentPerson" class="col-sm-2 col-form-label">Documento</label>
                                    <div class="col-sm-10">
                                        <input required type="text" minlength="6" maxlength="11" class="form-control"
                                               id="documentPerson" name="documentPerson"
                                               value="<?= $DataPersonT->getDocumentPerson(); ?>"
                                               placeholder="Ingrese su documento">
                                    </div>
                                </div>
                                <!--Nombre del docente-->
                                <div class="form-group row">
                                    <label for="namePerson" class="col-sm-2 col-form-label">Nombre</label>
                                    <div class="col-sm-10">
                                        <input required type="text" maxlength="130" class="form-control" id="namePerson" name="namePerson"
                                               value="<?= $DataPersonT->getNamePerson(); ?>" placeholder="Ingresa los nombres">
                                    </div>
                                </div>
                                <!--Apellidos del docente-->
                                <div class="form-group row">
                                    <label for="lastNamePerson" class="col-sm-2 col-form-label">Apellidos</label>
                                    <div class="col-sm-10">
                                        <input required type="text" maxlength="130" class="form-control" id="lastNamePerson"
                                               name="lastNamePerson" value="<?= $DataPersonT->getLastNamePerson(); ?>"
                                               placeholder="Ingresa los Apellidos">
                                    </div>
                                </div>
                                <!--RH del docente-->
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
                                <!--Telefono del Docente-->
                                <div class="form-group row">
                                    <label for="phonePerson" class="col-sm-2 col-form-label">Telefono</label>
                                    <div class="col-sm-10">
                                        <input required type="text" minlength="6" maxlength="10" class="form-control"
                                               id="phonePerson" name="phonePerson"
                                               value="<?= $DataPersonT->getPhonePerson(); ?>" placeholder="Ingrese su telefono">
                                    </div>
                                </div>
                                <!--Direccion del Docente-->
                                <div class="form-group row">
                                    <label for="adressPerson" class="col-sm-2 col-form-label">Direccion</label>
                                    <div class="col-sm-10">
                                        <input required type="text" maxlength="250" class="form-control" id="adressPerson" name="adressPerson"
                                               value="<?= $DataPersonT->getAdressPerson(); ?>"
                                               placeholder="Ingrese su direccion">
                                    </div>
                                </div>
                                <!--Fecha de nacimiento del Docente-->
                                <div class="form-group row">
                                    <label for="dateBornPerson" class="col-sm-2 col-form-label">Fecha de Nacimiento</label>
                                    <div class="col-sm-10">
                                        <input required type="date" max="<?= Carbon::now()->subYear(12)->format('Y-m-d') ?>" class="form-control" id="dateBornPerson"
                                               name="dateBornPerson" value="<?= $DataPersonT->getDateBornPerson()->toDateString(); ?>"
                                               placeholder="Ingrese su Fecha de Nacimiento">
                                    </div>
                                </div>
                                <!--Correo Electronico del Docente-->
                                <div class="form-group row">
                                    <label for="emailPerson" class="col-sm-2 col-form-label">Correo Electronico</label>
                                    <div class="col-sm-10">
                                        <input required type="email" maxlength="90"class="form-control" id="emailPerson" name="emailPerson"
                                               value="<?= $DataPersonT->getEmailPerson(); ?>"
                                               placeholder="Ingrese su Correo Electronico">
                                    </div>
                                </div>
                                <!--Genero del Docente-->
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
                                <!--Correo Electronico del Docente-->
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
                                               value="<?= $DataPersonT->getTypePerson(); ?>" placeholder="Tipo Persona" readonly="readonly">
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
                                <!-- _______________________________Experiencia________________________-->
                                <?php
                                $dataTeacher = Teacher::search("SELECT * FROM teacher WHERE Person_idPerson =" . $_GET["idPerson"]);
                                foreach ($dataTeacher as $teacherD) {
                                    $DataExperience = \App\Controllers\ExperienceControllers::searchForID($teacherD->getExperienceIdExperience()->getIdExperience());
                                    $idT = $teacherD->getIdTeacher();
                                }
                                if (!empty($DataExperience)) {
                                    ?>
                                    <li class="list-Dates"><i class="fas fa-id-badge " id="icon-iconos"></i>Experiencia</li>
                                    <hr>
                                    <input id="idTeacher" name="idTeacher"
                                           value="<?php echo $idT; ?>" hidden required="required"
                                           type="text">
                                    <!--DataTeacher-->
                                    <input id="idExperience" name="idExperience"
                                           value="<?php echo $DataExperience->getIdExperience(); ?>" hidden required="required"
                                           type="text">
                                    <!--Ultimo Lugar de Trabajo-->
                                    <div class="form-group row">
                                        <label for="institutionExperience" class="col-sm-2 col-form-label">Ultimo Lugar de
                                            Trabajo</label>
                                        <div class="col-sm-10">
                                            <input required type="text" maxlength="280" class="form-control" id="institutionExperience"
                                                   name="institutionExperience"
                                                   value="<?php echo $DataExperience->getInstitutionExperience(); ?>"
                                                   placeholder="Ultimo Lugar de Trabajo">
                                        </div>
                                    </div>
                                    <!--Ocupacion Laboral-->
                                    <div class="form-group row">
                                        <label for="dedicationExperience" maxlength="280" class="col-sm-2 col-form-label">Ocupacion
                                            Laboral</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control" id="dedicationExperience"
                                                   name="dedicationExperience"
                                                   value="<?php echo $DataExperience->getDedicationExperience(); ?>"
                                                   placeholder="Ocupacion Laboral">
                                        </div>
                                    </div>

                                    <!--Fecha de Inicio de Contrato-->
                                    <div class="form-group row">
                                        <label for="startExperience" class="col-sm-2 col-form-label">Fecha de Inicio de
                                            Contrato</label>
                                        <div class="col-sm-10">
                                            <input required type="date" max="<?= Carbon::now()->format('Y-m-d') ?>" class="form-control" id="startExperience"
                                                   name="startExperience"
                                                   value="<?php echo $DataExperience->getStartExperience()->toDateString(); ?>"
                                                   placeholder="Fecha de Inicio de Contrato">
                                        </div>
                                    </div>
                                    <!--Fecha de Determinacion  de Contrato-->
                                    <div class="form-group row">
                                        <label for="endExperince" class="col-sm-2 col-form-label">Fecha de Determinacion</label>
                                        <div class="col-sm-10">
                                            <input required type="date" max="<?= Carbon::now()->format('Y-m-d') ?>" class="form-control" id="endExperince"
                                                   name="endExperince" value="<?php echo $DataExperience->getEndExperince()->toDateString(); ?>"
                                                   placeholder="Fecha de Determinacion">
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- _____________________Datos de Estudio___________________________________________-->

                                <?php
                                $dataTeacher = Teacher::search("SELECT * FROM teacher WHERE Person_idPerson =" . $_GET["idPerson"]);
                                foreach ($dataTeacher as $teacherD) {
                                    $DataTeacherS = \App\Controllers\TeacherStudiesControllers::searchForID($teacherD->getTeacherStudiesIdTeacherStudies()->getIdTeacherStudies());
                                }
                                if (!empty($DataTeacherS)) {
                                    ?>
                                    <li class="list-Dates"><i class="fas fa-user-graduate" id="icon-iconos"></i>Datos de Estudio
                                    </li>
                                    <hr>
                                    <input id="idTeacherStudies" name="idTeacherStudies"
                                           value="<?php echo $DataTeacherS->getIdTeacherStudies(); ?>" hidden
                                           required="required" type="text">
                                    <!--Titulo Universitario-->
                                    <div class="form-group row">
                                        <label for="titleTeacherStudies" class="col-sm-2 col-form-label">Titulo
                                            Universitario</label>
                                        <div class="col-sm-10">
                                            <input required type="text" minlength="6"  maxlength="290" class="form-control"
                                                   id="titleTeacherStudies" name="titleTeacherStudies"
                                                   value="<?php echo $DataTeacherS->getTitleTeacherStudies(); ?>"
                                                   placeholder="Titulo Universitario">
                                        </div>
                                    </div>

                                    <!--Año de Graduacion-->
                                    <div class="form-group row">
                                        <label for="yearStudyTeacher" class="col-sm-2 col-form-label">Año de Graduacion</label>
                                        <div class="col-sm-10">
                                            <input required type="text"  maxlength="4" class="form-control" id="yearStudyTeacher"
                                                   name="yearStudyTeacher"
                                                   value="<?php echo $DataTeacherS->getYearStudyTeacher(); ?>"
                                                   placeholder="Año de Graduacion">
                                        </div>
                                    </div>

                                <?php } ?>
                                <!-- _________________________________Idiomas_________________________-->
                                <?php
                                $DataT = Teacher::search("SELECT * FROM teacher WHERE Person_idPerson =" .$_GET["idPerson"]);
                                $teacher=$DataT[0];
                                $DataTeacherleng = TeacherLenguages::search("SELECT * FROM TeacherLenguages WHERE Teacher_idTeacher =" .$teacher->getIdTeacher());
                                foreach ($DataTeacherleng as $teacherLen){
                                    $lenguajes = $teacherLen->getLenguagesIdLenguages();
                                    $idTeachLen = $teacherLen->getIdTeacherLenguages();
                                    $DataLenguagues = \App\Controllers\LenguagesControllers::searchForID($lenguajes->getIdLenguages());
                                }
                                if(!empty($DataLenguagues)){?>

                                    <li class="list-Dates"><i class ="fas fa-address-book" id="icon-iconos"></i>Idiomas</li>
                                    <hr>
                                    <input id="idLenguages" name="idLenguages" value="<?php echo $DataLenguagues->getIdLenguages(); ?>" hidden required="required" type="text">
                                    <!--Idiomas-->
                                    <!--Nombre del idioma-->
                                    <div class="form-group row">
                                        <label for="nameLenguages" class="col-sm-2 col-form-label">Idioma</label>
                                        <div class="col-sm-10">
                                            <input id="idTeacherLenguages" name="idTeacherLenguages"
                                                   value="<?php echo $idTeachLen; ?>" hidden
                                                   required="required" type="text">
                                            <input required type="text" minlength="6" maxlength="40" class="form-control"
                                                   id="nameLenguages" name="nameLenguages"
                                                   value="<?php echo $DataLenguagues->getNameLenguages(); ?>"
                                                   placeholder="Idioma">
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

    <?php require ('../../../partials/footer.php');?>
</div>
<!-- ./wrapper -->
<?php require ('../../../partials/scripts.php');?>
<script src="../../../components/Js/script.js"></script>
</body>
</html>