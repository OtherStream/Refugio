<?php
session_start();
$baseUrl = "./"; 
require "funciones.php";
?>
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
    <?php 
    require_once "componentes/header.php";
    imprimir();
    ?>

    <div class="container mt-5">
        <div class="login-box">
            <h2 class="text-center mb-4">Iniciar sesión</h2>
            <form id="formLogin" method="POST" action="ValidarLogin.php">
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
    <?php 
    require_once "funciones.php";
    require_once "componentes/footer.php";?>
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