<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null;
$baseUrl = "./";
require_once __DIR__ . "/DAO/Conexion.php";
require "funciones.php";

// Configurar paginación
$limite = 8;
$pagina = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$offset = ($pagina - 1) * $limite;

// Conectar a la base de datos
$conn = Conexion::conectar();

// Contar total de registros
$totalSql = "SELECT COUNT(*) FROM enadopcion WHERE estatus = 'activo'";
$totalRegistros = $conn->query($totalSql)->fetchColumn();
$totalPaginas = ceil($totalRegistros / $limite);

// Obtener registros paginados
$sql = "SELECT * FROM enadopcion WHERE estatus = 'activo' ORDER BY id_dar DESC LIMIT :limite OFFSET :offset";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$animales = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <?php
    require_once "componentes/header.php";
    imprimir();
    ?>

    <div class="container mt-4">
        <div class="row">
            <?php foreach ($animales as $animal): ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="data:image/jpeg;base64,<?= base64_encode($animal['imagen']) ?>" class="card-img-top" alt="<?= htmlspecialchars($animal['nombre']) ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($animal['nombre']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($animal['descripcion']) ?></p>
                            <a href="#" class="btn btn-primary mt-auto" data-bs-toggle="modal" data-bs-target="#animalModal">Adoptar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- PAGINACIÓN -->
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
    </div>

    <!-- Modal de adopción -->
    <div class="modal fade" id="animalModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Formulario de Adopción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Nombre</span>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Correo</span>
                        <input type="email" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Direccion</span>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Edad</span>
                        <input type="number" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Telefono</span>
                        <input type="tel" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label"><b>Credencial</b></label>
                        <input class="form-control" type="file" id="formFile">
                        <p>Subir tu credencial escaneada por ambos lados en formato PDF</p>
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label"><b>Comprobante de domicilio</b></label>
                        <input class="form-control" type="file" id="formFile">
                        <p>Subir tu comprobante de domicilio escaneado en formato PDF</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Enviar solicitud</button>
                </div>
            </div>
        </div>
    </div>

    <?php require_once "componentes/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>