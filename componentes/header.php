<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <img src="../img/logo.jpg" alt="">
        <h3>Refugio Animal Alfa A.C.</h3>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Adoptar.php">Adoptados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adoptados.php">Adoptados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Productos.php">Productos</a>
                </li>
                <?php if (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Agregar
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= $baseUrl ?>formularios/f-adopcion.php">En adopción</a>
                            </li>
                            <li><a class="dropdown-item" href="<?= $baseUrl ?>formularios/f-adoptados.php">Adoptados</a>
                            </li>
                            <li><a class="dropdown-item" href="<?= $baseUrl ?>formularios/f-productos.php">Productos</a>
                            </li>
                            <li><a class="dropdown-item" href="<?= $baseUrl ?>formularios/f-avisos.php">Avisos</a></li>
                            <li><a class="dropdown-item" href="<?= $baseUrl ?>formularios/f-servicios.php">Servicios</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="ms-auto d-flex align-items-center gap-2">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <span class="text-white">
                        <?php
                        if (isset($_SESSION['usuario']->Nombre) && isset($_SESSION['usuario']->Apellidos)) {
                            echo htmlspecialchars($_SESSION['usuario']->Nombre . ' ' . $_SESSION['usuario']->Apellidos);
                        } else {
                            echo 'Usuario';
                        }
                        ?>
                    </span>
                    <form action="logout.php" method="post" class="d-inline">
                        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                    </form>
                <?php else: ?>
                    <?php
                    $paginaActual = basename($_SERVER['PHP_SELF']);
                    if ($paginaActual === 'login.php'):
                        ?>
                        <a href="registro.php" class="btn btn-outline-light">Registrarse</a>
                    <?php elseif ($paginaActual === 'registro.php'): ?>
                        <a href="login.php" class="btn btn-light">Login</a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-light">Login</a>
                        <a href="registro.php" class="btn btn-outline-light">Registrarse</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>