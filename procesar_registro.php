<?php
require_once __DIR__ . '/DAO/DAOUsuarios.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

error_log("Se ejecutó procesar_registro.php");

$id = $_POST['id'] ?? null;
$nombre = $_POST['nombre'] ?? '';
$apellidos = $_POST['apellidos'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$edad = $_POST['edad'] ?? '';
$sexo = $_POST['sexo'] ?? '';
$usuario = $_POST['usuario'] ?? ''; 
$contrasenia = $_POST['pass'] ?? ''; 
$tipoUsuario = $_POST['tipoUsuario'] ?? 'cliente'; 

// Validation
if (empty($nombre) || empty($apellidos) || empty($telefono) || empty($direccion) || empty($edad) || empty($sexo) || empty($usuario) || empty($contrasenia)) {
    header("Location: registro.php?error=1");
    exit();
}

$dao = new DAOUsuarios();

if ($id) {
    
    $actualizacionExitosa = $dao->actualizarUsuario(
        $id,
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
    $mensaje = $actualizacionExitosa ? 'Usuario actualizado con éxito' : 'Error al actualizar el usuario';
    header("Location: index.php?mensaje=" . urlencode($mensaje));
} else {
    
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
    $mensaje = $registroExitoso ? 'Usuario registrado con éxito' : 'Error al registrar el usuario';
    header("Location: index.php?mensaje=" . urlencode($mensaje)); 
}

exit();
?>