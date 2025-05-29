<?php
session_start();
require_once __DIR__ . '/DAO/DAOUsuarios.php';

function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

$usuario = isset($_POST['usuario']) ? sanitizeInput($_POST['usuario']) : '';
$contrasenia = isset($_POST['password']) ? $_POST['password'] : '';

$errors = [];

if (empty($usuario)) {
    $errors['usuario'] = 'El usuario es obligatorio.';
}
if (empty($contrasenia)) {
    $errors['contrasenia'] = 'La contraseña es obligatoria.';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header("Location: login.php?error=empty");
    exit;
}

$dao = new DAOUsuarios();
$usuarioAutenticado = $dao->autenticarUsuario($usuario, $contrasenia);

if ($usuarioAutenticado) {
    $_SESSION['usuario'] = $usuarioAutenticado;
    $_SESSION['rol'] = strtolower($usuarioAutenticado->tipousuario);
    header("Location: index.php");
    exit;
} else {
    $_SESSION['errors'] = ['general' => 'Usuario o contraseña incorrectos.'];
    $_SESSION['form_data'] = $_POST;
    header("Location: login.php?error=invalid");
    exit;
}
?>