<?php
require ("../../partials/routes.php");
use Carbon\Carbon;?>

<!doctype html>
<html lang="en">
<head>
    <head>
        <title><?= getenv('TITLE_SITE');?> | Agregar Materias</title>
        <?php require ("../../partials/head_imports.php");?>
        <?php require("../../partials/header.php");?>
    </head>
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require ("../../partials/navbar_customation.php");?>
    <?php require ("../../partials/sliderbar_main_menu.php")?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Agregar Materias</h1>
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
                <?php if ($_GET['respuesta'] != "correcto"){ ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        Error al crear el Horario: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="frmaddCompe" name="frmaddCompe" action="../../../app/Controllers/PersonController.php?action=createAdmStaff">
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-sm-12 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        Agregar Materias | Ciclos
                                    </h3>
                                    <div class="card-tools">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#cicleI" data-toggle="tab">Ciclo I</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#cicleII" data-toggle="tab">Ciclo II</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#cicleIII" data-toggle="tab">Ciclo III</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#cicleIV" data-toggle="tab">Ciclo IV</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#cicleV" data-toggle="tab">Ciclo V</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content p-0">
                                        <!-- Morris chart - Sales -->
                                        <div class="chart tab-pane active" id="cicleI" style="position: relative; height: 300px;">
                                            <p>helooo</p>
                                        </div>

                                        <div class="chart tab-pane" id="cicleII" style="position: relative; height: 300px;">
                                            <p>Hola</p>
                                        </div>

                                        <div class="chart tab-pane" id="cicleIII" style="position: relative; height: 300px;">
                                            <p>kakuja</p>
                                        </div>

                                        <div class="chart tab-pane" id="cicleIV" style="position: relative; height: 300px;">
                                            <p>darkd</p>
                                        </div>

                                        <div class="chart tab-pane" id="cicleV" style="position: relative; height: 300px;">
                                            <p>fre</p>
                                        </div>

                                    </div>
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>
                    </div>
                </form>
            </div>

        </section>
    </div>
    <?php require('../../partials/footer.php'); ?>
</div>
<!-- ./wrapper -->
<?php require('../../partials/scripts.php'); ?>
<script src="../../components/Js/script.js"></script>
</body>
</html>
