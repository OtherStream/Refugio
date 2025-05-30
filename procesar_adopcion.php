<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . "/DAO/DAOSolicitud.php";
require_once __DIR__ . "/modelos/solicitud.php";

$response = ['success' => false, 'message' => ''];

if (!isset($_SESSION['usuario'])) {
    $response['message'] = 'Debes iniciar sesión para enviar una solicitud.';
    echo json_encode($response);
    exit;
}

$id_animal = filter_input(INPUT_POST, 'id_animal', FILTER_VALIDATE_INT);
$id_usuario = $_SESSION['usuario']->id_usuario ?? null;

if (!$id_animal || !$id_usuario) {
    $response['message'] = 'Datos incompletos. Por favor, verifica tu información.';
    echo json_encode($response);
    exit;
}

try {
    $dao = new DAOSolicitud();
    $solicitud = new solicitudAdopcion();
    
    $solicitud->id_dar = $id_animal;
    $solicitud->id_usuario = $id_usuario;
    $solicitud->aceptado = 'P';

    $success = $dao->agregar($solicitud->id_usuario, $solicitud->id_dar, $solicitud->aceptado);

    $response['success'] = $success;
    $response['message'] = $success ? 'Solicitud registrada' : 'Fallo al registrar la solicitud';
} catch (Exception $e) {
    error_log("Error en procesar_adopcion.php: " . $e->getMessage());
    $response['message'] = 'Ocurrió un error al procesar la solicitud.';
}

echo json_encode($response);
exit;
?>