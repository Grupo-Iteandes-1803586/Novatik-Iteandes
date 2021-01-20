<?php require ("../../partials/routes.php");
require_once("../../../app/Controllers/EnrollmentControllers.php");
require_once("../../../app/Controllers/EnrollmentCompetitionControllers.php");
require_once("../../../app/Controllers/StudentControllers.php");
require_once("../../../app/Models/Student.php");

use App\Controllers\EnrollmentControllers;
use App\Controllers\EnrollmentCompetitionControllers;
use App\Controllers\StudentControllers;
use App\Models\Student;
use Carbon\Carbon;
?>

<!doctype html>
<html lang="en">
<head>
    <title><?=getenv('TITLE_SITE');?> | Consultar Matricula</title>
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
                        <h1>Consultar Matricula</h1>
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

        <section class="content">
            <?php if(!empty($_GET['respuesta'])){ ?>
                <?php if ($_GET['respuesta'] != "correcto"){ ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        Error al Consultar la Matricula: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>
        </section>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Consultar Matricula</h3>
                <?php require("../../partials/optionMenu.php") ;?>
            </div>
            <!-- /.card-header -->
               <div class="card-body">
                   <!-- form start -->
                   <form class="form-horizontal" method="post" id="frmObtEnrollment" name="frmObtEnrollment" action="../../../app/Controllers/EnrollmentControllers.php?action=infoCreateE">
                   <!--Documento -->
                        <div class="form-group row">
                            <label for="documentPerson" class="col-sm-2 col-form-label">Documento</label>
                            <div class="col-sm-10">
                                <input required type="text" autocomplete="off" maxlength="12" class="form-control" id="documentPerson" name="documentPerson" placeholder="Ingrese el Documento a matricular">
                            </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Enviar</button>
                        <a href="infoCreate.php" role="button" class="btn btn-default float-right">Cancelar</a>
                    </div>
                   </form>
                    <!-- /.card-footer -->
                </div>
        </div>
    </div>

</div>
</body>
</html>
