<?php require ("../../partials/routes.php");
require_once("../../../app/Controllers/TrainingProgramController.php");
require_once("../../../app/Models/TrainingProgram.php");
use App\Controllers\TrainingProgramController;
use App\Models\TrainingProgram;
?>
<!doctype html>
<html lang="es">
<head>
    <title><?=getenv('TITLE_SITE');?> | Agregar Competencia</title>
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
                        <h1>Crear Competencia</h1>
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
                        Error al crear la competencia: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <!--Formulario de la competencia-->
            <div class="card card-info">
                <div class="card-header">
                    <?php
                    $DataPrograming = TrainingProgramController::searchForID($_GET["idTrainingProgram"]);
                    ?>
                    <h3 class="card-title">Agregar Competencia de  - <?=$DataPrograming->getNameTrainingProgram();?></h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="frmCreateCompetition" name="frmCreateCompetition" action="../../../app/Controllers/TrainingCompetitionControllers.php?action=create">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="codeTrainingCompetition" class="col-sm-2 col-form-label">Codigo Competencia</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="codeTrainingCompetition" name="codeTrainingCompetition" placeholder="Ingrese el Codigo de la Competencia">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="codeAlfaTrainingCompetition" class="col-sm-2 col-form-label">Codigo Competencia Corto:</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="codeAlfaTrainingCompetition" name="codeAlfaTrainingCompetition" placeholder="Ingrese el Codigo de la Competencia corto">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="denomination" class="col-sm-2 col-form-label">Nombre de la Competencia</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="denomination" name="denomination" placeholder="Ingrese el nombre de la Competencia">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="duration" class="col-sm-2 col-form-label">Duracion</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="duration" name="duration" placeholder="Duracion en horas">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="minimumSpace" class="col-sm-2 col-form-label">Cupo Minimo</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="minimumSpace" name="minimumSpace" placeholder="Cupo Minimo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="orderTrainingCompetition" class="col-sm-2 col-form-label">Orden</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="orderTrainingCompetition" name="orderTrainingCompetition" placeholder="Orden">
                            </div>
                        </div>
                        <?php
                        $idTP= $_GET["idTrainingProgram"];?>
                        <input id="TrainingProgram_idTrainingProgram" name="TrainingProgram_idTrainingProgram"
                               value="<?php echo $idTP; ?>" hidden required="required"
                               type="text">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Programa de Formacion</label>
                            <div class="col-sm-10">
                                <input class="form-control"value="<?php echo $DataPrograming->getNameTrainingProgram(); ?>"
                                       type="text"  readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Enviar</button>
                        <?php$idTP;?>
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
</body>
</html>