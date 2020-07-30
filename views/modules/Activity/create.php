//vas a poner las vistas de archive y activity
<?php require ("../../../partials/routes.php");
use Carbon\Carbon;?>
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
                        Error al crear el Actividad: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Registro del Estudiante</h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="frmCreateActivity" name="frmCreateActivity" action="../../../app/Controllers/ActivityControllers.php?action=create">

                    <!--Formulario de los datos de la actividad-->
                    <div class="card-body">
                        <li class="list-Dates"><i class ="fas fa-address-book" id="icon-iconos"></i>Actividad</li>
                        <hr>
                        <!--codigoActivity-->
                        <div class="form-group row">
                            <label for="codeActivity" class="col-sm-2 col-form-label">Codigo Actividad</label>
                            <div class="col-sm-10">
                                <input required type="Number" class="form-control" id="codeActivity" name="codeActivity" placeholder="Codigo Actividad">
                            </div>
                        </div>
                        <!--nameActivity-->
                        <div class="form-group row">
                            <label for="nameActivity" class="col-sm-2 col-form-label">Nombre Actividad</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="nameActivity" name="nameActivity" placeholder="Nombre Actividad">
                            </div>
                        </div>
                        <!--Descripcion-->
                        <div class="form-group row">
                            <label for="descriptionActivity" class="col-sm-2 col-form-label">Descripcion</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="descriptionActivity" name="descriptionActivity" placeholder="Descripcion">
                            </div>
                        </div>
                        <!--Tipo de Activida-->
                        <div class="form-group row">
                            <label for="typeActivity" class="col-sm-2 col-form-label">Tipo de Actividad</label>
                            <div class="col-sm-10">
                                <select id="typeActivity" name="typeActivity" class="custom-select">
                                    <option value="Desempeño">Desempeño</option>
                                    <option value="Producto">Producto</option>
                                    <option value="Conocimiento">Conocimiento</option>
                                </select>
                            </div>
                        </div>
                        <!--Resultados de Actividad-->
                        <div class="form-group row">
                            <label for="LearningResult_idLearningResult" class="col-sm-2 col-form-label">Resultados de Actividad</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="LearningResult_idLearningResult" name="LearningResult_idLearningResult" placeholder="Resultados de Actividad">
                            </div>
                        </div>
                    </div>
                    <!------------------------datos de archivo-------------------------->

                    <li class="list-Dates"><i class ="fas fa-address-book" id="icon-iconos"></i>Archivo</li>
                    <hr>
                    <!--nombre archivo-->
                    <div class="form-group row">
                        <label for="nameArchive" class="col-sm-2 col-form-label">Nombre Archivo</label>
                        <div class="col-sm-10">
                            <input required type="text" class="form-control" id="nameArchive" name="nameArchive" placeholder="Nombre Archivo">
                        </div>
                    </div>
                    <!--Descripcion del Archivo-->
                    <div class="form-group row">
                        <label for="descriptionArchive" class="col-sm-2 col-form-label">Descripcion del Archivo</label>
                        <div class="col-sm-10">
                            <input required type="text" class="form-control" id="descriptionArchive" name="descriptionArchive" placeholder="Descripcion del Archivo">
                        </div>
                    </div>

                    <!--Ruta de Archivo-->
                    <div class="form-group row">
                        <label for="rutaArchive" class="col-sm-2 col-form-label">Ruta de Archivo</label>
                        <div class="col-sm-10">
                            <input required type="text" class="form-control" id="rutaArchive" name="rutaArchive" placeholder="Ruta de Archivo">
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
        </section>
    </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php require ("../../partials/footer.php");?>
<!--</div>-->
<?php require ("../../partials/scripts.php");?>
</body>
</html>
