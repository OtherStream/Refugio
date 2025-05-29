<?php
require_once __DIR__ . '/DAO/DAOUsuarios.php';

header('Content-Type: application/json');

$response = ['exitoso' => false, 'mensaje' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if (!$id) {
        $response['mensaje'] = 'ID de usuario no proporcionado.';
        echo json_encode($response);
        exit();
    }

    $dao = new DAOUsuarios();
    $eliminacionExitosa = $dao->eliminarUsuario($id);

    if ($eliminacionExitosa) {
        $response['exitoso'] = true;
        $response['mensaje'] = 'Usuario eliminado con éxito.';
    } else {
        $response['mensaje'] = 'Error al eliminar el usuario.';
    }
} else {
    $response['mensaje'] = 'Método no permitido.';
}

echo json_encode($response);
exit();
?>