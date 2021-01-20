<?php
require ("../../../partials/routes.php");
use Carbon\Carbon;?>

<!doctype html>
<html lang="en">
<head>
    <head>
        <title><?= getenv('TITLE_SITE');?> | Crear Personal Administrativo</title>
        <?php require ("../../../partials/head_imports.php");?>
        <?php require("../../../partials/header.php");?>
    </head>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php require ("../../../partials/navbar_customation.php");?>
    <?php require ("../../../partials/sliderbar_main_menu.php")?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Crear un Nuevo Personal Administrativo</h1>
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
                        Error al crear el usuario: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Registro del Personal Administrativo</h3>
                    <?php require("../../../partials/optionMenu.php") ;?>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="frmCreateAdmStaff" name="frmCreateAdmStaff" action="../../../../app/Controllers/PersonController.php?action=createAdmStaff">

                    <?php
                    require_once ("../formPerson.php");
                    ?>
                    <div class="card-body">
                    <div class="form-group row">
                        <label for="typePerson" class="col-sm-2 col-form-label">Rol</label>
                        <div class="col-sm-10">
                            <select required id="typePerson" name="typePerson" class="custom-select">
                                <option <?= (!empty($frmSession['typePerson']) && $frmSession['typePerson'] == "Administrador") ? "selected" : ""; ?> value="Administrador">Administrador</option>
                                <option <?= (!empty($frmSession['typePerson']) && $frmSession['typePerson'] == "Secretaria") ? "selected" : ""; ?> value="Secretaria">Empleado</option>
                            </select>
                        </div>
                    </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Enviar</button>
                        <a href="show.php" role="button" class="btn btn-default float-right">Cancelar</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </section>
    </div>
        <!-- /.content-wrapper -->
        <?php require ("../../../partials/footer.php");?>
        <!--</div>-->
        <?php require ("../../../partials/scripts.php");?>
        <script src="../../../components/Js/script.js"></script>
</body>
</html>
