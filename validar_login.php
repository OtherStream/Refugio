<?php
session_start();

$usuarioValido = "Jano";
$contraseniaValida = "1234";

$usuario = $_POST['usuario'] ?? '';
$contrasenia = $_POST['password'] ?? '';

if ($usuario === $usuarioValido && $contrasenia === $contraseniaValida) {
    $_SESSION['usuario'] = $usuario;
    header("Location: index.php"); 
    exit();
} else {
    // Redirige con los datos del intento fallido
    $usuario = urlencode($usuario);
    $contrasenia = urlencode($contrasenia);
    header("Location: login.php?error=1&usuario=$usuario&password=$contrasenia");
    exit();
}
?>
