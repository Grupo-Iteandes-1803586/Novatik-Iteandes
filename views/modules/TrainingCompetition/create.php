<?php
require("../../partials/routes.php");
require_once("../../../app/Controllers/TrainingCompetitionControllers.php");
require_once("../../../app/Controllers/TrainingProgramController.php");
require_once("../../../app/Models/TrainingProgram.php");
require_once("../../../app/Models/TrainingCompetition.php");

use App\Controllers\TrainingCompetitionControllers;
use App\Controllers\TrainingProgramController;
use App\Models\TrainingProgram;
use App\Models\TrainingCompetition;

?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Crear Competencia</title>
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
                    Error al crear la Competencia: <?= $_GET['mensaje'] ?>
                </div>
            <?php } ?>
        <?php } ?>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Crear una Nueva Competencia</h1>
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
            <div class="container-fluid">
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-chalkboard-teacher"></i> &nbsp; Información del Programa de Formacion</h3>
                                <?php require("../../partials/optionMenu.php") ;?>
                            </div>

                            <div class="card-body">
                                <?php
                                $DataPrograming = null;
                                if (!empty($_GET['idTrainingProgram'])) {
                                    $DataPrograming = TrainingProgramController::searchForID($_GET["idTrainingProgram"]);
                                }
                                ?>
                                <!--Datos de Programa de Fomacion Asociado-->
                                <div class="form-group row">

                                    <!--Codigo del Programa-->
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Codigo</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" value="<?php echo $DataPrograming->getCodeTrainingProgram(); ?>"
                                                   type="text"  readonly="readonly">
                                        </div>
                                    </div>
                                    <!--Nombre del programa-->
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Programa de Formacion</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" value="<?php echo $DataPrograming->getNameTrainingProgram(); ?>"
                                                   type="text"  readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-8">
                        <div class="card card-lightblue">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-award"></i> &nbsp; Detalles de La Competencia</h3>
                                <?php require("../../partials/optionMenu.php") ;?>
                            </div>
                            <!--Datos de la Competencia-->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <?php $idP= $_GET['idTrainingProgram'];?>
                                        <a role="button" href="index.php?idTrainingProgram=<?= $idP;?>" class="btn btn-primary float-right"
                                           style="margin-right: 5px;">
                                            <i class="fas fa-eye"></i> Ver Competencia
                                        </a>
                                    </div>
                                    <div class="col-auto">
                                        <a role="button" href="#" data-toggle="modal" data-target="#modal-add-competition"
                                           class="btn btn-primary float-right"
                                           style="margin-right: 5px;">
                                            <i class="fas fa-plus"></i> Añadir Competencia
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table id="tblCompetition" class="datatable table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Codigo</th>
                                                <th>Codigo corto</th>
                                                <th>Nombre</th>
                                                <th>Duracion</th>
                                                <th>Cupo Minimo</th>
                                                <th>orden</th>
                                                <th>Estado</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $idP = $_GET['idTrainingProgram'];
                                            $arrTrainningCompetition = \App\Models\TrainingCompetition::search("SELECT * FROM TrainingCompetition where TrainingProgram_idTrainingProgram =".$idP);
                                            foreach ($arrTrainningCompetition as $trainingCom){
                                                ?>
                                                <tr>
                                                    <td><?php echo $trainingCom->getIdTrainingCompetition(); ?></td>
                                                    <td><?php echo $trainingCom->getCodeTrainingCompetition(); ?></td>
                                                    <td><?php echo $trainingCom->getCodeAlfaTrainingCompetition(); ?></td>
                                                    <td><?php echo $trainingCom->getDenomination(); ?></td>
                                                    <td><?php echo $trainingCom->getDuration(); ?></td>
                                                    <td><?php echo $trainingCom->getMinimumSpace(); ?></td>
                                                    <td><?php echo $trainingCom->getOrderTrainingCompetition(); ?></td>
                                                    <td><?php echo $trainingCom->getStatusTrainingCompetition(); ?></td>
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
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div id="modals">
        <div class="modal fade" id="modal-add-competition">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Competencia</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../../../app/Controllers/TrainingCompetitionControllers.php?action=create" method="post">
                        <div class="modal-body">
                            <input id="idTrainingCompetition" name="idTrainingCompetition" value="<?= !empty($trainingCom) ? $trainingCom->getIdTrainingCompetition() : ''; ?>" hidden
                                   required="required" type="text">
                            <div class="form-group row">
                                <label for="codeTrainingCompetition" class="col-sm-2 col-form-label">Codigo Competencia</label>
                                <div class="col-sm-10">
                                    <input required type="number" class="form-control" id="codeTrainingCompetition" name="codeTrainingCompetition" placeholder="Ingrese el Codigo de la Competencia">
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
                                    <input required type="text" maxlength="280"  class="form-control" id="denomination" name="denomination" placeholder="Ingrese el nombre de la Competencia">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="duration" class="col-sm-2 col-form-label">Duracion</label>
                                <div class="col-sm-10">
                                    <input required type="text"  maxlength="4" class="form-control" id="duration" name="duration" placeholder="Duracion en horas">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="minimumSpace" class="col-sm-2 col-form-label">Cupo Minimo</label>
                                <div class="col-sm-10">
                                    <input required type="text" maxlength="2" class="form-control" id="minimumSpace" name="minimumSpace" placeholder="Cupo Minimo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="orderTrainingCompetition" class="col-sm-2 col-form-label">Orden</label>
                                <div class="col-sm-10">
                                    <input required type="text" maxlength="2" class="form-control" id="orderTrainingCompetition" name="orderTrainingCompetition" placeholder="Orden">
                                </div>
                            </div>
                            <?php
                            $idTP= $_GET["idTrainingProgram"];?>
                            <input id="TrainingProgram_idTrainingProgram" name="TrainingProgram_idTrainingProgram"
                                   value="<?php echo $idTP; ?>" hidden required="required"
                                   type="text">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" href="create.php?idTrainingProgram=<?= $trainingCom->getTrainingProgramIdTrainingProgram()->getIdTrainingProgram()?>" class="btn btn-primary"></i> Agregar</button>
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