<?php
require ("../../partials/routes.php");
require ("../../../app/Controllers/ArchiveControllers.php");
require ("../../../app/Controllers/ActivityControllers.php");

use App\Controllers\ArchiveControllers;
use App\Controllers\ActivityControllers;?>
<html lang="es">
<head>
    <title><?= getenv('TITLE_SITE')?> | Editar Actividad</title>
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
                        <h1>Editar Actividad</h1>
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

                    <h3 class="card-title">Editar Actividad</h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <!-- /.card-header -->
                <?php if(!empty($_GET["idTrainingCompetition"]) && isset($_GET["idTrainingCompetition"])){ ?>
                <p>
                    <?php
                    $DataActivity = \App\Controllers\ActivityControllers::searchForID($_GET["idActivity"]);
                    if(!empty($DataActivity)){
                    ?>
                    <!-- form start -->
                <form class="form-horizontal" method="post" id="frmEditCompetition" name="frmEditCompetition" action="../../../app/Controllers/ActivityControllers.php?action=edit">
                    <input id="idActivity" name="idActivity" value="<?php echo $DataActivity->getIdActivity(); ?>" hidden required="required" type="text">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="codeActivity" class="col-sm-2 col-form-label">Codigo de la Actividad</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="codeActivity" name="codeActivity" value="<?= $DataActivity->getCodeActivity(); ?>" placeholder="Ingrese el Codigo de la Actividad">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nameActivity" class="col-sm-2 col-form-label">Nombre de la Actividad</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="nameActivity" name="nameActivity" value="<?= $DataActivity->getNameActivity(); ?>" placeholder="Ingrese el Nombre de la Actividad">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="descriptionActivity" class="col-sm-2 col-form-label">Descipcion Actividad</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="descriptionActivity" name="descriptionActivity" value="<?= $DataActivity->getDescriptionActivity(); ?>" placeholder="Ingrese la Descripcion de la Actividad">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="typeActivity" class="col-sm-2 col-form-label">Tipo de Actividad</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="typeActivity" name="typeActivity" value="<?= $DataActivity->getTypeActivity(); ?>" placeholder="Ingrese Tipo de Actividad">
                            </div>
                    </div>
                    <div class="form-group row">
                        <input id="LearningResult_idLearningResult" name="LearningResult_idLearningResult" value="<?php echo $DataActivity->getLearningResultIdLearningResult(); ?>" hidden required="required" type="text">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Resultado de Aprendisaje</label>
                            <div class="col-sm-10">
                                <input class="form-control"value="<?php echo $DataActivity->LearningResult_idLearningResult()->getNameLearningResult(); ?>"
                                       type="text"  readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="statusTrainingCompetition" class="col-sm-2 col-form-label">Estado</label>
                        <div class="col-sm-10">
                            <select id="stateActivity" name="stateActivity" class="custom-select">
                                <option <?= ($DataActivity->getStateActivity() == "Activo") ? "selected":""; ?> value="Activo">Activo</option>
                                <option <?= ($DataActivity->getStateActivity() == "Inactivo") ? "selected":""; ?> value="Inactivo">Inactivo</option>
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