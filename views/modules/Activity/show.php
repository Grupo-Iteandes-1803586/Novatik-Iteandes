<?php
require ("../../partials/routes.php");
require_once("../../../app/Controllers/ActivityControllers.php");
require_once("../../../app/Controllers/ArchiveControllers.php");
require_once("../../../app/Models/Archive.php");
use App\Controllers\ActivityControllers;
use App\Controllers\ArchiveControllers;
use App\Models\Archive;
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE');?>| Consultar Actividad</title>
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
                        <h1>Informacion de la Actividad</h1>
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
                        Error al consultar la Actividad: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['idActivity'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <?php if(!empty($_GET["idActivity"]) && isset($_GET["idActivity"])){
                $DataActivity= ActivityControllers::searchForID($_GET["idActivity"]);
                if(!empty($DataActivity)){
                ?>
                <div class="card-header">
                    <h3 class="card-title"><?= $DataActivity->getNameActivity()  ?></h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <div class="card-body">
                    <p>
                        <strong><i class="fas fa-book mr-1"></i> Nombre de la actividasd</strong>
                    <p class="text-muted">
                        <?= $DataActivity->getNameActivity()?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-user mr-1"></i> codigo de la Actividad </strong>
                    <p class="text-muted"><?=$DataActivity->getCodeActivity() ?></p>
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> descripcion de la Activity</strong>
                    <p class="text-muted"><?= $DataActivity->getDescriptionActivity() ?></p>
                    <hr>
                    <strong><i class="fas fa-phone mr-1"></i> tipo de Activity</strong>
                    <p class="text-muted"><?= $DataActivity->getTypeActivity() ?></p>
                    <hr>
                    <strong><i class="fas fa-phone mr-1"></i> Estado</strong>
                    <p class="text-muted"><?= $DataActivity->getStateActivity() ?></p>
                    <hr>
                    </p>

                </div>

                <!--Datos del Archivo-->
                <?php if(!empty($_GET["idActivity"])){
                $dataArchive = Archive::search("SELECT * FROM Archive WHERE Activity_idActivity =" .$_GET["idActivity"]);
                foreach ($dataArchive as $archive) {
                    $DataArchi =  \App\Controllers\ArchiveControllers::searchForID($archive->getIdArchive());
                }
                if(!empty($DataArchi)){
                ?>
                <div class="card-header">
                    <h3 class="card-title">Archivo</h3>
                </div>
                <div class="card-body">
                    <p>
                    <strong><i class="far fa-edit"></i> Nombre del Archivo</strong>
                    <p class="text-muted"><?=$DataArchi->getNameArchive(); ?></p>
                    <hr>
                    <strong><i class="fas fa-marker"></i>Descripcion del Archivo</strong>
                    <p class="text-muted"><?=$DataArchi->getDescriptionArchive(); ?></p>
                    <hr>
                    <strong><i class="fas fa-globe"></i>Ruta del Archivo</strong>
                    <p class="text-muted"><?= $DataArchi->getRutaArchive()?></p>
                    <hr>
                    <strong><i class="fas fa-user mr-1"></i>Estado</strong>
                    <p class="text-muted"><?= $DataArchi->getStateArchive(); ?></p>
                    <hr>
                    </p>
                    <!--Sub menu-->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-auto mr-auto">
                                <a role="button" href="index.php" class="btn btn-success float-right" style="margin-right: 5px;">
                                    <i class="fas fa-tasks"></i> Consultar Archivo
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php }
                    } ?>

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
</div>
<?php require ("../../partials/scripts.php");?>
</body>
</html>