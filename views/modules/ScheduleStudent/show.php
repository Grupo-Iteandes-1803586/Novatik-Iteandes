<?php
require ("../../partials/routes.php");
require_once("../../../app/Controllers/GroupControllers.php");
require_once("../../../app/Controllers/TrainingCompetitionControllers.php");
require_once("../../../app/Models/TrainingCompetition.php");
require_once("../../../app/Models/Group.php");

use App\Controllers\TrainingCompetitionControllers;
use App\Models\TrainingCompetition;
use App\Controllers\GroupControllers;
use App\Models\Group;
use Carbon\Carbon;?>

<!doctype html>
<html lang="en">
<head>
    <head>
        <title><?= getenv('TITLE_SITE');?> | Agregar Materias | Grupos</title>
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
                        <?php$idTP= $_GET["idTrainingCompetition"];
                        $DataCom = TrainingCompetition::searchForID($idTP);?>
                        <h1>Agregar Materias | Grupos </h1>
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
                        Error al Guardar el Horario: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>
            <!-- Horizontal Form -->
            <div class="card card-info">
                <?php if(!empty($_GET["idTrainingCompetition"]) && isset($_GET["idTrainingCompetition"])){
                $DataCom = TrainingCompetition::searchForID($_GET["idTrainingCompetition"]);
                if(!empty($DataCom)){
                ?>
                <div class="card-header">
                    <h3 class="card-title"><?= $DataCom->getDenomination()  ?></h3>
                    <?php require("../../partials/optionMenu.php") ;?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <table id="tblAddGroup" class="datatable table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cod</th>
                                    <th>Grupo</th>
                                    <th>Cantidad</th>
                                    <th>Docente</th>
                                    <th>Dias</th>
                                    <th>Horas</th>
                                    <th>Seleccione</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php

                                    $idG = ($_GET["idTrainingCompetition"]) ;
                                    $arrAddGroup= \App\Controllers\GroupControllers::getAll();
                                    foreach ($arrAddGroup as $group) {
                                    if ( $group->getStateGroup() == "Activo" && $group->getTrainingCompetitionIdTrainingCompetition()->getIdTrainingCompetition() ==  $idG) {
                                    ?>
                                    <td><?php echo $group->getIdGroup(); ?></td>
                                    <td><?php echo $group->getCodeGroup(); ?></td>
                                    <td><?php echo $group->getNameGroup(); ?></td>
                                    <td><?php echo $group->getMaximumSpaceGroup(); ?></td>
                                    <td><?php echo $group->getTeacherIdTeacher()->getIdTeacher(); ?></td>
                                    <td><?php
                                        $checked_arr = explode("|", $group->getScheduleIdSchedule()->getDaySchedule());
                                        $daysArray = array("Lu" => "Lunes", "Ma" => "Martes", "Mi" => "Miércoles", "Ju" => "Jueves", "Vi" => "Viernes", "Sa" => "Sábado", "Do" => "Domingo");
                                        $check = array();
                                        foreach ($daysArray as $key => $value) {
                                            $checked = "";
                                            if (in_array($key, $checked_arr)) {
                                                array_push($check, $value);
                                            }
                                        }
                                        echo implode(',', $check);?>
                                    <td><?php echo $group->getScheduleIdSchedule()->getStartHourSchedule()->toTimeString(); ?> <br>
                                        <?php echo $group->getScheduleIdSchedule()->getEndHourSchedule()->toTimeString(); ?></td>
                                    <td><input type="checkbox" id="autorizar" name="autorizar[]" ></td>
                                </tr>
                                <?php }
                                }?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-auto mr-auto">
                                <a role="button" href="create.php" class="btn btn-success float-right" style="margin-right: 5px;">
                                    <i class="fas fa-tasks"></i> Consultar Materias
                                </a>
                            </div>
                            <div class="col-auto">
                                <a role="button" href="index.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-save"></i> Guardar Materia
                                </a>
                            </div>
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
            <!-- /.card-body -->
        </section>
    </div>
    <?php require('../../partials/footer.php'); ?>
</div>
<!-- ./wrapper -->
<?php require('../../partials/scripts.php'); ?>
<script src="../../components/Js/script.js"></script>
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
            ],
            "pagingType": "full_numbers",
            "responsive": true,
            "stateSave": true, //Guardar la configuracion del usuario
        });
    });
</script>
</body>
</html>