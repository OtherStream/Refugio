<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <img src="<?= $baseUrl ?>img/logo.jpg" alt="">
        <h3>Refugio Animal Alfa A.C.</h3>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- OPCIONES SIN INICIO DE SESION -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseUrl ?>index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseUrl ?>Adoptar.php">Adoptar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseUrl ?>adoptados.php">Adoptados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseUrl ?>Productos.php">Productos</a>
                </li>

                <!-- OPCIONES CON INICIO DE SESION: USUARIO-->
                <?php if (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] === 'usuario'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>lista_solicitudes.php">Mis solicitudes</a>
                    </li>
                <?php endif; ?>
                
                <!-- OPCIONES CON INICIO DE SESION: ADMIN-->
                <?php if (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>lista_solicitudes.php">Solicitudes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Agregar
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= $baseUrl ?>formularios/f-adopcion.php">En adopción</a></li>
                            <li><a class="dropdown-item" href="<?= $baseUrl ?>formularios/f-adoptados.php">Adoptados</a></li>
                            <li><a class="dropdown-item" href="<?= $baseUrl ?>formularios/f-productos.php">Productos</a></li>
                            <li><a class="dropdown-item" href="<?= $baseUrl ?>formularios/f-avisos.php">Avisos</a></li>
                            <li><a class="dropdown-item" href="<?= $baseUrl ?>formularios/f-servicios.php">Servicios</a></li>
                            <li><a class="dropdown-item" href="<?= $baseUrl ?>Lista_EnAdopcion.php">Lista adopción</a></li>
                            <li><a class="dropdown-item" href="<?= $baseUrl ?>Lista_Usuarios.php">Lista usuarios</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="ms-auto d-flex align-items-center gap-2">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <form action="<?= $baseUrl ?>logout.php" method="post" class="d-inline">
                        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                    </form>
                <?php else: ?>
                    <?php
                    $paginaActual = basename($_SERVER['PHP_SELF']);
                    if ($paginaActual === 'login.php'):
                        ?>
                        <a href="<?= $baseUrl ?>registro.php" class="btn btn-outline-light">Registrarse</a>
                    <?php elseif ($paginaActual === 'registro.php'): ?>
                        <a href="<?= $baseUrl ?>login.php" class="btn btn-light">Login</a>
                    <?php else: ?>
                        <a href="<?= $baseUrl ?>login.php" class="btn btn-light">Login</a>
                        <a href="<?= $baseUrl ?>registro.php" class="btn btn-outline-light">Registrarse</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>