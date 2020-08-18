<?php
require ("../../partials/routes.php");
require ("../../../app/Controllers/TrainingProgramController.php");
require ("../../../app/Controllers/TrainingCompetitionControllers.php");

use App\Controllers\TrainingProgramController;
use App\Controllers\TrainingCompetitionControllers;?>
<!doctype html>
<html lang="es">
<head>
    <title><?=getenv('TITLE_SITE');?> | Competencia</title>
    <?php
    require("../../partials/head_imports.php") ;
    require("../../partials/header.php") ;
    ?>
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Consultar Competencias</h1>
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

            <?php if(!empty($_GET['respuesta']) && !empty($_GET['action'])){ ?>
                <?php if ($_GET['respuesta'] == "correcto"){ ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Correcto!</h5>
                        <?php  if($_GET['action'] == "update"){ ?>
                            Los datos de la competencia han sido actualizados correctamente!
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gestionar Competencia</h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto mr-auto"></div>
                        <div class="col-auto">
                            <?php $idTP= $_GET["idTrainingProgram"];?>
                            <a role="button" href="create.php?idTrainingProgram=<?=$idTP; ?>" class="btn btn-primary float-right"
                               style="margin-right: 5px;">
                                <i class="fas fa-plus"></i> Crear Competencia
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table id="tblTrainingCompetition" class="datatable table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Codigo</th>
                                    <th>Codigo corto</th>
                                    <th>Nombre</th>
                                    <th>Duracio</th>
                                    <th>Cupo Minimo</th>
                                    <th>orden</th>
                                    <th>Programa Vinculado</th>
                                    <th>Estado</th>
                                    <th>Resultado de Aprendizaje</th>
                                    <th>Opciones</th>
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
                                        <td><?php echo $trainingCom->getTrainingProgramIdTrainingProgram()->getNameTrainingProgram(); ?></td>
                                        <td><?php echo $trainingCom->getStatusTrainingCompetition(); ?></td>
                                        <td> <a href="../LearningResult/create.php?idTrainingCompetition=<?php echo $trainingCom->getIdTrainingCompetition(); ?>" type="button" data-toggle="tooltip" title="Agregar Resultado de Aprendizaje" class="btn docs-tooltip btn-award btn-xs"><i class="fa fa-book-reader"></i></a>
                                            <a href="../LearningResult/index.php?idTrainingCompetition=<?php echo $trainingCom->getIdTrainingCompetition(); ?>" type="button" data-toggle="tooltip" title="Ver Resultado de Aprendizaje" class="btn docs-tooltip btn-vision btn-xs"><i class="fa fa-low-vision"></i></a>

                                        <td>
                                            <a href="edit.php?idTrainingCompetition=<?php echo $trainingCom->getIdTrainingCompetition(); ?>" type="button" data-toggle="tooltip" title="Actualizar" class="btn docs-tooltip btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                            <a href="show.php?idTrainingCompetition=<?php echo $trainingCom->getIdTrainingCompetition(); ?>" type="button" data-toggle="tooltip" title="Ver" class="btn docs-tooltip btn-warning btn-xs"><i class="fa fa-eye"></i></a>
                                            <?php if ($trainingCom->getStatusTrainingCompetition() != "Activo"){
                                                ?>
                                                <a href="../../../app/Controllers/TrainingCompetitionControllers.php?action=activate&idTrainingCompetition=<?php echo $trainingCom->getIdTrainingCompetition(); ?>" type="button" data-toggle="tooltip" title="Activar" class="btn docs-tooltip btn-success btn-xs"><i class="fa fa-check-square"></i></a>
                                            <?php }else{?>
                                                <a type="button" href="../../../app/Controllers/TrainingCompetitionControllers.php?action=inactivate&idTrainingCompetition=<?php echo $trainingCom->getIdTrainingCompetition(); ?>" data-toggle="tooltip" title="Inactivar" class="btn docs-tooltip btn-danger btn-xs"><i class="fa fa-times-circle"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
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
            "stateSave" : true, //Guardar la configuracion
        });
    });
</script>
</body>
</html>