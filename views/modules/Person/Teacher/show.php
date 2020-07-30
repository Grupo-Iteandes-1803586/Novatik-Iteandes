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
use App\Controllers\LenguagesControllers; ?>

<!doctype html>
<html lang="es">
    <head>
        <title><?= getenv('TITLE_SITE');?> | Consultar Docente</title>
        <?php require ("../../../partials/head_imports.php");?>
        <?php require("../../../partials/header.php");?>
    </head>
<body class="hold-transition sidebar-mini">

    <!-- Site wrapper -->
<div class="wrapper">

    <?php require ("../../../partials/navbar_customation.php");?>
    <?php require ("../../../partials/sliderbar_main_menu.php")?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Informacion del Docente</h1>
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
                        Error al consultar el usuario: <?= ($_GET['mensaje']) ?? "" ?>
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
                <?php if(!empty($_GET["idPerson"]) && isset($_GET["idPerson"])){
                    $DataPerson = PersonController::searchForID($_GET["idPerson"]);
                    if(!empty($DataPerson)){
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?= $DataPerson->getNamePerson()  ?></h3>
                            <?php require("../../../partials/optionMenu.php") ;?>
                        </div>
                        <div class="card-body">
                            <p>
                                <strong><i class="fas fa-book mr-1"></i> Nombres y Apellidos</strong>
                            <p class="text-muted">
                                <?= $DataPerson->getNamePerson() ." - ".$DataPerson->getLastNamePerson()?>
                            </p>
                            <hr>
                            <strong><i class="fas fa-user mr-1"></i> Documento</strong>
                                <p class="text-muted"><?=$DataPerson->getDocumentPerson() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Rh</strong>
                                <p class="text-muted"><?= $DataPerson->getRhPerson(); ?></p>
                            <hr>
                            <strong><i class="fas fa-phone mr-1"></i> Direccion</strong>
                                <p class="text-muted"><?= $DataPerson->getAdressPerson() ;?></p>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Estado y Rol</strong>
                                <p class="text-muted"><?= $DataPerson->getStatePerson()." - ".$DataPerson->getTypePerson() ?></p>
                            <hr>
                            <strong><i class="fas fa-phone mr-1"></i> Email</strong>
                                <p class="text-muted"><?= $DataPerson->getEmailPerson(); ?></p>
                            <hr>
                            <strong><i class="fas fa-phone mr-1"></i> Fecha de Nacimiento</strong>
                                <p class="text-muted"><?= $DataPerson->getDateBornPerson()->translatedFormat('l, j \\de F Y') ?></p>
                                <p class="text-muted">Tienes <?= $DataPerson->getDateBornPerson()->diffInYears(); ?> Años</p>
                            <hr>
                            <strong><i class="fas fa-phone mr-1"></i> Celular</strong>
                                <p class="text-muted"><?= $DataPerson->getPhonePerson() ;?></p>
                            <hr>
                            <strong><i class="fas fa-phone mr-1"></i> Genero</strong>
                                <p class="text-muted"><?= $DataPerson->getGenerePerson(); ?></p>
                            <hr>
                            <strong><i class="fas fa-phone mr-1"></i> Estado</strong>
                            <p class="text-muted"><?= $DataPerson->getStatePerson(); ?></p>
                            <hr>
                            </p>

                        </div>
                        <!--datos TeacherStudies -->
                <?php if(!empty($_GET["idPerson"])){
                            $dataTeacher = Teacher::search("SELECT * FROM teacher WHERE Person_idPerson =" . $_GET["idPerson"]);
                            foreach ($dataTeacher as $teacherD) {
                                $DataTeacherS = \App\Controllers\TeacherStudiesControllers::searchForID($teacherD->getTeacherStudiesIdTeacherStudies()->getIdTeacherStudies());
                            }
                    if(!empty($DataTeacherS)){
                        ?>
                        <div class="card-header">
                            <h3 class="card-title">Estudios</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-user mr-1"></i> #</strong>
                            <p class="text-muted"><?=$DataTeacherS->getIdTeacherStudies()?></p>
                            <hr>
                            <p>
                                <strong><i class="fas fa-book mr-1"></i> titulo</strong>
                            <p class="text-muted">
                                <?= $DataTeacherS->getTitleTeacherStudies()?>
                            </p>
                            <hr>
                            <strong><i class="fas fa-user mr-1"></i> año</strong>
                            <p class="text-muted"><?=$DataTeacherS->getYearStudyTeacher()?></p>
                            <hr>
                            <strong><i class="fas fa-user mr-1"></i> Estado</strong>
                            <p class="text-muted"><?=$DataTeacherS->getStateTeacherStudies()?></p>
                            <hr>

                        </div>
                        <?php }
                        } ?>

                        <!--Experince -->
                        <?php
                        if (!empty($_GET["idPerson"])) {
                            $dataTeacher = Teacher::search("SELECT * FROM teacher WHERE Person_idPerson =" . $_GET["idPerson"]);
                            foreach ($dataTeacher as $teacherD) {
                                $DataExperience = \App\Controllers\ExperienceControllers::searchForID($teacherD->getExperienceIdExperience()->getIdExperience());
                                $idT = $teacherD->getIdTeacher();
                            }
                        if(!empty($DataExperience)){?>
                            <div class="card-header">
                                <h3 class="card-title">Experiencia</h3>
                            </div>
                            <div class="card-body">
                                <strong><i class="fas fa-user mr-1"></i> #</strong>
                                <p class="text-muted"><?=$DataExperience->getIdExperience();?></p>
                                <hr>
                                <p>
                                        <strong><i class="fas fa-book mr-1"></i> Instituto</strong>
                                <p class="text-muted">
                                    <?= $DataExperience->getInstitutionExperience();?>
                                <hr>
                                <strong><i class="fas fa-user mr-1"></i>Dedicacion</strong>
                                <p class="text-muted"><?=$DataExperience->getDedicationExperience();?></p>
                                <hr>
                                </p>
                                <strong><i class="fas fa-user mr-1"></i> Fecha Incio</strong>
                                <p class="text-muted"><?=$DataExperience->getStartExperience()->translatedFormat('l, j \\de F Y');?></p>
                                <hr>
                                </p>
                                <strong><i class="fas fa-user mr-1"></i> Fecha fin</strong>
                                <p class="text-muted"><?=$DataExperience->getEndExperince()->translatedFormat('l, j \\de F Y');?></p>
                                <hr>
                                </p>
                                <strong><i class="fas fa-user mr-1"></i> Estado</strong>
                                <p class="text-muted"><?=$DataExperience->getStateExperience();?></p>
                                <hr>
                                </p>
                            </div>
                            <?php }?>
                        <?php }?>
                        <!---->
                        <!--Lenguajes -->
                        <?php if(!empty($_GET["idPerson"])){
                            $DataT = Teacher::search("SELECT * FROM teacher WHERE Person_idPerson =" .$_GET["idPerson"]);
                            $teacher=$DataT[0];
                            $DataTeacherleng = TeacherLenguages::search("SELECT * FROM TeacherLenguages WHERE Teacher_idTeacher =" .$teacher->getIdTeacher());
                            foreach ($DataTeacherleng as $teacherLen){
                                $lenguajes = $teacherLen->getLenguagesIdLenguages();
                                $idTeachLen = $teacherLen->getIdTeacherLenguages();
                                $DataLenguagues = \App\Controllers\LenguagesControllers::searchForID($lenguajes->getIdLenguages());
                            }
                            if(!empty($DataLenguagues)){
                                ?>
                                <div class="card-header">
                                    <h3 class="card-title">Idioma</h3>
                                </div>
                                <div class="card-body">
                                    <strong><i class="fas fa-user mr-1"></i> #</strong>
                                    <p class="text-muted"><?=$DataLenguagues->getIdLenguages()?></p>
                                    <hr>
                                    <p>
                                        <strong><i class="fas fa-book mr-1"></i> Idioma</strong>
                                    <p class="text-muted">
                                        <?= $DataLenguagues->getNameLenguages()?>
                                    <hr>
                                    <strong><i class="fas fa-user mr-1"></i> Estado</strong>
                                    <p class="text-muted"><?=$DataLenguagues->getStateLenguague()?></p>
                                    <hr>
                                    </p>
                                </div>
                            <?php }
                        } ?>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <a role="button" href="index.php" class="btn btn-success float-right" style="margin-right: 5px;">
                                        <i class="fas fa-tasks"></i> Consultar Docente
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a role="button" href="create.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-plus"></i> Crear Docente
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
    <?php require ("../../../partials/footer.php");?>
    <!--</div>-->
    <?php require ("../../../partials/scripts.php");?>
</body>
</html>
