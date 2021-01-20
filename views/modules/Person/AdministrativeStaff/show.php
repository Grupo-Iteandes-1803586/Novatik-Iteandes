<?php
require("../../../partials/routes.php");
require_once("../../../../app/Controllers/PersonController.php");

use App\Controllers\PersonController; ?>

<!doctype html>
<html lang="es">
<head>
    <title><?= getenv('TITLE_SITE');?> | Consultar Personal Admistrativo</title>
    <?php require ("../../../partials/head_imports.php");?>
    <?php require("../../../partials/header.php");?>
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">

    <?php require ("../../../partials/navbar_customation.php");?>
    <?php require ("../../../partials/sliderbar_main_menu.php")?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Informacion del Personal Admistrativo</h1>
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
                        Error al consultar el usuario: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['idPerson'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <?php if(!empty($_GET["idPerson"]) && isset($_GET["idPerson"])){
                    $DataPerson = PersonController::searchForID($_GET["idPerson"]);
                    if(!empty($DataPerson)){
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?= $DataPerson->getNamePerson()  ?></h3>
                            <?php require("../../../partials/optionMenu.php") ;?>
                        </div>
                        <div class="card-body">
                            <p>
                                <strong><i class="fas fa-edit"></i> Nombres y Apellidos</strong>
                            <p class="text-muted">
                                <?= $DataPerson->getNamePerson() ." - ".$DataPerson->getLastNamePerson()?>
                            </p>
                            <hr>
                            <strong><i class="far fa-address-card"></i> Documento</strong>
                            <p class="text-muted"><?=$DataPerson->getDocumentPerson() ?></p>
                            <hr>
                            <strong><i class="fas fa-eye-dropper"></i> Rh</strong>
                            <p class="text-muted"><?= $DataPerson->getRhPerson(); ?></p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Direccion</strong>
                            <p class="text-muted"><?= $DataPerson->getAdressPerson() ;?></p>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Estado y Rol</strong>
                            <p class="text-muted"><?= $DataPerson->getStatePerson()." - ".$DataPerson->getTypePerson() ?></p>
                            <hr>
                            <strong><i class="fas fa-cash-register"></i> Email</strong>
                            <p class="text-muted"><?= $DataPerson->getEmailPerson(); ?></p>
                            <hr>
                            <strong><i class="far fa-calendar-alt"></i> Fecha de Nacimiento</strong>
                            <p class="text-muted"><?= $DataPerson->getDateBornPerson()->translatedFormat('l, j \\de F Y') ?></p>
                            <p class="text-muted">Tienes <?= $DataPerson->getDateBornPerson()->diffInYears(); ?> Años</p>
                            <hr>
                            <strong><i class="fas fa-mobile-alt"></i> Celular</strong>
                            <p class="text-muted"><?= $DataPerson->getPhonePerson() ;?></p>
                            <hr>
                            <strong><i class="fab fa-keybase"></i> Genero</strong>
                            <p class="text-muted"><?= $DataPerson->getGenerePerson(); ?></p>
                            <hr>
                            <strong><i class="fas fa-user mr-1"></i> Estado</strong>
                            <p class="text-muted"><?= $DataPerson->getStatePerson(); ?></p>
                            <hr>
                            </p>

                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <a role="button" href="index.php" class="btn btn-success float-right" style="margin-right: 5px;">
                                        <i class="fas fa-tasks"></i> Consultar Personal
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a role="button" href="create.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-plus"></i> Crear Personal
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
    <?php require ("../../../partials/scripts.php");?>
</body>
</html>
