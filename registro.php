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
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <img src="img/logo.jpg" alt="">
            <h3>Refugio Animal Alfa A.C.</h3>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Adoptar.php">Adoptados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adoptados.php">Adoptados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Productos.php">Productos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Agregar
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="formularios/f-adopcion.html">En adopción</a></li>
                            <li><a class="dropdown-item" href="formularios/f-adoptados.html">Adoptados</a></li>
                            <li><a class="dropdown-item" href="formularios/f-productos.html">Productos</a></li>
                            <li><a class="dropdown-item" href="formularios/f-avisos.html">Avisos</a></li>
                            <li><a class="dropdown-item" href="formularios/f-servicios.html">Servicios</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="ms-auto">
                    <a href="login.php" class="btn btn-light">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="contenedor-formulario" action="procesar_registro.php">
        <form class="formulario" id="formRegistro" action="/procesar_registro.php" method="POST">
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

            <!-- <div class="form-group col-12">
                <label for="rol">Tipo de usuario:</label>
                <select name="rol" id="rol">
                    <option value="">Selecciona una opción</option>
                    <option value="admin">Administrador</option>
                    <option value="usuario">Usuario</option>
                </select>
                <div id="errorRol" class="text-danger small"></div>
            </div> -->

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

    <footer>
        <p><strong>Derechos reservados para la práctica</strong></p>
        <div class="contact-info">
            <span><i class="fa-solid fa-phone"></i> 445 121 8181</span>
            <span><i class="fa-solid fa-envelope"></i> refugioanimalalfaa.c@hotmail.com</span>
            <span><i class="fa-brands fa-instagram"></i> refugio_animal_alfa_ac</span>
            <span><i class="fa-brands fa-tiktok"></i> refugio_animal_alfa</span>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ...></script>
    <script src="scripts/registro.js"></script>
</body>

</html>