<?php
require_once __DIR__ . '/DAO/DAOEnAdopcion.php';
require_once __DIR__ . '/DAO/conexion.php'; 
require_once __DIR__ . '/modelos/adopcion.php'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animal = new AnimalAdopcion();
    $animal->nombre = $_POST['nombre'];
    $animal->descripcion = $_POST['descripcion'];
    $animal->tipo = $_POST['tipo'];
    $animal->tamano = $_POST['tamano'];
    $animal->color = $_POST['color'];
    $animal->genero = $_POST['genero'];
    $animal->estatus = 'activo';


    $imagenRuta = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombreImagen = basename($_FILES['imagen']['name']);
        $rutaDestino = '../imagenes/' . $nombreImagen;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
            $imagenRuta = $rutaDestino;
        }
    }
    $animal->imagen = $imagenRuta;

    // Guardar en BD
    $dao = new DAOAnimalAdopcion();
    $resultado = $dao->agregar($animal);

    if ($resultado > 0) {
        header("Location: Adoptar.php"); 
        exit;
    } else {
        echo "Error al guardar el animal.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
