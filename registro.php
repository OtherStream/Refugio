<?php
session_start();
require_once __DIR__ . '/DAO/DAOUsuarios.php';

$baseUrl = "./";

$dao = new DAOUsuarios();
$usuarioData = null;
$errors = $_SESSION['errors'] ?? [];
$form_data = $_SESSION['form_data'] ?? [];
unset($_SESSION['errors'], $_SESSION['form_data']);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $usuarioData = $dao->obtenerPorId($id);
    if (!$usuarioData) {
        $usuarioData = new stdClass();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Refugio Animal Alfa A.C.</title>
    <link rel="stylesheet" href="styles/registro.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <?php require_once "componentes/header.php"; ?>

    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error en el formulario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Por favor, llena todos los datos correctamente.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div class="contenedor-formulario">
        <form class="formulario" id="formRegistro" action="./procesar_registro.php" method="POST">
            <h2>Registro de Usuario</h2>
            <?php if (isset($errors['general'])): ?>
                <div class="text-danger small mb-3"><?php echo htmlspecialchars($errors['general']); ?></div>
            <?php endif; ?>

            <input type="hidden" name="id" value="<?= isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '' ?>">

            <?php if (!isset($_GET['id'])): ?>
                <input type="hidden" name="tipoUsuario" value="usuario">
            <?php endif; ?>

            <div class="form-group col-6">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($form_data['nombre'] ?? $usuarioData->nombre ?? '') ?>">
                <div id="errorNombre" class="text-danger small"><?php echo htmlspecialchars($errors['nombre'] ?? ''); ?></div>
            </div>

            <div class="form-group col-6">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($form_data['apellidos'] ?? $usuarioData->apellidos ?? '') ?>">
                <div id="errorApellidos" class="text-danger small"><?php echo htmlspecialchars($errors['apellidos'] ?? ''); ?></div>
            </div>

            <div class="form-group col-12">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" placeholder="Ej. 1234567890" value="<?= htmlspecialchars($form_data['telefono'] ?? $usuarioData->telefono ?? '') ?>">
                <div id="errorTelefono" class="text-danger small"><?php echo htmlspecialchars($errors['telefono'] ?? ''); ?></div>
            </div>

            <div class="form-group col-12">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($form_data['direccion'] ?? $usuarioData->direccion ?? '') ?>">
                <div id="errorDireccion" class="text-danger small"><?php echo htmlspecialchars($errors['direccion'] ?? ''); ?></div>
            </div>

            <div class="form-group col-6">
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" value="<?= htmlspecialchars($form_data['edad'] ?? $usuarioData->edad ?? '') ?>">
                <div id="errorEdad" class="text-danger small"><?php echo htmlspecialchars($errors['edad'] ?? ''); ?></div>
            </div>

            <div class="form-group col-6">
                <label for="sexo">Sexo:</label>
                <select name="sexo" id="sexo">
                    <option value="" <?= !isset($form_data['sexo']) && !isset($usuarioData->sexo) ? 'selected' : '' ?>>Selecciona una opción</option>
                    <option value="masculino" <?= ($form_data['sexo'] ?? $usuarioData->sexo ?? '') === 'masculino' ? 'selected' : '' ?>>Masculino</option>
                    <option value="femenino" <?= ($form_data['sexo'] ?? $usuarioData->sexo ?? '') === 'femenino' ? 'selected' : '' ?>>Femenino</option>
                    <option value="otro" <?= ($form_data['sexo'] ?? $usuarioData->sexo ?? '') === 'otro' ? 'selected' : '' ?>>Otro</option>
                </select>
                <div id="errorSexo" class="text-danger small"><?php echo htmlspecialchars($errors['sexo'] ?? ''); ?></div>
            </div>

            <div class="form-group col-6">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($form_data['usuario'] ?? $usuarioData->usuario ?? '') ?>">
                <div id="errorUsuario" class="text-danger small"><?php echo htmlspecialchars($errors['usuario'] ?? ''); ?></div>
            </div>

            <div class="form-group col-6">
                <label for="pass">Contraseña:</label>
                <input type="password" id="pass" name="pass" value="<?= htmlspecialchars($form_data['usuario'] ?? $usuarioData->usuario ?? '') ?>">
                <div id="errorPass" class="text-danger small"><?php echo htmlspecialchars($errors['contrasenia'] ?? ''); ?></div>
            </div>

            <?php if (isset($_GET['id'])): ?>
            <div class="form-group col-12">
                <label for="tipoUsuario">Tipo de Usuario:</label>
                <select name="tipoUsuario" id="tipoUsuario">
                    <option value="" <?= !isset($form_data['tipoUsuario']) && !isset($usuarioData->tipousuario) ? 'selected' : '' ?>>Selecciona una opción</option>
                    <option value="admin" <?= ($form_data['tipoUsuario'] ?? $usuarioData->tipousuario ?? '') === 'admin' ? 'selected' : '' ?>>Administrador</option>
                    <option value="usuario" <?= ($form_data['tipoUsuario'] ?? $usuarioData->tipousuario ?? '') === 'usuario' ? 'selected' : '' ?>>Usuario</option>
                </select>
                <div id="errorTipoUsuario" class="text-danger small"><?php echo htmlspecialchars($errors['tipoUsuario'] ?? ''); ?></div>
            </div>
            <?php endif; ?>

            <button type="submit"><?= isset($_GET['id']) ? 'Actualizar' : 'Registrar' ?></button>
        </form>
    </div>

    <?php require_once "componentes/footer.php"; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php if (!empty($errors)): ?>
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'), {
                    keyboard: false
                });
                errorModal.show();
            <?php endif; ?>
        });
    </script>
    <script src="scripts/registro.js"></script>
</body>
</html>