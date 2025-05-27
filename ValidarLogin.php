<?php
session_start();
require_once __DIR__ . '/DAO/DAOUsuarios.php';

$usuario = $_POST['usuario'] ?? '';
$contrasenia = $_POST['password'] ?? '';

if (empty($usuario) || empty($contrasenia)) {
    header("Location: login.php?error=1");
    exit();
}

$dao = new DAOUsuarios();
$usuarioAutenticado = $dao->autenticarUsuario($usuario, $contrasenia);

if ($usuarioAutenticado) {
    $_SESSION['usuario'] = $usuarioAutenticado;
    $_SESSION['rol'] = strtolower($usuarioAutenticado->tipousuario);
    header("Location: index.php");
    exit();
} else {
    header("Location: login.php?error=1&usuario=" . urlencode($usuario));
    exit();
}
?>
