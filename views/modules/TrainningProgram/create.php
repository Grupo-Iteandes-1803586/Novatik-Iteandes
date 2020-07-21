<?php require ("../../partials/routes.php");?>
<!doctype html>
<html lang="es">
<head>
    <title><?=getenv('TITLE_SITE');?> | Agregar Programa</title>
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
                        <h1>Crear Programa de Formacion</h1>
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
                        Error al crear el nuevo Programa de Formacion: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <!--Formulario del Programa de Formacion-->
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Crear Programa de Formacion</h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="frmCreateProgram" name="frmCreateProgram" action="../../../app/Controllers/TrainingProgramController.php?action=create">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="codeTrainingProgram" class="col-sm-2 col-form-label">Codigo Programa</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="codeTrainingProgram" name="codeTrainingProgram" placeholder="Ingrese el Codigo de Programa de Formacion">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nameTrainingProgram" class="col-sm-2 col-form-label">Nombre del Programa de Formacion</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="nameTrainingProgram" name="nameTrainingProgram" placeholder="Ingrese el nombre de Programa de Formacion">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="version" class="col-sm-2 col-form-label">Version</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="version" name="version" placeholder="Version">
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
            </div>
            <!-- /.card -->
        </section>
    </div>
    <!-- /.content-wrapper -->
    <?php require ("../../partials/footer.php");?>
</div>
<!--</div>-->
<?php require ("../../partials/scripts.php");?>
</body>
</html>