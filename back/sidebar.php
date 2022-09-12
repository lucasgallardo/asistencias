<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <img src="img/logo.png" class="img-thumbnail" alt="Octopus">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="../ventas/index.php" target="_blank" rel="noopener noreferrer">
            <i class="fas fa-fw fa-octopus-alt"></i>
            <span>Tienda</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Componentes
    </div>
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Socios</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="ingresos.php">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Ingresos</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="estadisticas.php">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Estadísticas</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="caja.php">
            <i class="fas fa-fw fa-cash-register"></i>
            <span>Caja</span></a>
    </li>

    <!-- <li class="nav-item active">
        <a class="nav-link" href="departamentos.php">
            <i class="fas fa-fw fa-building"></i>
            <span>Departamentos</span></a>
    </li> -->
    <?php if(is_admin()){ ?>
        <li class="nav-item active">
            <a class="nav-link" href="users.php">
                <i class="fas fa-fw fa-sitemap"></i>
                <span>Usuarios</span></a>
        </li>
    <?php } ?>

    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>