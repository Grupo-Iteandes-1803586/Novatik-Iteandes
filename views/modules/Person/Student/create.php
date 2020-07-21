<?php require ("../../../partials/routes.php");?>
<!doctype html>
<html lang="es">
<head>
    <title><?= getenv('TITLE_SITE');?> | Crear Estudiante</title>
    <?php require ("../../../partials/head_imports.php");?>
    <?php require("../../../partials/header.php");?>
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
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
                        <h1>Crear un Nuevo Estudiante</h1>
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
                    <h3 class="card-title">Formulario de Registro del Estudiante</h3>
                    <?php require("../../../partials/optionMenu.php") ;?>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="frmCreateStudent" name="frmCreateStudent" action="../../../../app/Controllers/PersonController.php?action=createStudent">

                    <?php
                    require ("../formPerson.php"); ?>
                    <!--Formulario de los datos del estudio del estudiante-->
                    <div class="card-body">
                        <li class="list-Dates"><i class ="fas fa-address-book" id="icon-iconos"></i>Estudios</li>
                        <hr>
                        <!--Año de Grado-->
                        <div class="form-group row">
                            <label for="gradeYear" class="col-sm-2 col-form-label">Año de Grado</label>
                            <div class="col-sm-10">
                                <input required type="number" maxlength="4" class="form-control" id="gradeYear" name="gradeYear" placeholder="Ingrese el año de grado">
                            </div>
                        </div>
                        <!--Modalidad de grado-->
                        <div class="form-group row">
                            <label for="modality class="col-sm-2 col-form-label">Modalidad</label>
                            <div class="col-sm-10">
                                <select id="modality" name="modality" class="custom-select">
                                    <option value="Bachiler">Bachiller</option>
                                    <option value="Tecnico">Tecnico</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                        </div>
                        <!--Institucion de Grado-->
                        <div class="form-group row">
                            <label for="Institution" class="col-sm-2 col-form-label">Institucion Educativa</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="Institution" name="Institution" placeholder="Ingresa la Institucion Educativa">
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
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <?php require ("../../../partials/footer.php");?>
    <!--</div>-->
    <?php require ("../../../partials/scripts.php");?>
</body>
</html>
