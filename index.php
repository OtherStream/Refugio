<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null;
$baseUrl = "./";
require_once __DIR__ . "/DAO/Conexion.php";

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Refugio Animal Alfa A.C.</title>
    <link rel="stylesheet" href="styles/styles.css">
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

    <!--Sección de inicio (carrucel)-->
    <section class="inicio" id="inicio">
        <div class="contenedor-inicio">
            <!--Carrucel-->
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/carrucel1.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/carrucel2.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/fondo.jpg" class="d-block w-100" alt="...">
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
            <!--Lo que esta arriba del carrucel-->
            <div class="info">
                <div id="logo">
                    <img src="img/logo.jpg" alt="Logo del refugio">
                </div>
                <div id="info_inicio">
                    <h1>Refugio Animal Alfa A.C.</h1>
                    <p>Somos una organización dedicada al rescate, cuidado y adopción de animales en situación de calle
                        o
                        maltrato. Nuestra misión es encontrar un hogar amoroso para cada uno de ellos.</p>
                    <a href="https://www.facebook.com/refugioanimalalfaac/?locale=es_LA" target="_blank">
                        <button>Más información para adoptar
                            <img src="img/huella.png" alt="Ícono de huella" id="btn_icono">
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="Anuncios" class="Anuncios">
        <h1>Avisos</h1>
        <div class="Anuncios-container">
            <img src="img/Anuncio1.png" alt="">
            <img src="img/Anuncio2.png" alt="">
            <img src="img/Anuncio3.png" alt="">
        </div>
    </section>

    <section id="Horario">
        <h1>HORARIOS</h1>
        <div id="horario-container">
            <img src="img/img-horario.png" alt="">
            <div id="table">
                <table>
                    <tr>
                        <td>Lunes</td>
                        <td>10:00am a 2:00pm</td>
                        <td>4:00pm a 8:00pm</td>
                    </tr>
                    <tr>
                        <td>Martes</td>
                        <td>10:00am a 2:00pm</td>
                        <td>4:00pm a 8:00pm</td>
                    </tr>
                    <tr>
                        <td>Miércoles</td>
                        <td>10:00am a 2:00pm</td>
                        <td>4:00pm a 8:00pm</td>
                    </tr>
                    <tr>
                        <td>Jueves</td>
                        <td>10:00am a 2:00pm</td>
                        <td>4:00pm a 8:00pm</td>
                    </tr>
                    <tr>
                        <td>Viernes</td>
                        <td>10:00am a 2:00pm</td>
                        <td>4:00pm a 8:00pm</td>
                    </tr>
                    <tr>
                        <td>Sábado</td>
                        <td colspan="2">10:00am a 6:00pm</td>
                    </tr>
                    <tr>
                        <td>Domingo</td>
                        <td colspan="2">Cerrado</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
    <section id="servicios">
        <h1>Nuestros Servicios</h1>
        <div class="servicios-container">

            <div class="servicio">
                <img src="img/servicio1.png" alt="Medico Veterinario">
                <div class="servicio-text">
                    <h2>Medico Veterinario</h2>
                    <p>Contamos con un médico veterinario en nuestras instalaciones en el cual puedes solicitar
                        consultas, profilaxis (limpieza dental), vacunas, desparasitación, esterilización y más.</p>
                </div>
            </div>

            <div class="servicio">
                <img src="img/servicio2.png" alt="Grooming">
                <div class="servicio-text">
                    <h2>Grooming</h2>
                    <p>Ofrecemos servicio de grooming que incluye baño, corte de pelo, limpieza de oídos, corte de uñas
                        y amor personalizado para cada mascota.</p>
                </div>
            </div>

            <div class="servicio">
                <img src="img/servicio3.png" alt="Venta de Productos">
                <div class="servicio-text">
                    <h2>Venta de Productos</h2>
                    <p>Encuentra accesorios para tu mascota como juguetes, ropita, camas, casas y muchas cosas más en
                        nuestras instalaciones.</p>
                </div>
            </div>

        </div>
    </section>


</body>
<?php 
    require_once "funciones.php";
    require_once "componentes/footer.php";?>
</html>
