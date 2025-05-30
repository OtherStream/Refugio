<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null;
$baseUrl = "./";
require_once __DIR__ . "/DAO/Conexion.php";
require_once __DIR__ . "/DAO/DAOEnAdopcion.php";

// Configurar paginación
$limite = 8;
$pagina = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$offset = ($pagina - 1) * $limite;

try {
    $dao = new DAOAnimalAdopcion();

    // Obtener y contar total de animales activos
    $totalAnimales = $dao->obtenerTotalActivos();
    // obtener incativos
    $totalAnimales += $dao->obtenerTotalInactivos();
    $totalPaginas = ceil($totalAnimales / $limite);


    $animales = $dao->obtenerActivosPorRango($limite, $offset);
} catch (PDOException $e) {
    error_log("Error en Adoptar.php: " . $e->getMessage());
    echo "Error al conectar con la base de datos: " . htmlspecialchars($e->getMessage());
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Animales en Adopción</title>
    <link rel="stylesheet" href="styles/adop-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php require_once "componentes/header.php"; ?>
    <div class="container mt-4">
        <div class="row">
            <?php if (empty($animales)): ?>
                <div class="col-12 text-center">
                    <p>No hay animales disponibles para adopción en este momento.</p>
                </div>
            <?php else: ?>
                <?php foreach ($animales as $animal): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100" style="overflow: hidden;">
                            <img src="<?= htmlspecialchars($animal->imagen ?? '', ENT_QUOTES, 'UTF-8') ?>" class="card-img-top"
                                alt="<?= htmlspecialchars($animal->nombre ?? 'Sin nombre', ENT_QUOTES, 'UTF-8') ?>">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">
                                    <?= htmlspecialchars($animal->nombre ?? 'Sin nombre', ENT_QUOTES, 'UTF-8') ?></h5>
                                <p class="card-text"><?= htmlspecialchars($animal->descripcion ?? '', ENT_QUOTES, 'UTF-8') ?>
                                </p>
                                <?php if($animal->estatus === 'inactivo'): ?>
                                    <p class="card-text">Ya hay personas interesadas</p>
                                <?php endif; ?>
                                <a href="#" class="btn btn-primary mt-auto adoptar-btn" data-bs-toggle="modal"
                                    data-bs-target="#animalModal"
                                    data-id="<?= htmlspecialchars($animal->id_dar, ENT_QUOTES, 'UTF-8') ?>"
                                    data-tipo="<?= htmlspecialchars($animal->tipo ?? 'desconocido', ENT_QUOTES, 'UTF-8') ?>"
                                    data-nombre="<?= htmlspecialchars($animal->nombre ?? 'Sin nombre', ENT_QUOTES, 'UTF-8') ?>">Adoptar</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>
        </div>

        <?php if ($totalPaginas > 1): ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= $pagina <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $pagina - 1 ?>" aria-label="Anterior">
                            <span aria-hidden="true">«</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <li class="page-item <?= $pagina == $i ? 'active' : '' ?>">
                            <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $pagina >= $totalPaginas ? 'disabled' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $pagina + 1 ?>" aria-label="Siguiente">
                            <span aria-hidden="true">»</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>

    <div class="modal fade" id="animalModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Formulario de Adopción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p id="mensaje-adopcion">Se está haciendo una solicitud por el animal.</p>
                        <div id="mensaje-resultado" class="mt-3 text-center" style="display: none;"></div>
                        <h3>¿Desea continuar con la solicitud?</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="enviar-solicitud">Enviar solicitud</button>
                </div>
            </div>
        </div>
    </div>

    <?php require_once "componentes/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts/solicitud.js"></script>
</body>

</html>

<?php
Conexion::desconectar();
?>