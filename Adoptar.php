<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/adop-style.css">
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
<<<<<<< HEAD:Adoptar.html
                        <a class="nav-link" href="Adoptar.html">Adoptar</a>
=======
                        <a class="nav-link" href="Adoptar.php">Adoptados</a>
>>>>>>> 8ccaa0e (Actualización del proyecto):Adoptar.php
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

    <!--Cartas-->
    <div id="card-Container">
        <div class="card" style="width: 18rem;">
            <img src="img/perrito2.jpg" class="card-img-top" alt="Luna">
            <div class="card-body">
                <h5 class="card-title">Luna</h5>
                <p class="card-text">Una cachorra juguetona y llena de energía, lista para una familia amorosa.</p>
                <a href="#" class="btn btn-primary open-modal" data-bs-toggle="modal" data-bs-target="#animalModal">
                    Adoptar
                </a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="img/perrito3.jpg" class="card-img-top" alt="Max">
            <div class="card-body">
                <h5 class="card-title">Max</h5>
                <p class="card-text">Un perro leal y protector que busca un hogar donde pueda dar amor y compañía.</p>
                <a href="#" class="btn btn-primary open-modal" data-bs-toggle="modal" data-bs-target="#animalModal">
                    Adoptar
                </a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="img/perrito4.jpg" class="card-img-top" alt="Rocky">
            <div class="card-body">
                <h5 class="card-title">Rocky</h5>
                <p class="card-text">Aventurero y curioso, siempre está listo para jugar y explorar.</p>
                <a href="#" class="btn btn-primary open-modal" data-bs-toggle="modal" data-bs-target="#animalModal">
                    Adoptar
                </a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="img/perrito5.jpg" class="card-img-top" alt="Bella">
            <div class="card-body">
                <h5 class="card-title">Bella</h5>
                <p class="card-text">Dulce y cariñosa, siempre lista para dar y recibir amor.</p>
                <a href="#" class="btn btn-primary open-modal" data-bs-toggle="modal" data-bs-target="#animalModal">
                    Adoptar
                </a>
            </div>
        </div>
    </div>
    <div id="card-Container">
        <div class="card" style="width: 18rem;">
            <img src="img/gatito1.jpg" class="card-img-top" alt="Milo">
            <div class="card-body">
                <h5 class="card-title">Milo</h5>
                <p class="card-text">Un gatito curioso que ama explorar y descubrir nuevos lugares.</p>
                <a href="#" class="btn btn-primary open-modal" data-bs-toggle="modal" data-bs-target="#animalModal">
                    Adoptar
                </a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="img/gatito2.jpg" class="card-img-top" alt="Nala">
            <div class="card-body">
                <h5 class="card-title">Nala</h5>
                <p class="card-text">Tranquila y amorosa, disfruta de largas siestas y caricias suaves.</p>
                <a href="#" class="btn btn-primary open-modal" data-bs-toggle="modal" data-bs-target="#animalModal">
                    Adoptar
                </a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="img/gatito3.jpg" class="card-img-top" alt="Simba">
            <div class="card-body">
                <h5 class="card-title">Simba</h5>
                <p class="card-text">Valiente y juguetón, siempre está buscando nuevas aventuras.</p>
                <a href="#" class="btn btn-primary open-modal" data-bs-toggle="modal" data-bs-target="#animalModal">
                    Adoptar
                </a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="img/gatito4.jpg" class="card-img-top" alt="Luna">
            <div class="card-body">
                <h5 class="card-title">Luna</h5>
                <p class="card-text">Misteriosa y encantadora, con una mirada que enamora.</p>
                <a href="#" class="btn btn-primary open-modal" data-bs-toggle="modal" data-bs-target="#animalModal">
                    Adoptar
                </a>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="animalModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Formulario de Adopción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    <nav aria-label="Page navigation example" id="navegacion">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
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
