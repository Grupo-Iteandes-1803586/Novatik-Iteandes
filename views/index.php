<?php require ("partials/routes.php"); ?>
<?php require("partials/check_login.php"); ?>
<!doctype html>
<html lang="es">
<head>
    <title><?= getenv('TITLE_SITE')?> | Home</title>
    <?php require("partials/head_imports.php");?>
    <?php require("partials/header.php")?>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
    <div class="wrapper">
        <?php require ("partials/navbar_customation.php");?>
        <?php require ("partials/sliderbar_main_menu.php")?>
        <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">

                <div class="card-body">
                    Bienvenido Administrador en este Portal encontraras todo lo relacionado con las actividades del
                    instituto <?= getenv('TITLE_SITE')?>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        </div>
        <?php require ("partials/footer.php");?>
    </div>
    <?php require ("partials/scripts.php");?>
</body>
</html>
