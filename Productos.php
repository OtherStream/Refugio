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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="styles/product-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <?php 
    require_once "componentes/header.php";
    ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/shampo.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Shampoo</h5>
                                <p class="card-text">Limpia. Elimina malos olores del pelo de tu mascota. Da volumen,
                                    suavidad y brillo natural. Agradable aroma.</p>
                                <p class="card-text"><small class="text-body-secondary">Precio 35$</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/alimento.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Alimento de calidad</h5>
                                <p class="card-text">Nutrición especializada que maximiza la calidad de vida de tu perro
                                    adulto de más de 7 años, rico en antioxidantes que ayuda a retrasar los signos de la
                                    edad.</p>
                                <p class="card-text"><small class="text-body-secondary">Precio $1000</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/juguetes.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Paquetes de juguetes</h5>
                                <p class="card-text">El juguete para perros está hecho de algodón y caucho 100% natural,
                                    que es suave y duradero para la dentición de cachorros.</p>
                                <p class="card-text"><small class="text-body-secondary">Precio $289</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/product4.jpeg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Cama</h5>
                                <p class="card-text">Cama para perros, grande, mediana, impermeable y lavable.</p>
                                <p class="card-text"><small class="text-body-secondary">Precio $185</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/chaleco.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Pecheras</h5>
                                <p class="card-text">Pechera arnés para perro ajustable con bandas reflectivas.</p>
                                <p class="card-text"><small class="text-body-secondary">Precio $185.60</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/plato.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Platos</h5>
                                <p class="card-text">Divisor de alimentos y agua, agarradera, ligera y duradera.</p>
                                <p class="card-text"><small class="text-body-secondary">Precio $41.60</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/cepillo.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Cepillo limpiador</h5>
                                <p class="card-text">Facilita el desenredado del pelo, proporciona un masaje relajante y
                                    promueve la circulación sanguínea en las mascotas.</p>
                                <p class="card-text"><small class="text-body-secondary">Precio $85</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/tunel.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Túnel</h5>
                                <p class="card-text">Túnel para gatos Rainbow mejorado, con plumas, cuentas y campanas.
                                </p>
                                <p class="card-text"><small class="text-body-secondary">Precio $250</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/correa.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Correas</h5>
                                <p class="card-text">Correa ajustable para perros, cómoda y resistente.</p>
                                <p class="card-text"><small class="text-body-secondary">Precio $39</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/comidagato.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Alimento para gato</h5>
                                <p class="card-text">Trocitos de salmón cocidos al vapor con un delicioso jelly que le
                                    otorgan el balance ideal.</p>
                                <p class="card-text"><small class="text-body-secondary">Precio $220</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
<?php 
    require_once "funciones.php";
    require_once "componentes/footer.php";?>

</html>
