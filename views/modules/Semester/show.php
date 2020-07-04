<?php require ("../../partials/routes.php");
require ("../../../app/Controllers/PersonController.php");
use App\Controllers\PersonController;
?>
<!doctype html>
<html lang="en">
<head>
    <title><?= getenv('TITLE_SITE');?>| Consultar</title>
    <?php require ("../../partials/head_imports.php");?>
    <?php require("../../partials/header.php");?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php require ("../../partials/navbar_customation.php");?>
    <?php require ("../../partials/sliderbar_main_menu.php")?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Informacion Semestre</h1>
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
                        Error al consultar los Semestres: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['idSemester'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <?php if(!empty($_GET["idSemester"]) && isset($_GET["idSemester"])){
                    $DataSemester = \App\Controllers\SemesterControllers::searchForID($_GET["idSemester"]);
                    if(!empty($DataSemester)){
                        ?>
                        <div class="card-header">
                            <h3 class="card-title">Tabla de Datos</h3>
                        </div>
                        <div class="card-body">
                            <p>
                                <strong><i class="fas fa-book mr-1"></i> Nombres</strong>
                            <p class="text-muted">
                                <?= $DataSemester->getNameSemester() ?>
                            </p>
                            <hr>
                            <strong><i class="fas fa-user mr-1"></i> Fecha de inicio</strong>
                            <p class="text-muted"><?=$DataSemester->getStartDate() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Fecha de cierre</strong>
                            <p class="text-muted"><?= $DataSemester->getEndDate() ?></p>
                            <hr>
                            <strong><i class="fas fa-user mr-1"></i> Fecha de inicio 1er 50</strong>
                            <p class="text-muted"><?=$DataSemester->getStartDate50() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Fecha de cierre 1er 50</strong>
                            <p class="text-muted"><?= $DataSemester->getEndDate50() ?></p>
                            <hr>
                            <strong><i class="fas fa-user mr-1"></i> Fecha de inicio 2do 50</strong>
                            <p class="text-muted"><?=$DataSemester->getStarDate2Semester() ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Fecha de cierre 2do 50</strong>
                            <p class="text-muted"><?= $DataSemester->getEndDate2Semester() ?></p>
                            <hr>
                            <strong><i class="fas fa-phone mr-1"></i> Estado</strong>
                            <p class="text-muted"><?= $DataSemester->getStatuSemester() ?></p>
                            <hr>
                            </p>

                        </div>
                        <!--Sub menu-->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <a role="button" href="index.php" class="btn btn-success float-right" style="margin-right: 5px;">
                                        <i class="fas fa-tasks"></i> Consultar Semestre
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a role="button" href="create.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-plus"></i> Crear Semestre
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            No se encontro ningun registro con estos parametros de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                        </div>
                    <?php }
                } ?>
            </div>
            <!-- /.card -->
        </section>
    </div>
    <?php require ("../../partials/footer.php");?>
    <!--</div>-->
    <?php require ("../../partials/scripts.php");?>
</body>
</html>
