<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refugio Animal Alfa A.C.</title>
    <link rel="stylesheet" href="styles/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!--Barra de navegacion-->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <img src="img/logo.jpg" alt="">
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Agregar
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="formularios/f-adopcion.html">En adopción</a></li>
                            <li><a class="dropdown-item" href="formularios/f-adoptados.html">Adoptados</a></li>
                            <li><a class="dropdown-item" href="formularios/f-productos.html">Productos</a></li>
                            <li><a class="dropdown-item" href="formularios/f-avisos.html">Avisos</a></li>
                            <li><a class="dropdown-item" href="formularios/f-servicios.html">Servicios</a></li>
                        </ul>
                    </li>
                </ul>
                <div>
                </div>
                <div class="ms-auto d-flex align-items-center gap-2">
                    <a href="registro.php" class="btn btn-outline-light">Registrarse</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="login-box">
            <h2 class="text-center mb-4">Iniciar sesión</h2>
            <form id="formLogin" method="POST" action="validar_login.php">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario:</label>
                    <input type="text" name="usuario" id="usuario" class="form-control"
                        value="<?= isset($_GET['usuario']) ? htmlspecialchars($_GET['usuario']) : '' ?>">
                    <div id="errorUsuario" class="form-text text-danger"></div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control"
                        value="<?= isset($_GET['password']) ? htmlspecialchars($_GET['password']) : '' ?>">
                    <div id="errorPassword" class="form-text text-danger"></div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </div>
    <footer>
        <p><strong>Derechos reservados para la práctica</strong></p>
        <div class="contact-info">
            <span><i class="fa-solid fa-phone"></i> 445 121 8181</span>
            <span><i class="fa-solid fa-envelope"></i> refugioanimalalfaa.c@hotmail.com</span>
            <span><i class="fa-brands fa-instagram"></i> refugio_animal_alfa_ac</span>
            <span><i class="fa-brands fa-tiktok"></i> refugio_animal_alfa</span>
        </div>
    </footer>
    <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
        <script>
            const modal = new bootstrap.Modal(document.getElementById("modalError"));
            modal.show();
        </script>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts/login.js"></script>
</body>

</html>

<!-- Modal de error -->
    <div class="modal fade" id="modalError" tabindex="-1" aria-labelledby="modalErrorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Error de inicio de sesión</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    Usuario o contraseña incorrectos. Intenta nuevamente.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>