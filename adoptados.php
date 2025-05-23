<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Refugio Animal Alfa A.C.</title>
    <link rel="stylesheet" href="styles/styles_adoptados.css">
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
<<<<<<< HEAD:adoptados.html
                        <a class="nav-link" href="Adoptar.html">Adoptar</a>
=======
                        <a class="nav-link" href="Adoptar.php">Adoptados</a>
>>>>>>> 8ccaa0e (Actualización del proyecto):adoptados.php
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
                <div class="ms-auto d-flex align-items-center gap-2">
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <span class="text-white"><?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
                        <form action="logout.php" method="post" class="d-inline">
                            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                        </form>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-light">Login</a>
                        <a href="registro.php" class="btn btn-outline-light">Registrarse</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <section id="adoptados" class="adoptados">
        <img src="img/logo.jpg" alt="">
        <div id="centro">
            <h1>Adopciones Exitosas</h1>
            <section class="inicio" id="inicio">
                <div class="contenedor-inicio">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                                aria-label="Slide 4"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"
                                aria-label="Slide 5"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5"
                                aria-label="Slide 6"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="6"
                                aria-label="Slide 7"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="7"
                                aria-label="Slide 8"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="img/adop1.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/adop2.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/adop3.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/adop4.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/adop5.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/adop6.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/adop7.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/adop8.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </section>


            <h1>Y tu, ¿qué esperas?</h1>
        </div>
    </section>


    
</body>
<footer>
    <p><strong>Derechos reservados para la práctica</strong></p>
    <div class="contact-info">
        <span><i class="fa-solid fa-phone"></i> 445 121 8181</span>
        <span><i class="fa-solid fa-envelope"></i> refugioanimalalfaa.c@hotmail.com</span>
        <span><i class="fa-brands fa-instagram"></i> refugio_animal_alfa_ac</span>
        <span><i class="fa-brands fa-tiktok"></i> refugio_animal_alfa</span>
    </div>
</footer>

</html>
