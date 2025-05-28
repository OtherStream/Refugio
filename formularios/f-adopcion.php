<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null;
$baseUrl = "../"; 
require "../funciones.php";

require_once "../DAO/DAOEnAdopcion.php";

// Check if an ID is provided for editing
$animal = null;
if (isset($_GET['id'])) {
    $dao = new DAOAnimalAdopcion();
    $animal = $dao->obtenerUno($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="formularios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <?php 
    require_once "../componentes/header.php";
    ?>
    
    <form class="formulario" id="adopcion" action="../guardar_Animal.php" method="POST" enctype="multipart/form-data" onsubmit="disableSubmitButton()">
    <h2><?= $animal ? 'Editar Animal en Adopción' : 'Agregar Animal en Adopción' ?></h2>
    <?php if ($animal): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($animal->id) ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $animal ? htmlspecialchars($animal->nombre) : '' ?>" required>
        <span id="errorNombre" class="text-danger"></span>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción:</label>
        <textarea class="form-control" id="descripcion" name="descripcion" required><?= $animal ? htmlspecialchars($animal->descripcion) : '' ?></textarea>
        <span id="errorDescripcion" class="text-danger"></span>
    </div>

    <div class="mb-3">
        <label for="imagen" class="form-label">Imagen:</label>
        <?php if ($animal && $animal->imagen): ?>
            <p>Imagen actual: <img src="<?= htmlspecialchars($animal->imagen) ?>" width="100" alt="Imagen actual"></p>
        <?php endif; ?>
        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" <?= $animal ? '' : 'required' ?>>
        <span id="errorImagen" class="text-danger"></span>
    </div>

    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo:</label>
        <select class="form-select" id="tipo" name="tipo" required>
            <option value="" disabled <?= !$animal ? 'selected' : '' ?>>Selecciona un tipo</option>
            <option value="perro" <?= $animal && $animal->tipo === 'perro' ? 'selected' : '' ?>>Perro</option>
            <option value="gato" <?= $animal && $animal->tipo === 'gato' ? 'selected' : '' ?>>Gato</option>
        </select>
        <span id="errorTipo" class="text-danger"></span>
    </div>

    <div class="mb-3">
        <label for="tamano" class="form-label">Tamaño:</label>
        <select class="form-select" id="tamano" name="tamano" required>
            <option value="" disabled <?= !$animal ? 'selected' : '' ?>>Selecciona un tamaño</option>
            <option value="pequeño" <?= $animal && $animal->tamano === 'pequeño' ? 'selected' : '' ?>>Pequeño</option>
            <option value="mediano" <?= $animal && $animal->tamano === 'mediano' ? 'selected' : '' ?>>Mediano</option>
            <option value="grande" <?= $animal && $animal->tamano === 'grande' ? 'selected' : '' ?>>Grande</option>
        </select>
        <span id="errorTamano" class="text-danger"></span>
    </div>

    <div class="mb-3">
        <label for="color" class="form-label">Color:</label>
        <input type="text" class="form-control" id="color" name="color" value="<?= $animal ? htmlspecialchars($animal->color) : '' ?>" required>
        <span id="errorColor" class="text-danger"></span>
    </div>

    <div class="mb-3">
        <label for="genero" class="form-label">Género:</label>
        <select class="form-select" id="genero" name="genero" required>
            <option value="" disabled <?= !$animal ? 'selected' : '' ?>>Selecciona un género</option>
            <option value="macho" <?= $animal && $animal->genero === 'macho' ? 'selected' : '' ?>>Macho</option>
            <option value="hembra" <?= $animal && $animal->genero === 'hembra' ? 'selected' : '' ?>>Hembra</option>
        </select>
        <span id="errorGenero" class="text-danger"></span>
    </div>

    <button type="submit" id="submitButton" class="btn btn-primary"><?= $animal ? 'Editar Animal' : 'Guardar Animal' ?></button>
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/adopcion.js"></script>
    <script>
        function disableSubmitButton() {
            const button = document.getElementById('submitButton');
            button.disabled = true;
            button.innerText = 'Procesando...';
            return true; // Allow form submission
        }
    </script>    
</body>
<?php 
    require_once "../funciones.php";
    require_once "../componentes/footer.php";

?>
</html>