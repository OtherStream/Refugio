<?php
session_start();
require_once __DIR__ . '/DAO/DAOEnAdopcion.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario'])) {
    echo json_encode(['success' => false, 'mensaje' => 'No autorizado']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($id !== false && $id > 0) {
        $dao = new DAOAnimalAdopcion();
        $resultado = $dao->eliminar($id);

        if ($resultado) {
            echo json_encode(['success' => true, 'mensaje' => 'Animal eliminado correctamente']);
        } else {
            echo json_encode(['success' => false, 'mensaje' => 'No se pudo eliminar el animal']);
        }
    } else {
        echo json_encode(['success' => false, 'mensaje' => 'ID inválido']);
    }
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Solicitud inválida']);
}
exit;
?>