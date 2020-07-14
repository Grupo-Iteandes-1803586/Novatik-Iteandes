<?php
require("../../partials/routes.php");
require("../../../app/Controllers/TrainingProgramController.php");

use App\Controllers\TrainingProgramController; ?>
<!doctype html>
<html lang="es">
<head>
    <title>Document</title>
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
                        <h1>Editar Programa de Formacion</h1>
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
                        Error al crear el usuario: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['idTrainingProgram'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Programa de formacion</h3>
                </div>
                <!-- /.card-header -->
                <?php if(!empty($_GET["idTrainingProgram"]) && isset($_GET["idTrainingProgram"])){ ?>
                    <p>
                    <?php
                    $DataTrainigP = TrainingProgramController::searchForID($_GET["idTrainingProgram"]);
                    if(!empty($DataTrainigP)){
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="frmEditProgram" name="frmEditProgram" action="../../../app/Controllers/TrainingProgramController.php?action=edit">
                            <input id="idTrainingProgram" name="idTrainingProgram" value="<?php echo $DataTrainigP->getIdTrainingProgram(); ?>" hidden required="required" type="text">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="codeTrainingProgram" class="col-sm-2 col-form-label">Codigo del Programa de Formacion</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="codeTrainingProgram" name="codeTrainingProgram" value="<?= $DataTrainigP->getCodeTrainingProgram(); ?>" placeholder="Ingrese el Codigo del Programa de Formacion">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nameTrainingProgram" class="col-sm-2 col-form-label">Nombre del Programa de Formacion</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="nameTrainingProgram" name="nameTrainingProgram" value="<?= $DataTrainigP->getNameTrainingProgram(); ?>" placeholder="Ingrese el nombre del Programa de Formacion">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="version" class="col-sm-2 col-form-label">Version</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="version" name="version" value="<?= $DataTrainigP->getVersion(); ?>" placeholder="Ingrese la Version">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="statusTrainingProgram" class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-10">
                                        <select id="statusTrainingProgram" name="statusTrainingProgram" class="custom-select">
                                            <option <?= ($DataTrainigP->getStatusTrainingProgram() == "Activo") ? "selected":""; ?> value="Activo">Activo</option>
                                            <option <?= ($DataTrainigP->getStatusTrainingProgram() == "Inactivo") ? "selected":""; ?> value="Inactivo">Inactivo</option>
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