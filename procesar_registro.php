<?php
require_once __DIR__ . '/DAO/DAOUsuarios.php';

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
error_log("Se ejecutó procesar_registro.php");

session_start();

function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

$errors = [];
$data = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['errors'] = ['general' => 'Método de solicitud no válido.'];
    header('Location: registro.php');
    exit;
}

$id = isset($_POST['id']) ? sanitizeInput($_POST['id']) : null;
$nombre = isset($_POST['nombre']) ? sanitizeInput($_POST['nombre']) : '';
$apellidos = isset($_POST['apellidos']) ? sanitizeInput($_POST['apellidos']) : '';
$telefono = isset($_POST['telefono']) ? sanitizeInput($_POST['telefono']) : '';
$direccion = isset($_POST['direccion']) ? sanitizeInput($_POST['direccion']) : '';
$edad = isset($_POST['edad']) ? filter_var($_POST['edad'], FILTER_VALIDATE_INT) : '';
$sexo = isset($_POST['sexo']) ? sanitizeInput($_POST['sexo']) : '';
$usuario = isset($_POST['usuario']) ? sanitizeInput($_POST['usuario']) : '';
$contrasenia = isset($_POST['pass']) ? $_POST['pass'] : '';
$tipoUsuario = isset($_POST['tipoUsuario']) ? sanitizeInput($_POST['tipoUsuario']) : 'usuario';

if (empty($nombre) || strlen($nombre) < 3 || !preg_match("/^[a-zA-Z ]+$/", $nombre)) {
    $errors['nombre'] = 'El nombre debe tener al menos 3 caracteres y solo contener letras.';
}

if (empty($apellidos) || strlen($apellidos) < 3 || !preg_match("/^[a-zA-Z ]+$/", $apellidos)) {
    $errors['apellidos'] = 'Los apellidos deben tener al menos 3 caracteres y solo contener letras.';
}

if (empty($telefono) || !preg_match("/^[0-9]{10}$/", $telefono)) {
    $errors['telefono'] = 'El teléfono debe tener exactamente 10 dígitos numéricos.';
}

if (empty($direccion) || strlen($direccion) < 5) {
    $errors['direccion'] = 'La dirección debe tener al menos 5 caracteres.';
}

if ($edad === false || $edad < 15 || $edad > 90) {
    $errors['edad'] = 'La edad debe ser un número entre 15 y 90.';
}

if (empty($sexo) || !in_array($sexo, ['masculino', 'femenino', 'otro'])) {
    $errors['sexo'] = 'Selecciona una opción válida para el sexo.';
}

if (empty($usuario) || strlen($usuario) < 4 || !preg_match("/^[a-zA-Z0-9_]+$/", $usuario)) {
    $errors['usuario'] = 'El usuario debe tener al menos 4 caracteres y solo contener letras, números o guiones bajos.';
}

if (empty($contrasenia) || strlen($contrasenia) < 4) {
    $errors['contrasenia'] = 'La contraseña debe tener al menos 4 caracteres.';
}

if ($id && (empty($tipoUsuario) || !in_array($tipoUsuario, ['admin', 'usuario']))) {
    $errors['tipoUsuario'] = 'Selecciona un tipo de usuario válido (administrador o usuario).';
}

if (empty($errors)) {
    $dao = new DAOUsuarios();
    $data = [
        $nombre,
        $apellidos,
        $telefono,
        $direccion,
        $edad,
        $sexo,
        $usuario,
        $contrasenia,
        $tipoUsuario
    ];

    try {
        if ($id) {
            $result = $dao->actualizarUsuario($id, ...$data);
            $mensaje = $result ? 'Usuario actualizado con éxito.' : 'Error al actualizar el usuario.';
        } else {
            $result = $dao->registrarUsuario(...$data);
            $mensaje = $result ? 'Usuario registrado con éxito.' : 'Error al registrar el usuario.';
        }
        $_SESSION['mensaje'] = $mensaje;
        header('Location: index.php');
        exit;
    } catch (Exception $e) {
        $errors['general'] = 'Error en la base de datos: ' . $e->getMessage();
    }
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header('Location: registro.php' . ($id ? '?id=' . $id : ''));
    exit;
}
?>