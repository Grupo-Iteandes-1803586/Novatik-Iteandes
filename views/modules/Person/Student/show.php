<?php
require ("../../partials/routes.php");
require ("../../../../app/Controllers/StudentControllers.php");

use App\Controllers\StudentControllers;?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE');?>| Consultar</title>
    <?php require ("../../../partials/head_imports.php");?>
    <?php require("../../../partials/header.php");?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php require ("../../../partials/navbar_customation.php");?>
    <?php require ("../../../partials/sliderbar_main_menu.php")?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Informacion Estudiante</h1>
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
                        Error al consultar los Estdiantes: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['idStudent'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <?php if(!empty($_GET["idStudent"]) && isset($_GET["idStudent"])){
                $DataStudent =  \App\Controllers\StudentControllers::searchForID($_GET["idStudent"]);
                if(!empty($DataSemester)){
                ?>
                <div class="card-header">
                    <h3 class="card-title">Informacion Estudiante</h3>
                    <?php require("../../../partials/optionMenu.php") ;?>
                </div>
                <div class="card-body">
                    <p>
                        <strong><i class="fas fa-book mr-1"></i> #</strong>
                    <p class="text-muted">
                        <?= $DataStudent->getIdStudent(); ?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-user mr-1"></i> Modalidad</strong>
                    <p class="text-muted"><?=$DataStudent->getModality(); ?></p>
                    <hr>
                    <hr>
                    <strong><i class="fas fa-user mr-1"></i>Año de Grado</strong>
                    <p class="text-muted"><?=$DataStudent->getGradeYear(); ?></p>
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i>Institucion Educativa</strong>
                    <p class="text-muted"><?= $DataStudent->getInstitution()?></p>
                    <hr>
                    <strong><i class="fas fa-user mr-1"></i> #</strong>
                    <p class="text-muted"><?=$DataStudent->getPersonIdPerson(); ?></p>
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i>Estado</strong>
                    <p class="text-muted"><?= $DataStudent->getStateStudent(); ?></p>
                    <hr>
                    </p>
                    <!--Sub menu-->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-auto mr-auto">
                                <a role="button" href="index.php" class="btn btn-success float-right" style="margin-right: 5px;">
                                    <i class="fas fa-tasks"></i> Consultar Estudiante
                                </a>
                            </div>
                            <div class="col-auto">
                                <a role="button" href="create.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-plus"></i> Crear Estudiante
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
    <?php require ("../../../partials/footer.php");?>
    <!--</div>-->
</div>
<?php require ("../../../partials/scripts.php");?>
</body>
</html>