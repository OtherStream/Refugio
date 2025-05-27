<?php
require_once __DIR__ . '/DAO/DAOUsuarios.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

error_log("Se ejecutó procesar_registro.php");

$nombre = $_POST['nombre'] ?? '';
$apellidos = $_POST['apellidos'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$edad = $_POST['edad'] ?? '';
$sexo = $_POST['sexo'] ?? '';
$usuario = $nombre; // Using nombre as usuario, consider allowing users to set their own username
$contrasenia = $apellidos; // Using apellidos as contrasenia, consider a proper password field
$tipoUsuario = 'cliente';

if (empty($nombre) || empty($apellidos) || empty($telefono) || empty($direccion) || empty($edad) || empty($sexo)) {
    header("Location: registro.php?error=1");
    exit();
}

$dao = new DAOUsuarios();

$registroExitoso = $dao->registrarUsuario(
    $nombre,
    $apellidos,
    $telefono,
    $direccion,
    $edad,
    $sexo,
    $usuario,
    $contrasenia,
    $tipoUsuario
);

if ($registroExitoso) {
    header("Location: index.php");
} else {
    header("Location: registro.php?error=2");
}
exit();
?>