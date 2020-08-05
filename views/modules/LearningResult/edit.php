<?php
require("../../partials/routes.php");
require_once("../../../app/Controllers/TrainingCompetitionControllers.php");
require_once("../../../app/Controllers/LearningResultControllers.php");
require_once("../../../app/Models/TrainingCompetition.php");
use App\Controllers\TrainingCompetitionControllers;
use App\Controllers\LearningResultControllers;
use App\Models\TrainingCompetition;
?>
<html lang="es">
<head>
    <title><?= getenv('TITLE_SITE')?> | Editar Resultado de Aprendizaje</title>
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
                        <h1>Editar Resultado de Aprendizaje</h1>
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
                        Error al editar el Resultado de Aprendizaje: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['idLearningResult'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">

                    <h3 class="card-title">Editar el Resultado de Aprendizaje</h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <!-- /.card-header -->
                <?php if(!empty($_GET["idLearningResult"]) && isset($_GET["idLearningResult"])){ ?>
                    <p>
                    <?php
                    $DataLearningR = \App\Controllers\LearningResultControllers::searchForID($_GET["idLearningResult"]);
                    if(!empty($DataLearningR)){
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="frmEditLearning" name="frmEditLearning" action="../../../app/Controllers/LearningResultControllers.php?action=edit">
                            <input id="idLearningResult" name="idLearningResult" value="<?php echo $DataLearningR->getIdLearningResult(); ?>" hidden required="required" type="text">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="codeLearningResult" class="col-sm-2 col-form-label">Codigo del Resultado de Aprendizaje</label>
                                    <div class="col-sm-10">
                                        <input required type="number" class="form-control" id="codeLearningResult" name="codeLearningResult" value="<?= $DataLearningR->getCodeLearningResult(); ?>" placeholder="Ingrese el Codigo del Resultado de Aprendizaje">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nameLearningResult" class="col-sm-2 col-form-label">Nombre del Resultado de Aprendizaje</label>
                                    <div class="col-sm-10">
                                        <input required type="text" maxlength="500"  class="form-control" id="nameLearningResult" name="nameLearningResult" value="<?= $DataLearningR->getNameLearningResult(); ?>" placeholder="Ingrese el Nombre del Resultado de Aprendizaje">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="durationLearningResult" class="col-sm-2 col-form-label">Duracion</label>
                                    <div class="col-sm-10">
                                        <input required type="text" maxlength="4" class="form-control" id="durationLearningResult" name="durationLearningResult" value="<?= $DataLearningR->getDurationLearningResult(); ?>" placeholder="Ingrese la Duracionn en horas">
                                    </div>
                                </div>
                                <input id="TrainingCompetition_idTrainingCompetition" name="TrainingCompetition_idTrainingCompetition" value="<?php echo $DataLearningR->getTrainingCompetitionIdTrainingCompetition()->getIdTrainingCompetition(); ?>" hidden required="required" type="text">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Competencia Asociada</label>
                                    <div class="col-sm-10">
                                        <input class="form-control"value="<?php echo $DataLearningR->getTrainingCompetitionIdTrainingCompetition()->getDenomination(); ?>"
                                               type="text"  readonly="readonly">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="statuLearningResult" class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-10">
                                        <select id="statuLearningResult" name="statuLearningResult" class="custom-select">
                                            <option <?= ($DataLearningR->getStatuLearningResult() == "Activo") ? "selected":""; ?> value="Activo">Activo</option>
                                            <option <?= ($DataLearningR->getStatuLearningResult() == "Inactivo") ? "selected":""; ?> value="Inactivo">Inactivo</option>
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