<?php
require("../../partials/routes.php");
require_once("../../../app/Controllers/TrainingCompetitionControllers.php");
require_once("../../../app/Controllers/LearningResultControllers.php");
require_once("../../../app/Models/TrainingCompetition.php");
require_once("../../../app/Models/LearningResult.php");

use App\Controllers\TrainingCompetitionControllers;
use App\Controllers\LearningResultControllers;
use App\Models\LearningResult;
use App\Models\TrainingCompetition;

?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Crear Resultado de Aprendizaje</title>
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
                        <h1>Crear un Nuevo Resultado de Aprendizaje</h1>
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
                                <h3 class="card-title"><i class="fas fa-award"></i> &nbsp; Información de la Competencia</h3>
                                <?php require("../../partials/optionMenu.php") ;?>
                            </div>

                            <div class="card-body">
                                <?php
                                $DataPrograming = null;
                                if (!empty($_GET['idTrainingCompetition'])) {
                                    $DataCompetition = TrainingCompetitionControllers::searchForID($_GET["idTrainingCompetition"]);
                                }
                                ?>
                                <!--Datos de la Competencia Asociada-->
                                <div class="form-group row">

                                    <!--Codigo de la Competencia-->
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Codigo</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" value="<?php echo $DataCompetition->getCodeTrainingCompetition(); ?>"
                                                   type="text"  readonly="readonly">
                                        </div>
                                    </div>
                                    <!--Nombre de la Competencia-->
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Competencia</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" value="<?php echo $DataCompetition->getDenomination(); ?>"
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
                                <h3 class="card-title"><i class="fas fa-book-reader"></i> &nbsp; Detalles del Resultado de Aprendizaje</h3>
                                <?php require("../../partials/optionMenu.php") ;?>
                            </div>
                            <!--Datos del Resultado-->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <?php $idC= $_GET['idTrainingCompetition'];?>
                                        <a role="button" href="index.php?idTrainingCompetition=<?= $idC;?>" class="btn btn-primary float-right"
                                           style="margin-right: 5px;">
                                            <i class="fas fa-eye"></i> Ver Resultado
                                        </a>
                                    </div>
                                    <div class="col-auto">
                                        <a role="button" href="#" data-toggle="modal" data-target="#modal-add-LearningR"
                                           class="btn btn-primary float-right"
                                           style="margin-right: 5px;">
                                            <i class="fas fa-plus"></i> Añadir Resultado
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table id="tblLearningR" class="datatable table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Codigo</th>
                                                <th>Nombre</th>
                                                <th>Duracion</th>
                                                <th>Estado</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tbody>
                                            <?php
                                            $idC = $_GET['idTrainingCompetition'];
                                            $arrLe= \App\Models\LearningResult::search("SELECT * FROM LearningResult where TrainingCompetition_idTrainingCompetition =".$idC);
                                            foreach ($arrLe as $DataLearning){
                                                ?>
                                                <tr>
                                                    <td><?php echo $DataLearning->getIdLearningResult(); ?></td>
                                                    <td><?php echo $DataLearning->getCodeLearningResult(); ?></td>
                                                    <td><?php echo $DataLearning->getNameLearningResult(); ?></td>
                                                    <td><?php echo $DataLearning->getDurationLearningResult(); ?></td>
                                                    <td><?php echo $DataLearning->getStatuLearningResult(); ?></td>
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
        <div class="modal fade" id="modal-add-LearningR">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Resultado de Aprendizaje</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../../../app/Controllers/LearningResultControllers.php?action=create" method="post">
                        <div class="modal-body">
                            <input id="idLearningResult" name="idLearningResult" value="<?= !empty($DataLearning) ? $DataLearning->getIdLearningResult() : ''; ?>" hidden
                                   required="required" type="text">
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
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" href="create.php?idTrainingCompetition=<?= $DataLearning->getTrainingCompetitionIdTrainingCompetition()->getIdTrainingCompetition()?>" class="btn btn-primary"></i> Agregar</button>
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
<!-- DataTables -->
<script src="<?= $adminlteURL ?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-responsive/js/dataTables.responsive.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-responsive/js/responsive.bootstrap4.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/dataTables.buttons.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.bootstrap4.js"></script>
<script src="<?= $adminlteURL ?>/plugins/jszip/jszip.js"></script>
<script src="<?= $adminlteURL ?>/plugins/pdfmake/pdfmake.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.html5.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.print.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.colVis.js"></script>

<script>
    $(function () {
        $('.datatable').DataTable({
            "dom": 'Bfrtip',
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "language": {
                "url": "../../components/Spanish.json" //Idioma
            },
            "buttons": [
                'copy', 'print', 'excel', 'pdf'
            ],
            "pagingType": "full_numbers",
            "responsive": true,
            "stateSave": true, //Guardar la configuracion del usuario
        });
    });
</script>


</body>
</html>