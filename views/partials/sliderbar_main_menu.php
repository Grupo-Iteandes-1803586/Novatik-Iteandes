<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="<?= $baseURL ?>/views/index.php" class="d-block">Inicio</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                <li class="nav-item has-treeview"> <?= strpos($_SERVER['REQUEST_URI'],'datos') ? 'menu-open' : '' ?>
                    <a href="#" class="nav-link"><?= strpos($_SERVER['REQUEST_URI'],'datos') ? 'active' : '' ?>
                        <i class="nav-icon fas fa-id-card"></i>
                        <p>
                           Datos Personales
                        </p>
                    </a>
                </li>
                </li>
                <li class="nav-header">Modulos Principales</li>
                <!--Gestionar Docente-->
                <li class="nav-item has-treeview menu-open">
                <li class="nav-item has-treeview "><?= strpos($_SERVER['REQUEST_URI'],'docente') ? 'menu-open' : '' ?>
                    <a href="#" class="nav-link active"><?= strpos($_SERVER['REQUEST_URI'],'docente') ? 'active' : '' ?>
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Gestionar Docentes
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Person/Teacher/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Consultar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Person/Teacher/create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Registrar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                </li>
                <!--Modulo Gestionar Semestre-->
                <li class="nav-item has-treeview menu-open">
                <li class="nav-item has-treeview "><?= strpos($_SERVER['REQUEST_URI'],'semester') ? 'menu-open' : '' ?>
                    <a href="#" class="nav-link active"><?= strpos($_SERVER['REQUEST_URI'],'semester') ? 'active' : '' ?>
                        <i class="nav-icon fas fa-calendar-plus"></i>
                        <p>
                            Gestionar Semestre
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Semester/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Consultar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Semester/create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Registrar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                </li>
                <!--Modulo Gestionar Programa de Formacion-->
                <li class="nav-item has-treeview menu-open">
                <li class="nav-item has-treeview "><?= strpos($_SERVER['REQUEST_URI'],'program') ? 'menu-open' : '' ?>
                    <a href="#" class="nav-link active"><?= strpos($_SERVER['REQUEST_URI'],'program') ? 'active' : '' ?>
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Gestionar Programa
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/TrainningProgram/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Consultar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/TrainningProgram/create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Registrar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                </li>
                <!--Modulo Gestionar Grupos-->
                <li class="nav-item has-treeview menu-open">
                <li class="nav-item has-treeview "><?= strpos($_SERVER['REQUEST_URI'],'group') ? 'menu-open' : '' ?>
                    <a href="#" class="nav-link active"><?= strpos($_SERVER['REQUEST_URI'],'group') ? 'active' : '' ?>
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Gestionar Grupo
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Group/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Consultar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Group/create.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Registrar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                </li>
                <!--Modulo Gestionar Matricula-->
                <li class="nav-item has-treeview menu-open">
                <li class="nav-item has-treeview "><?= strpos($_SERVER['REQUEST_URI'],'enrollment') ? 'menu-open' : '' ?>
                    <a href="#" class="nav-link active"><?= strpos($_SERVER['REQUEST_URI'],'enrollment') ? 'active' : '' ?>
                        <i class="nav-icon fas fa-file-signature"></i>
                        <p>
                            Gestionar Matricula
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Enrollment/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Consultar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Enrollment/infoCreate.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Registrar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                </li>
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>