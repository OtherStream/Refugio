<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null;
$baseUrl = "./";

require_once __DIR__ . '/DAO/DAOEnAdopcion.php';
require "funciones.php";

$dao = new DAOAnimalAdopcion();
$animales = $dao->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Animales en Adopción</title>
    <link rel="stylesheet" href="styles/product-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <?php require_once "componentes/header.php"; ?>

    <h2>Lista de animales en adopción</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Tamaño</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($animales && count($animales) > 0): ?>
                    <?php foreach ($animales as $a): ?>
                        <tr>
                            <td><?= htmlspecialchars($a->nombre) ?></td>
                            <td><?= htmlspecialchars($a->tipo) ?></td>
                            <td><?= htmlspecialchars($a->tamano) ?></td>
                            <td><img src="<?= htmlspecialchars($a->imagen) ?>" width="100" alt="<?= htmlspecialchars($a->nombre) ?>"></td>
                            <td>
                                <button type="button" class="edit-btn btn btn-primary" 
                                        data-id="<?= htmlspecialchars($a->id) ?>">
                                    Editar
                                </button>
                                <button type="button" class="delete-btn btn btn-danger" 
                                        data-id="<?= htmlspecialchars($a->id) ?>">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No hay animales disponibles para adopción.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript para manejar las acciones -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const editButtons = document.querySelectorAll('.edit-btn');

        // Manejo de eliminación
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const currentId = this.getAttribute('data-id');
                fetch('eliminar.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `id=${currentId}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector(`tr:has(button[data-id="${currentId}"])`).remove();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });

        // Manejo de edición
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const currentId = this.getAttribute('data-id');
                window.location.href = `formularios/f-adopcion.php?id=${currentId}`;
            });
        });
    });
    </script>

    <!-- Incluir el script de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
            crossorigin="anonymous"></script>
</body>
<?php require_once "componentes/footer.php"; ?>
</html>