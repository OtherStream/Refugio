<?php
session_start();
require_once __DIR__ . "/DAO/Conexion.php";
require_once __DIR__ . "/DAO/DAOSolicitud.php";

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if (!isset($_SESSION['usuario'])) {
    $response['message'] = 'Debes iniciar sesión para enviar una solicitud.';
    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Método no permitido.';
    echo json_encode($response);
    exit;
}

$id_animal = filter_input(INPUT_POST, 'id_animal', FILTER_VALIDATE_INT);
$id_usuario = $_SESSION['usuario']['id'] ?? null;

if (!$id_animal || !$id_usuario) {
    $response['message'] = 'Datos incompletos. Por favor, verifica tu información.';
    echo json_encode($response);
    exit;
}

try {
    $daoSolicitud = new DAOSolicitud();
    $resultado = $daoSolicitud->agregar($id_usuario, $id_animal, false);

    if ($resultado > 0) {
        $response['success'] = true;
        $response['message'] = 'Solicitud enviada con éxito.';
    } else {
        $response['message'] = 'No se pudo enviar la solicitud. Inténtalo de nuevo.';
    }
} catch (Exception $e) {
    error_log("Error en procesar_adopcion.php: " . $e->getMessage());
    $response['message'] = 'Ocurrió un error al procesar la solicitud.';
}

echo json_encode($response);
exit;
?>