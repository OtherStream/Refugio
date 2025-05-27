<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null;
$baseUrl = "../"; 
require "../funciones.php";
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
    
    <form class="formulario" id="adopcion" action="../guardar_Animal.php" method="POST" enctype="multipart/form-data">
        <h2>Agregar Animal en Adopción</h2>
        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Descripción:</label>
        <textarea name="descripcion" required></textarea>

        <label>Imagen:</label>
        <input type="file" name="imagen" accept="image/*" required>

        <label>Tipo:</label>
        <select name="tipo" required>
            <option value="perro">Perro</option>
            <option value="gato">Gato</option>
        </select>

        <label>Tamaño:</label>
        <select name="tamano" required>
            <option value="pequeño">Pequeño</option>
            <option value="mediano">Mediano</option>
            <option value="grande">Grande</option>
        </select>

        <label>Color:</label>
        <input type="text" name="color" required>

        <label>Género:</label>
        <select name="genero" required>
            <option value="macho">Macho</option>
            <option value="hembra">Hembra</option>
        </select>

        <button type="submit">Guardar Animal</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>    
</body>
<?php 
    require_once "../funciones.php";
    require_once "../componentes/footer.php";?>
</html>