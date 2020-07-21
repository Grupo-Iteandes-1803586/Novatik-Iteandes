<?php require ("../../partials/routes.php");?>
<!doctype html>
<html lang="es">
<head>
    <title><?= getenv('TITLE_SITE')?> | Crear Semestre</title>
    <?php require("../../partials/head_imports.php") ;?>
    <?php require("../../partials/header.php");?>

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
                        <h1>Crear Semestre Academico</h1>
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
                        Error al crear el nuevo Semestre: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <!--Formulario del semestre-->
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Crear Semestre Academico</h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="frmCreateSemester" name="frmCreateSemester" action="../../../app/Controllers/SemesterControllers.php?action=create">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nameSemester" class="col-sm-2 col-form-label">Nombres Semestre</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="nameSemester" name="nameSemester" placeholder="Ingrese el nombre de Semestre">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="descriptionSemester" class="col-sm-2 col-form-label">Descripcion</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="descriptionSemester" name="descriptionSemester" placeholder="Ingrese el nombre de Semestre">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="starDateSemester" class="col-sm-2 col-form-label">Fecha de Inicio del semestre</label>
                            <div class="col-sm-10">
                                <input required type="date" class="form-control" id="starDateSemester" name="starDateSemester" placeholder="Ingrese la fecha de inicio">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="endDateSemester" class="col-sm-2 col-form-label">Fecha de cierre del semestre</label>
                            <div class="col-sm-10">
                                <input required type="date" class="form-control" id="endDateSemester" name="endDateSemester" placeholder="Ingrese la fecha de cierre">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="startDate50" class="col-sm-2 col-form-label">Fecha de Inicio del 1er 50</label>
                            <div class="col-sm-10">
                                <input required type="date" class="form-control" id="startDate50" name="startDate50" placeholder="Ingrese la fecha de inicio">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="endDate50" class="col-sm-2 col-form-label">Fecha de cierre del 1er 50</label>
                            <div class="col-sm-10">
                                <input required type="date" class="form-control" id="endDate50" name="endDate50" placeholder="Ingrese la fecha de inicio">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="starDate2Semester" class="col-sm-2 col-form-label">Fecha de Inicio del 2do 50</label>
                            <div class="col-sm-10">
                                <input required type="date" class="form-control" id="starDate2Semester" name="starDate2Semester" placeholder="Ingrese la fecha de inicio">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="endDate2Semester" class="col-sm-2 col-form-label">Fecha de Inicio de cierre del 2do 50</label>
                            <div class="col-sm-10">
                                <input required type="date" class="form-control" id="endDate2Semester" name="endDate2Semester" placeholder="Ingrese la fecha de inicio">
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
