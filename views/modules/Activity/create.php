<?php
require("../../partials/routes.php");
require_once("../../../app/Controllers/LearningResultControllers.php");
require_once("../../../app/Controllers/ActivityControllers.php");
require_once("../../../app/Models/LearningResult.php");
require_once("../../../app/Models/Activity.php");

use App\Controllers\LearningResultControllers;
use App\Controllers\ActivityControllers;
use App\Models\LearningResult;
use App\Models\Activity;

?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Crear Actividad</title>
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
                    Error al crear la Actividad: <?= $_GET['mensaje'] ?>
                </div>
            <?php } ?>
        <?php } ?>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Crear una Nueva Actividad</h1>
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
                                <h3 class="card-title"><i class="fas fa-book-reader"></i> &nbsp; Información del Resultado de Aprendizaje</h3>
                                <?php require("../../partials/optionMenu.php") ;?>
                            </div>

                            <div class="card-body">
                                <?php
                                $DataLerning = null;
                                if (!empty($_GET['idLearningResult'])) {
                                    $DataLerning = LearningResultControllers::searchForID($_GET["idLearningResult"]);
                                }
                                ?>
                                <!--Datos del Resultado de Aprendizaje Asociado-->
                                <div class="form-group row">

                                    <!--Codigo del Resultado-->
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Codigo</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" value="<?php echo $DataLerning->getCodeLearningResult(); ?>"
                                                   type="text"  readonly="readonly">
                                        </div>
                                    </div>
                                    <!--Nombre del Resultado-->
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Resultado de Aprenizaje</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" value="<?php echo $DataLerning->getNameLearningResult(); ?>"
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
                                <h3 class="card-title"><i class="fas fa-folder-open"></i> &nbsp; Detalles de la Actividad</h3>
                                <?php require("../../partials/optionMenu.php") ;?>
                            </div>
                            <!--Datos de la Actividad-->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <?php $idL= $_GET['idLearningResult'];?>
                                        <a role="button" href="index.php?idLearningResult=<?= $idL;?>" class="btn btn-primary float-right"
                                           style="margin-right: 5px;">
                                            <i class="fas fa-eye"></i> Ver Actividad
                                        </a>
                                    </div>
                                    <div class="col-auto">
                                        <a role="button" href="#" data-toggle="modal" data-target="#modal-add-activity"
                                           class="btn btn-primary float-right"
                                           style="margin-right: 5px;">
                                            <i class="fas fa-plus"></i> Añadir Actividad
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table id="tblActivity" class="datatable table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Codigo Actvidad</th>
                                                <th>Nombre de la Actvidad</th>
                                                <th>Descripcion de la Actividad</th>
                                                <th>Tipo de actividad</th>
                                                <th>Estado</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $idL = $_GET['idLearningResult'];
                                            $arrActivity = \App\Models\Activity::search("SELECT * FROM Activity where LearningResult_idLearningResult =".$idL);
                                            foreach ($arrActivity as $Activity){
                                                ?>
                                                <tr>
                                                    <td><?php echo $Activity->getIdActivity(); ?></td>
                                                    <td><?php echo $Activity->getCodeActivity(); ?></td>
                                                    <td><?php echo $Activity->getNameActivity(); ?></td>
                                                    <td><?php echo $Activity->getDescriptionActivity(); ?></td>
                                                    <td><?php echo $Activity->getTypeActivity(); ?></td>
                                                    <td><?php echo $Activity->getStateActivity(); ?></td>
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
        <div class="modal fade" id="modal-add-activity">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Actividad</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../../../app/Controllers/ActivityControllers.php?action=create" method="post">
                        <div class="modal-body">
                            <input id="idActivity" name="idActivity" value="<?= !empty($Activity) ? $Activity->getIdActivity() : ''; ?>" hidden
                                   required="required" type="text">
                            <li class="list-Dates"><i class ="fas fa-folder-open" id="icon-iconos"></i>Actividad</li>
                            <hr>
                            <!--codigoActivity-->
                            <div class="form-group row">
                                <label for="codeActivity" class="col-sm-2 col-form-label">Codigo Actividad</label>
                                <div class="col-sm-10">
                                    <input required type="Number" class="form-control" id="codeActivity" name="codeActivity" placeholder="Codigo Actividad">
                                </div>
                            </div>
                            <!--nameActivity-->
                            <div class="form-group row">
                                <label for="nameActivity" class="col-sm-2 col-form-label">Nombre Actividad</label>
                                <div class="col-sm-10">
                                    <input required type="text" maxlength="300" class="form-control" id="nameActivity" name="nameActivity" placeholder="Nombre Actividad">
                                </div>
                            </div>
                            <!--Descripcion-->
                            <div class="form-group row">
                                <label for="descriptionActivity" class="col-sm-2 col-form-label">Descripcion</label>
                                <div class="col-sm-10">
                                    <input required type="text" maxlength="500" class="form-control" id="descriptionActivity" name="descriptionActivity" placeholder="Descripcion">
                                </div>
                            </div>
                            <!--Tipo de Activida-->
                            <div class="form-group row">
                                <label for="typeActivity" class="col-sm-2 col-form-label">Tipo de Actividad</label>
                                <div class="col-sm-10">
                                    <select id="typeActivity" name="typeActivity" class="custom-select">
                                        <option value="Desempeño">Desempeño</option>
                                        <option value="Producto">Producto</option>
                                        <option value="Conocimiento">Conocimiento</option>
                                    </select>
                                </div>
                            </div>
                            <!--Resultados de Actividad-->
                            <?php
                            $idLR= $_GET["idLearningResult"];?>
                            <input id="LearningResult_idLearningResult" name="LearningResult_idLearningResult"
                                   value="<?php echo $idLR; ?>" hidden required="required" type="text">
                            <!------------------------datos de archivo-------------------------->
                            <li class="list-Dates"><i class ="fas fa-file-alt" id="icon-iconos"></i>Archivo</li>
                            <hr>
                            <!--nombre archivo-->
                            <div class="form-group row">
                                <label for="nameArchive" class="col-sm-2 col-form-label">Nombre Archivo</label>
                                <div class="col-sm-10">
                                    <input required type="text" maxlength="300"  class="form-control" id="nameArchive" name="nameArchive" placeholder="Nombre Archivo">
                                </div>
                            </div>
                            <!--Descripcion del Archivo-->
                            <div class="form-group row">
                                <label for="descriptionArchive" maxlength="250" class="col-sm-2 col-form-label">Descripcion del Archivo</label>
                                <div class="col-sm-10">
                                    <input required type="text" class="form-control" id="descriptionArchive" name="descriptionArchive" placeholder="Descripcion del Archivo">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" href="create.php?idLearningResult=<?= $Activity->getLearningResultIdLearningResult()->getIdLearningResult()?>" class="btn btn-primary"></i> Agregar</button>
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