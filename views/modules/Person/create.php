<?php require ("../../partials/routes.php");?>
<!doctype html>
<html lang="es">
<head>
    <title><?= getenv('TITLE_SITE');?> | Docente</title>
    <?php require ("../../partials/head_imports.php");?>
    <?php require("../../partials/header.php");?>
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
                            <h1>Crear un Nuevo Docente</h1>
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


                <?php require ("../../partials/formPerson.php");?>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <?php require ("../../partials/footer.php");?>
    <!--</div>-->
<?php require ("../../partials/scripts.php");?>
</body>
</html>
