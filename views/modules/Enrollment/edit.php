<?php
require("../../partials/routes.php");
require_once("../../../app/Controllers/EnrollmentControllers.php");

use App\Models\Enrollment;
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
                        Error al editar el usuario: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['idTrainingCompetition'])) { ?>
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
                    $DataEnrollment = \App\Controllers\EnrollmentControllers::searchForID($_GET["idEnrollment"]);
                    if(!empty($DataEnrollment)){
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="frmEditEnrollment" name="frmEditEnrollment" action="../../../app/Controllers/EnrollmentControllers.php?action=edit">
                            <input id="idTrainingCompetition" name="idTrainingCompetition" value="<?php echo $DataEnrollment->getIdEnrollment(); ?>" hidden required="required" type="text">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="dateEnrollment" class="col-sm-2 col-form-label">Fecha</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="dateEnrollment" name="dateEnrollment" value="<?= $DataEnrollment->getDateEnrollment(); ?>" placeholder="Ingrese el Codigo de la Matricula">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dateEnrollment" class="col-sm-2 col-form-label">FECHA</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="dateEnrollment" name="dateEnrollment" value="<?= $DataEnrollment->getCodeAlfaTrainingCompetition(); ?>" placeholder="Ingrese el Codigo de la competencia corto">
                                    </div>
                                </div>
                                <!-- HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH -->
                                <input id="Student_idStudent" name="Student_idStudent" value="<?php echo $DataEnrollment->getStudentIdStudent(); ?>" hidden required="required" type="text">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Estudiante</label>
                                    <div class="col-sm-10">
                                        <input class="form-control"value="<?php echo $DataEnrollment->getStudentIdStudent()->getNameTrainingProgram(); ?>"
                                               type="text"  readonly="readonly">
                                    </div>
                                </div>
                                <input id="Semester_idSemester" name="Semester_idSemester" value="<?php echo $DataEnrollment->getSemesterIdSemester(); ?>" hidden required="required" type="text">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Horario</label>
                                    <div class="col-sm-10">
                                        <input class="form-control"value="<?php echo $DataEnrollment->getSemesterIdSemester()->getNameTrainingProgram(); ?>"
                                               type="text"  readonly="readonly">
                                    </div>
                                </div>

                                <input id="TrainingProgram_idTrainingProgram" name="TrainingProgram_idTrainingProgram" value="<?php echo $DataEnrollment->getTrainingProgramIdTrainingProgram(); ?>" hidden required="required" type="text">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Programa de Formacion</label>
                                    <div class="col-sm-10">
                                        <input class="form-control"value="<?php echo $DataEnrollment->getTrainingProgramIdTrainingProgram()->getNameTrainingProgram(); ?>"
                                               type="text"  readonly="readonly">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="statusTrainingCompetition" class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-10">
                                        <select id="stateEnrollment" name="stateEnrollment" class="custom-select">
                                            <option <?= ($DataEnrollment->getStateEnrollment() == "Activo") ? "selected":""; ?> value="Activo">Activo</option>
                                            <option <?= ($DataEnrollment->getStateEnrollment() == "Inactivo") ? "selected":""; ?> value="Inactivo">Inactivo</option>
                                        </select>
                                    </div>
                                </div>
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