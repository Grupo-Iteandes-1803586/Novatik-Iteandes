<?php require ("../../partials/routes.php");
require_once("../../../app/Controllers/TrainingCompetitionControllers.php");
require_once("../../../app/Models/TrainingCompetition.php");
use App\Controllers\TrainingCompetitionControllers;
use App\Models\TrainingCompetition;
?>
<!doctype html>
<html lang="es">
<head>
    <title><?=getenv('TITLE_SITE');?> | Agregar Resultado de Aprendizaje</title>
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
                        <h1>Crear Resultado de Aprendizaje</h1>
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
                        Error al crear el Resultado de Aprendizaje: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <!--Formulario del Resultado de Aprendizaje-->
            <div class="card card-info">
                <div class="card-header">
                    <?php
                    $DataLearning = TrainingCompetitionControllers::searchForID($_GET["idTrainingCompetition"]);
                    ?>
                    <h3 class="card-title">Agregar Resultado de Aprendizaje a - <?=$DataLearning->getDenomination();?></h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="frmCreateLearning" name="frmCreateLearning" action="../../../app/Controllers/LearningResultControllers.php?action=create">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="codeLearningResult" class="col-sm-2 col-form-label">Codigo Resutado de Aprendizaje</label>
                            <div class="col-sm-10">
                                <input required type="number" class="form-control" id="codeLearningResult" name="codeLearningResult" placeholder="Ingrese el Codigo del Resultado de Aprendizaje">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nameLearningResult" class="col-sm-2 col-form-label">Nombre del Resultado de Aprendizaje</label>
                            <div class="col-sm-10">
                                <input required type="text" maxlength="500" class="form-control" id="nameLearningResult" name="nameLearningResult" placeholder="Ingrese el Nombre del Resultado de Aprendizaje">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="durationLearningResult" class="col-sm-2 col-form-label">Duracion </label>
                            <div class="col-sm-10">
                                <input required type="text" maxlength="4"  class="form-control" id="durationLearningResult" name="durationLearningResult" placeholder="Duracion">
                            </div>
                        </div>
                        <?php
                        $idTC= $_GET["idTrainingCompetition"];?>
                        <input id="TrainingCompetition_idTrainingCompetition" name="TrainingCompetition_idTrainingCompetition"
                               value="<?php echo $idTC; ?>" hidden required="required"
                               type="text">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Competencia</label>
                            <div class="col-sm-10">
                                <input class="form-control"value="<?php echo $DataLearning->getDenomination(); ?>"
                                       type="text" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Enviar</button>
                        <?php  $idTC; ?>
                        <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
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