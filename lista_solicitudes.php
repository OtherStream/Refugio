<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null;
$baseUrl = "./";

require_once __DIR__ . '/DAO/DAOSolicitud.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_solicitud'])) {
    header('Content-Type: application/json');

    $id_solicitud = isset($_POST['id_solicitud']) ? (int) $_POST['id_solicitud'] : 0;
    $aceptado = isset($_POST['aceptado']) ? $_POST['aceptado'] : '';

    $dao = new DAOSolicitud();
    $result = $dao->actualizarEstadoSolicitud($id_solicitud, $aceptado);

    echo json_encode($result);
    exit;
}

$dao = new DAOSolicitud;

if ($usuario && property_exists($usuario, 'tipousuario') && $usuario->tipousuario == 'admin'):
    $solicitudes = $dao->obtenerTodos();
else:
    $id_usuario = $usuario->id_usuario ?? null;
    $solicitudes = $dao->obtenerPorUsuario($id_usuario);
endif;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Solicitudes</title>
    <link rel="stylesheet" href="styles/lista_solicitudes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php require_once "componentes/header.php"; ?>

    <div class="container mt-4">
        <h2>Lista de Solicitudes</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <?php if (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                        <tr>
                            <th>Num. Solicitud</th>
                            <th>Usuario</th>
                            <th>Animal</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <th>Animal</th>
                            <th>Estado</th>
                        </tr>
                    <?php endif; ?>
                </thead>
                <tbody>
                    <?php if ($solicitudes && count($solicitudes) > 0): ?>
                        <?php foreach ($solicitudes as $s): ?>
                            <?php if (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                                <tr>
                                    <td><?= htmlspecialchars($s->id_solicitud) ?></td>
                                    <td><?= htmlspecialchars($s->nombre_usuario) ?></td>
                                    <td><?= htmlspecialchars($s->nombre_animal) ?></td>
                                    <td class="status-cell">
                                        <?php if ($s->aceptado == 'P'): ?>
                                            <?= htmlspecialchars("Pendiente") ?>
                                        <?php elseif ($s->aceptado == 'A'): ?>
                                            <?= htmlspecialchars("Aceptado") ?>
                                        <?php elseif ($s->aceptado == 'R'): ?>
                                            <?= htmlspecialchars("Rechazado") ?>
                                        <?php else: ?>
                                            <?= htmlspecialchars("Desconocido") ?>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?php if ($s->aceptado == 'P'): ?>
                                            <button type="button" class="btn btn-success accept-btn" data-id="<?= $s->id_solicitud ?>"
                                                <?= $s->aceptado === 'A' ? 'disabled' : '' ?>>
                                                Aceptar
                                            </button>
                                            <button type="button" class="btn btn-danger reject-btn" data-id="<?= $s->id_solicitud ?>"
                                                <?= $s->aceptado === 'R' ? 'disabled' : '' ?>>
                                                Rechazar
                                            </button>
                                        <?php elseif ($s->aceptado == 'A'): ?>
                                            <button type="button" class="btn btn-danger reject-btn" data-id="<?= $s->id_solicitud ?>"
                                                <?= $s->aceptado === 'R' ? 'disabled' : '' ?>>
                                                Rechazar
                                            </button>
                                        <?php elseif ($s->aceptado == 'R'): ?>
                                            <button type="button" class="btn btn-success accept-btn" data-id="<?= $s->id_solicitud ?>"
                                                <?= $s->aceptado === 'A' ? 'disabled' : '' ?>>
                                                Aceptar
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td><?= htmlspecialchars($s->nombre_animal) ?></td>
                                    <td class="status-cell">
                                        <?php if ($s->aceptado == 'P'): ?>
                                            <?= htmlspecialchars("Pendiente") ?>
                                        <?php elseif ($s->aceptado == 'A'): ?>
                                            <?= htmlspecialchars("Aceptado") ?>
                                        <?php elseif ($s->aceptado == 'R'): ?>
                                            <?= htmlspecialchars("Rechazado") ?>
                                        <?php else: ?>
                                            <?= htmlspecialchars("Desconocido") ?>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="<?= $_SESSION['rol'] === 'admin' ? 5 : 2 ?>">No hay solicitudes.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="responseModalLabel">Resultado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="responseModalBody">
                    <!-- Mensaje se inserta aquí -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const acceptButtons = document.querySelectorAll('.accept-btn');
            const rejectButtons = document.querySelectorAll('.reject-btn');
            const responseModal = new bootstrap.Modal(document.getElementById('responseModal'));
            const responseModalBody = document.getElementById('responseModalBody');

            function handleButtonClick(button, aceptado) {
                const id_solicitud = button.getAttribute('data-id');
                fetch('', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `id_solicitud=${id_solicitud}&aceptado=${aceptado}`
                })
                    .then(response => response.json())
                    .then(data => {
                        responseModalBody.textContent = data.message;
                        responseModalBody.className = 'modal-body ' + (data.success ? 'text-success' : 'text-danger');
                        responseModal.show();

                        if (data.success) {
                            const row = button.closest('tr');
                            const statusCell = row.querySelector('.status-cell');
                            statusCell.textContent = aceptado === 'A' ? 'Aceptado' : 'Rechazado';
                            row.querySelector('.accept-btn').disabled = aceptado === 'A';
                            row.querySelector('.reject-btn').disabled = aceptado === 'R';
                            window.location.reload();  
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        responseModalBody.textContent = 'Error al procesar la solicitud';
                        responseModalBody.className = 'modal-body text-danger';
                        responseModal.show();
                    });
            }

            acceptButtons.forEach(button => {
                button.addEventListener('click', () => handleButtonClick(button, 'A'));
            });

            rejectButtons.forEach(button => {
                button.addEventListener('click', () => handleButtonClick(button, 'R'));
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
<?php require_once "componentes/footer.php"; ?>

</html>
