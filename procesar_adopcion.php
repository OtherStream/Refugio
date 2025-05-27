<?php
session_start();
require_once 'DAOFormAdoptar.php';

// Guardar datos para persistencia
$_SESSION['form_data'] = $_POST;

$dao = new DAOFormAdoptar();
$resultado = $dao->validarYGuardarFormulario($_POST + $_FILES);

if ($resultado['valido']) {
    unset($_SESSION['form_data']);
    unset($_SESSION['errores']);
    header("Location: Adoptar.php?success=1&id=" . $resultado['id_insertado']);
    exit();
} else {
    $_SESSION['errores'] = $resultado['errores'];
    header("Location: Adoptar.php?form_error=1");
    exit();
}
?>