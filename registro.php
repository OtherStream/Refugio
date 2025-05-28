<?php
$baseUrl = "./"; 
require "funciones.php";
require_once __DIR__ . '/DAO/DAOUsuarios.php';

$dao = new DAOUsuarios();
$usuarioData = null;

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
    <!--Barra de navegacion-->
    <?php require_once "componentes/header.php"; ?>

    <div class="contenedor-formulario">
        <form class="formulario" id="formRegistro" action="./procesar_registro.php" method="POST">
            <h2>Registro de Usuario</h2>

            <input type="hidden" name="id" value="<?= isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '' ?>">
            
            <?php if (!isset($_GET['id'])): ?>
                <input type="hidden" name="tipoUsuario" value="usuario">
            <?php endif; ?>

            <div class="form-group col-6">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuarioData->nombre ?? '') ?>">
                <div id="errorNombre" class="text-danger small"></div>
            </div>

            <div class="form-group col-6">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($usuarioData->apellidos ?? '') ?>">
                <div id="errorApellidos" class="text-danger small"></div>
            </div>

            <div class="form-group col-12">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" placeholder="Ej. 1234567890" value="<?= htmlspecialchars($usuarioData->telefono ?? '') ?>">
                <div id="errorTelefono" class="text-danger small"></div>
            </div>

            <div class="form-group col-12">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($usuarioData->direccion ?? '') ?>">
                <div id="errorDireccion" class="text-danger small"></div>
            </div>

            <div class="form-group col-6">
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" min="15" max="90" value="<?= htmlspecialchars($usuarioData->edad ?? '') ?>">
                <div id="errorEdad" class="text-danger small"></div>
            </div>

            <div class="form-group col-6">
                <label for="sexo">Sexo:</label>
                <select name="sexo" id="sexo">
                    <option value="">Selecciona una opción</option>
                    <option value="masculino" <?= ($usuarioData->sexo ?? '') === 'masculino' ? 'selected' : '' ?>>Masculino</option>
                    <option value="femenino" <?= ($usuarioData->sexo ?? '') === 'femenino' ? 'selected' : '' ?>>Femenino</option>
                    <option value="otro" <?= ($usuarioData->sexo ?? '') === 'otro' ? 'selected' : '' ?>>Otro</option>
                </select>
                <div id="errorSexo" class="text-danger small"></div>
            </div>

            <div class="form-group col-6">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($usuarioData->usuario ?? '') ?>">
                <div id="errorUsuario" class="text-danger small"></div>
            </div>

            <div class="form-group col-6">
                <label for="pass">Contraseña:</label>
                <input type="password" id="pass" name="pass" value="<?= htmlspecialchars($usuarioData->pass ?? '') ?>">
                <div id="errorPass" class="text-danger small"></div>
            </div>
            <?php if (isset($_GET['id'])): ?>
            <div class="form-group col-12">
                <label for="tipoUsuario">Tipo de Usuario:</label>
                <select name="tipoUsuario" id="tipoUsuario">
                    <option value="">Selecciona una opción</option>
                    <option value="admin" <?= ($usuarioData->tipousuario ?? '') === 'admin' ? 'selected' : '' ?>>Administrador</option>
                    <option value="usuario" <?= ($usuarioData->tipousuario ?? '') === 'usuario' ? 'selected' : '' ?>>Usuario</option>
                </select>
                <div id="errorTipoUsuario" class="text-danger small"></div>
            </div>
            <?php endif; ?>

            <button type="submit"><?= isset($_GET['id']) ? 'Actualizar' : 'Registrar' ?></button>
        </form>
    </div>

    <?php require_once "funciones.php"; ?>
    <?php require_once "componentes/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="scripts/registro.js"></script>
</body>
</html>