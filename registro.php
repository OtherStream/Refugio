<?php
$baseUrl = "./"; 
require "funciones.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Refugio Animal Alfa A.C.</title>
    <link rel="stylesheet" href="styles/registro.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!--Barra de navegacion-->
    <?php 
    require_once "componentes/header.php";
    ?>

    <div class="contenedor-formulario">
        <form class="formulario" id="formRegistro" action="./procesar_registro.php" method="POST">
            <h2>Registro de Usuario</h2>

            <div class="form-group col-6">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre">
                <div id="errorNombre" class="text-danger small"></div>
            </div>

            <div class="form-group col-6">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos">
                <div id="errorApellidos" class="text-danger small"></div>
            </div>

            <div class="form-group col-12">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" placeholder="Ej. 1234567890">
                <div id="errorTelefono" class="text-danger small"></div>
            </div>

            <div class="form-group col-12">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion">
                <div id="errorDireccion" class="text-danger small"></div>
            </div>

            <div class="form-group col-6">
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" min="15" max="90">
                <div id="errorEdad" class="text-danger small"></div>
            </div>

            <div class="form-group col-6">
                <label for="sexo">Sexo:</label>
                <select name="sexo" id="sexo">
                    <option value="">Selecciona una opción</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="otro">Otro</option>
                </select>
                <div id="errorSexo" class="text-danger small"></div>
            </div>

            <button type="submit">Registrar</button>
        </form>
    </div>

    <?php 
    require_once "funciones.php";
    require_once "componentes/footer.php";?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ...></script>
    <script src="scripts/registro.js"></script>
</body>

</html>