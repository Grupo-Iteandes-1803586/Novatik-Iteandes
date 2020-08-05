<?php
require("../../partials/routes.php");
require_once("../../../app/Controllers/TrainingProgramController.php");
require_once("../../../app/Controllers/TrainingCompetitionControllers.php");
require_once("../../../app/Models/TrainingProgram.php");
require_once("../../../app/Models/TrainingCompetition.php");
use App\Controllers\TrainingProgramController;
use App\Controllers\TrainingCompetitionControllers;
use App\Models\TrainingProgram;
use App\Models\TrainingCompetition;
?>
<html lang="es">
<head>
    <title><?= getenv('TITLE_SITE')?> | Editar Competencia</title>
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
                        <h1>Editar Competencia</h1>
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
                        Error al editar la Competencia: <?= ($_GET['mensaje']) ?? "" ?>
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

                    <h3 class="card-title">Editar Competencia</h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <!-- /.card-header -->
                <?php if(!empty($_GET["idTrainingCompetition"]) && isset($_GET["idTrainingCompetition"])){ ?>
                    <p>
                    <?php
                    $DataTrainigCompetition = \App\Controllers\TrainingCompetitionControllers::searchForID($_GET["idTrainingCompetition"]);
                    if(!empty($DataTrainigCompetition)){
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="frmEditCompetition" name="frmEditCompetition" action="../../../app/Controllers/TrainingCompetitionControllers.php?action=edit">
                            <input id="idTrainingCompetition" name="idTrainingCompetition" value="<?php echo $DataTrainigCompetition->getIdTrainingCompetition(); ?>" hidden required="required" type="text">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="codeTrainingCompetition" class="col-sm-2 col-form-label">Codigo de la Competencia</label>
                                    <div class="col-sm-10">
                                        <input required type="number" class="form-control" id="codeTrainingCompetition" name="codeTrainingCompetition" value="<?= $DataTrainigCompetition->getCodeTrainingCompetition(); ?>" placeholder="Ingrese el Codigo de la competencia">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="codeAlfaTrainingCompetition" class="col-sm-2 col-form-label">Codigo de la competencia corto</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="codeAlfaTrainingCompetition" name="codeAlfaTrainingCompetition" value="<?= $DataTrainigCompetition->getCodeAlfaTrainingCompetition(); ?>" placeholder="Ingrese el Codigo de la competencia corto">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="denomination" class="col-sm-2 col-form-label">Nombre de la Competencia</label>
                                    <div class="col-sm-10">
                                        <input required type="text" maxlength="280" class="form-control" id="denomination" name="denomination" value="<?= $DataTrainigCompetition->getDenomination(); ?>" placeholder="Ingrese el nombre de la competencia">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="duration" class="col-sm-2 col-form-label">Duracion</label>
                                    <div class="col-sm-10">
                                        <input required type="text" maxlength="4" class="form-control" id="duration" name="duration" value="<?= $DataTrainigCompetition->getDuration(); ?>" placeholder="Ingrese la Duracionn en horas">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="minimumSpace" class="col-sm-2 col-form-label">Cupo Minimo</label>
                                    <div class="col-sm-10">
                                        <input required type="text" maxlength="2" class="form-control" id="minimumSpace" name="minimumSpace" value="<?= $DataTrainigCompetition->getMinimumSpace(); ?>" placeholder="Ingrese el Cupo Minimo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="orderTrainingCompetition" class="col-sm-2 col-form-label">Orden</label>
                                    <div class="col-sm-10">
                                        <input required type="text" maxlength="2" class="form-control" id="orderTrainingCompetition" name="orderTrainingCompetition" value="<?= $DataTrainigCompetition->getOrderTrainingCompetition(); ?>" placeholder="Orden">
                                    </div>
                                </div>
                                <input id="TrainingProgram_idTrainingProgram" name="TrainingProgram_idTrainingProgram" value="<?php echo $DataTrainigCompetition->getTrainingProgramIdTrainingProgram()->getIdTrainingProgram(); ?>" hidden required="required" type="text">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Programa de Formacion</label>
                                    <div class="col-sm-10">
                                        <input class="form-control"value="<?php echo $DataTrainigCompetition->getTrainingProgramIdTrainingProgram()->getNameTrainingProgram(); ?>"
                                               type="text"  readonly="readonly">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="statusTrainingCompetition" class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-10">
                                        <select id="statusTrainingCompetition" name="statusTrainingCompetition" class="custom-select">
                                            <option <?= ($DataTrainigCompetition->getStatusTrainingCompetition() == "Activo") ? "selected":""; ?> value="Activo">Activo</option>
                                            <option <?= ($DataTrainigCompetition->getStatusTrainingCompetition() == "Inactivo") ? "selected":""; ?> value="Inactivo">Inactivo</option>
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
<script src="../../components/Js/script.js"></script>
</body>
</html>