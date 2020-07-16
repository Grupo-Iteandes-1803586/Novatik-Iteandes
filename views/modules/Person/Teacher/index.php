<?php
require_once("../../../partials/routes.php");
require_once("../../../../app/Controllers/PersonController.php");
require_once("../../../../app/Controllers/TeacherStudiesControllers.php");
require_once("../../../../app/Controllers/LenguagesControllers.php");
require_once("../../../../app/Controllers/ExperienceControllers.php");

use App\Controllers\PersonController;
use App\Controllers\TeacherStudiesControllers;
use App\Controllers\LenguagesControllers;
use App\Controllers\ExperienceControllers;?>
<!doctype html>
<html lang="es">
<head>
    <title><?=getenv('TITLE_SITE');?> | Docente</title>
    <?php
    require("../../../partials/head_imports.php") ;
    require("../../../partials/header.php") ;
    ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-responsive/css/responsive.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-buttons/css/buttons.bootstrap4.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <?php require ("../../../partials/navbar_customation.php");?>
    <?php require ("../../../partials/sliderbar_main_menu.php");?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Consultar Docente</h1>
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

            <?php if(!empty($_GET['respuesta']) && !empty($_GET['action'])){ ?>
                <?php if ($_GET['respuesta'] == "correcto"){ ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Correcto!</h5>
                        <?php if ($_GET['action'] == "create"){ ?>
                            El Docente ha sido creado con exito!
                        <?php }else if($_GET['action'] == "update"){ ?>
                            Los datos del Docente se han sido actualizados correctamente!
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gestionar Docentes</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="iconP fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="iconP fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto mr-auto"></div>
                        <div class="col-auto">
                            <a role="button" href="create.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-plus"></i> Crear Docente
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table id="tblTeacher" class="datatable table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Documento</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Fecha de Nacimiento</th>
                                    <th>Rh</th>
                                    <th>E-mail</th>
                                    <th>Celular</th>
                                    <th>Direccion</th>
                                    <th>Genero</th>
                                    <th>Usuario</th>
                                    <th>Password</th>
                                    <th>Tipo Usuario</th>
                                    <th>Edad</th>
                                    <th>Estado</th>
                                    <th>Foto</th>
                                    <th>Opciones</th>
                                    <!--Datos de TacherStudies-->
                                    <th>#</th>
                                    <th>Titulo Univercitario</th>
                                    <th>Año</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                    <!--Datos de Experiencia-->
                                    <th>#</th>
                                    <th>Intitucion Educativa</th>
                                    <th>Dedicacion</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha Finalizacion</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                    <!--Datos Idiomas-->
                                    <th>#</th>
                                    <th>Idioma</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $arrPerson= \App\Controllers\PersonController::getAll();
                                foreach ($arrPerson as $personC){
                                    ?>
                                    <tr>
                                        <td><?php echo $personC->getIdPerson(); ?></td>
                                        <td><?php echo $personC->getDocumentPerson(); ?></td>
                                        <td><?php echo $personC->getNamePerson(); ?></td>
                                        <td><?php echo $personC->getLastNamePerson(); ?></td>
                                        <td><?php echo $personC->getDateBornPerson(); ?></td>
                                        <td><?php echo $personC->getRhPerson(); ?></td>
                                        <td><?php echo $personC->getEmailPerson(); ?></td>
                                        <td><?php echo $personC->getPhonePerson(); ?></td>
                                        <td><?php echo $personC->getAdressPerson(); ?></td>
                                        <td><?php echo $personC->getGenerePerson(); ?></td>
                                        <td><?php echo $personC->getUserPerson(); ?></td>
                                        <td><?php echo $personC->getPasswordPerson(); ?></td>
                                        <td><?php echo $personC->getTypePerson(); ?></td>
                                        <td><?php echo $personC->generateAge($personC->getDateBornPerson());?></td>
                                        <td><?php echo $personC->getStatePerson(); ?></td>
                                        <td><?php echo $personC->getPhotoPerson(); ?></td> <td>
                                            <a href="edit.php?idPerson=<?php echo $personC->getIdPerson(); ?>" type="button" data-toggle="tooltip" title="Actualizar" class="btn docs-tooltip btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                            <a href="show.php?idPerson=<?php echo $personC->getIdPerson(); ?>" type="button" data-toggle="tooltip" title="Ver" class="btn docs-tooltip btn-warning btn-xs"><i class="fa fa-eye"></i></a>
                                            <?php if ($personC->getStatePerson() != "Activo"){ ?>
                                                <a href="../../../../app/Controllers/PersonController.php?action=active&idPerson=<?php echo $personC->getIdPerson(); ?>" type="button" data-toggle="tooltip" title="Activar" class="btn docs-tooltip btn-success btn-xs"><i class="fa fa-check-square"></i></a>
                                            <?php }else{ ?>
                                                <a type="button" href="../../../../app/Controllers/PersonController.php?action=inactive&idPerson=<?php echo $personC->getIdPerson(); ?>" data-toggle="tooltip" title="Inactivar" class="btn docs-tooltip btn-danger btn-xs"><i class="fa fa-times-circle"></i></a>
                                            <?php } ?>
                                        </td></tr>
                                <?php } ?>
                                        <!-- Llamando Los Datos de TeacherStudies-->
                                        <?php
                                        $arrStudies= \App\Controllers\TeacherStudiesControllers::getAll();
                                        foreach ($arrStudies as $Studies){
                                        ?>
                                        <td><?php echo $Studies->getIdTeacherStudies(); ?></td>
                                        <td><?php echo $Studies->getTitleTeacherStudies(); ?></td>
                                        <td><?php echo $Studies->getYearStudyTeacher(); ?></td>
                                        <td><?php echo $Studies->getStateTeacherStudies(); ?></td>
                                    <td>
                                            <a href="edit.php?idTeacherStudies=<?php echo $Studies->getIdTeacherStudies(); ?>" type="button" data-toggle="tooltip" title="Actualizar" class="btn docs-tooltip btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                            <a href="show.php?idTeacherStudies=<?php echo $Studies->getIdTeacherStudies(); ?>" type="button" data-toggle="tooltip" title="Ver" class="btn docs-tooltip btn-warning btn-xs"><i class="fa fa-eye"></i></a>
                                            <?php if ($Studies->getStateTeacherStudies() != "Activo"){ ?>
                                                <a href="../../../../app/Controllers/TeacherStudiesControllers.php?action=active&idTeacherStudies=<?php echo $Studies->getIdTeacherStudies(); ?>" type="button" data-toggle="tooltip" title="Activar" class="btn docs-tooltip btn-success btn-xs"><i class="fa fa-check-square"></i></a>
                                            <?php }else{ ?>
                                                <a type="button" href="../../../../app/Controllers/TeacherStudiesControllers.php?action=inactive&idTeacherStudies=<?php echo $Studies->getIdTeacherStudies(); ?>" data-toggle="tooltip" title="Inactivar" class="btn docs-tooltip btn-danger btn-xs"><i class="fa fa-times-circle"></i></a>
                                            <?php } ?>
                                        </td>


                                <?php } ?>

                                <!--Llamando Los Datos de  Experiencia-->
                                <?php
                                $arrExperience= \App\Controllers\ExperienceControllers::getAll();
                                foreach ($arrExperience as $Experience){
                                    ?>
                                        <td><?php echo $Experience->getIdExperience(); ?></td>
                                        <td><?php echo $Experience->getInstitutionExperience(); ?></td>
                                        <td><?php echo $Experience->getDedicationExperience(); ?></td>
                                        <td><?php echo $Experience->getStartExperience(); ?></td>
                                        <td><?php echo $Experience->getEndExperince(); ?></td>
                                        <td><?php echo $Experience->getstateExperience(); ?></td>

                                        <td>
                                            <a href="edit.php?idExperience=<?php echo $Experience->getIdTeacherStudies(); ?>" type="button" data-toggle="tooltip" title="Actualizar" class="btn docs-tooltip btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                            <a href="show.php?idExperience=<?php echo $Experience->getIdTeacherStudies(); ?>" type="button" data-toggle="tooltip" title="Ver" class="btn docs-tooltip btn-warning btn-xs"><i class="fa fa-eye"></i></a>
                                            <?php if ($Experience->getstateExperience() != "Activo"){ ?>
                                                <a href="../../../../app/Controllers/ExperienceControllers.php?action=active&idExperience=<?php echo $Experience->getIdExperience(); ?>" type="button" data-toggle="tooltip" title="Activar" class="btn docs-tooltip btn-success btn-xs"><i class="fa fa-check-square"></i></a>
                                            <?php }else{ ?>
                                                <a type="button" href="../../../../app/Controllers/ExperienceControllers.php?action=inactive&idExperience=<?php echo $Experience->getIdExperience(); ?>" data-toggle="tooltip" title="Inactivar" class="btn docs-tooltip btn-danger btn-xs"><i class="fa fa-times-circle"></i></a>
                                            <?php } ?>
                                        </td>
                                <?php } ?>
                                            <!--Llamando Los Datos de Lenguaje-->
                                            <?php
                                            $arrLenguages= \App\Controllers\LenguagesControllers ::getAll();
                                            foreach ($arrLenguages as $Lenguages){
                                            ?>
                                        <td><?php echo $Lenguages->getIdLenguages(); ?></td>
                                        <td><?php echo $Lenguages->getNameLenguages(); ?></td>
                                        <td><?php echo $Lenguages->getStateLenguague(); ?></td>

                                        <td>
                                            <a href="edit.php?idLenguages=<?php echo $Lenguages->getIdLenguages(); ?>" type="button" data-toggle="tooltip" title="Actualizar" class="btn docs-tooltip btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                            <a href="show.php?idLenguages=<?php echo $Lenguages->getIdLenguages(); ?>" type="button" data-toggle="tooltip" title="Ver" class="btn docs-tooltip btn-warning btn-xs"><i class="fa fa-eye"></i></a>
                                            <?php if ($Lenguages->getStateLenguages() != "Activo"){ ?>
                                                <a href="../../../../app/Controllers/LenguagesController.php?action=active&idExperience=<?php echo $Lenguages->getIdLenguages(); ?>" type="button" data-toggle="tooltip" title="Activar" class="btn docs-tooltip btn-success btn-xs"><i class="fa fa-check-square"></i></a>
                                            <?php }else{ ?>
                                                <a type="button" href="../../../../app/Controllers/LenguagesController.php?action=inactive&idExperience=<?php echo $Lenguages->getIdLenguages(); ?>" data-toggle="tooltip" title="Inactivar" class="btn docs-tooltip btn-danger btn-xs"><i class="fa fa-times-circle"></i></a>
                                            <?php } ?>
                                        </td>

                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require ('../../../partials/footer.php');?>
</div>
<!-- ./wrapper -->
<?php require ('../../../partials/scripts.php');?>
<!-- DataTables -->
<script src="<?= $adminlteURL ?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-responsive/js/dataTables.responsive.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-responsive/js/responsive.bootstrap4.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/dataTables.buttons.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.bootstrap4.js"></script>
<script src="<?= $adminlteURL ?>/plugins/jszip/jszip.js"></script>
<script src="<?= $adminlteURL ?>/plugins/pdfmake/pdfmake.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.html5.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.print.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.colVis.js"></script>

<script>
    $(function () {
        $('.datatable').DataTable({
            "dom": 'Bfrtip',
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "language": {
                "url": "../../components/Spanish.json" //Idioma
            },
            "buttons": [
                'copy', 'print', 'excel', 'pdf'
            ],
            "pagingType": "full_numbers",
            "responsive": true,
            "stateSave" : true, //Guardar la configuracion
        });
    });
</script>
</body>
</html>