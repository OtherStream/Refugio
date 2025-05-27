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

    <form class="formulario" id="adoptados" action="/adoptados.html">
        <h2>Agregar Animal Adoptado</h2>
        <label>Nombre del animal:</label>
        <input type="text" name="nombre" required>

        <label>Imagen:</label>
        <input type="file" name="imagen" accept="image/*" required>

        <button type="submit">Guardar Adoptado</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php 
    require_once "../funciones.php";
    require_once "../componentes/footer.php";?>
</html>