<?php
require ("../../partials/routes.php");
require ("../../../app/Controllers/SemesterControllers.php");
use App\Controllers\SemesterControllers;
use Carbon\Carbon;
?>
<!doctype html>
<html lang="es">
<head>
    <title><?=getenv('TITLE_SITE') ?> | Editar Semestre</title>
    <?php require ("../../partials/head_imports.php");?>
    <?php require ("../../partials/header.php");?>
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
                        <h1>Editar Semestre</h1>
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
                        Error al Editar el Semestre: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['idSemester'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Semestre</h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <!-- /.card-header -->
                <?php if(!empty($_GET["idSemester"]) && isset($_GET["idSemester"])){ ?>
                    <p>
                    <?php
                    $DataSemester = SemesterControllers::searchForID($_GET["idSemester"]);
                    if(!empty($DataSemester)){
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="frmEditSemester" name="frmEditSemester" action="../../../app/Controllers/SemesterControllers.php?action=edit">
                            <input id="idSemester" name="idSemester" value="<?php echo $DataSemester->getIdSemester(); ?>" hidden required="required" type="text">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nameSemester" class="col-sm-2 col-form-label">Nombre del Semestre</label>
                                    <div class="col-sm-10">
                                        <input required type="text" maxlength="240" class="form-control" id="nameSemester" name="nameSemester" value="<?= $DataSemester->getNameSemester(); ?>" placeholder="Ingrese el nombre del Semestre">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="descriptionSemester" class="col-sm-2 col-form-label">Descripcion del Semestre</label>
                                    <div class="col-sm-10">
                                        <input required type="text" maxlength="480" class="form-control" id="descriptionSemester" name="descriptionSemester" value="<?= $DataSemester->getDescriptionSemester(); ?>" placeholder="Ingrese la Descripcion">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="starDateSemester" class="col-sm-2 col-form-label">Fecha de Inicio</label>
                                    <div class="col-sm-10">
                                        <input required type="date" max="<?= Carbon::now()->subYear(12)->format('Y-m-d') ?>" class="form-control" id="starDateSemester" name="starDateSemester" value="<?= $DataSemester->getStarDateSemester()->toDateString() ?>" placeholder="Ingrese la fecha de Inicio">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="endDateSemester" class="col-sm-2 col-form-label">Fecha de Finalizacion</label>
                                    <div class="col-sm-10">
                                        <input required type="date" max="<?= Carbon::now()->subYear(12)->format('Y-m-d') ?>" class="form-control" id="endDateSemester" name="endDateSemester" value="<?= $DataSemester->getEndDateSemester()->toDateString() ?>" placeholder="Ingrese la fecha de Finalizacion Academica">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="startDate50" class="col-sm-2 col-form-label">Fecha de Inicio Primer Corte Academico</label>
                                    <div class="col-sm-10">
                                        <input required type="date" max="<?= Carbon::now()->subYear(12)->format('Y-m-d') ?>" class="form-control" id="startDate50" name="startDate50" value="<?= $DataSemester->getStartDate50()->toDateString() ?>" placeholder="Ingrese la fecha de Inicio del primer corte">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="endDate50" class="col-sm-2 col-form-label">Fecha de Finalizacion Primer Corte Academico</label>
                                    <div class="col-sm-10">
                                        <input required type="date" max="<?= Carbon::now()->subYear(12)->format('Y-m-d') ?>" class="form-control" id="endDate50" name="endDate50" value="<?= $DataSemester->getEndDate50()->toDateString()?>" placeholder="Ingrese la fecha de Finalizacion del primer corte">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="starDate2Semester" class="col-sm-2 col-form-label">Fecha de Inicio Segundo Corte Academico</label>
                                    <div class="col-sm-10">
                                        <input required type="date" max="<?= Carbon::now()->subYear(12)->format('Y-m-d') ?>" class="form-control" id="starDate2Semester" name="starDate2Semester" value="<?= $DataSemester->getStarDate2Semester()->toDateString()?>" placeholder="Ingrese la fecha de Inicio del 2do corte">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="endDate2Semester" class="col-sm-2 col-form-label">Fecha de Finalizacion 2do Corte</label>
                                    <div class="col-sm-10">
                                        <input required type="date" max="<?= Carbon::now()->subYear(12)->format('Y-m-d') ?>" class="form-control" id="endDate2Semester" name="endDate2Semester" value="<?= $DataSemester->getEndDate2Semester()->toDateString() ?>" placeholder="Ingrese la fecha de Finalizacion del 2do corte">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="statuSemester" class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-10">
                                        <select id="statuSemester" name="statuSemester" class="custom-select">
                                            <option <?= ($DataSemester->getStatuSemester() == "Activo") ? "selected":""; ?> value="Activo">Activo</option>
                                            <option <?= ($DataSemester->getStatuSemester() == "Inactivo") ? "selected":""; ?> value="Inactivo">Inactivo</option>
                                        </select>
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
                    <?php }else{ ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            No se encontro ningun registro con estos parametros de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                        </div>
                    <?php } ?>
                    </p>
                <?php } ?>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require ('../../partials/footer.php');?>
</div>
<!-- ./wrapper -->
<?php require ('../../partials/scripts.php');?>
</body>
</html>