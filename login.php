<?php
session_start();
$baseUrl = "./";
require "funciones.php";

$errors = $_SESSION['errors'] ?? [];
$form_data = $_SESSION['form_data'] ?? [];
unset($_SESSION['errors'], $_SESSION['form_data']);
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
    <?php 
    require_once "componentes/header.php";
    imprimir();
    ?>

    <div class="modal fade" id="modalEmpty" tabindex="-1" aria-labelledby="modalEmptyLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="modalEmptyLabel">Campos incompletos</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    Por favor, llena todos los datos correctamente.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalError" tabindex="-1" aria-labelledby="modalErrorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalErrorLabel">Error de inicio de sesión</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
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

    <div class="container mt-5">
        <div class="login-box">
            <h2 class="text-center mb-4">Iniciar sesión</h2>
            <?php if (isset($errors['general'])): ?>
                <div class="text-danger small mb-3"><?php echo htmlspecialchars($errors['general']); ?></div>
            <?php endif; ?>
            <form id="formLogin" method="POST" action="ValidarLogin.php" novalidate>
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario:</label>
                    <input type="text" name="usuario" id="usuario" class="form-control"
                        value="<?= htmlspecialchars($form_data['usuario'] ?? $_GET['usuario'] ?? '') ?>">
                    <div id="errorUsuario" class="form-text text-danger"><?php echo htmlspecialchars($errors['usuario'] ?? ''); ?></div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <div id="errorPassword" class="form-text text-danger"><?php echo htmlspecialchars($errors['contrasenia'] ?? ''); ?></div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </div>

    <?php require_once "componentes/footer.php"; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const params = new URLSearchParams(window.location.search);
            if (params.get('error') === 'empty') {
                var modal = new bootstrap.Modal(document.getElementById('modalEmpty'), { keyboard: false });
                modal.show();
            } else if (params.get('error') === 'invalid') {
                var modal = new bootstrap.Modal(document.getElementById('modalError'), { keyboard: false });
                modal.show();
            }
            document.addEventListener('hidden.bs.modal', function () {
                document.body.classList.remove('modal-open');
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            });
        });
    </script>
    <script src="scripts/login.js"></script>
</body>
</html>