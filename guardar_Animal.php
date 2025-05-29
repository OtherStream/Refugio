<?php
session_start();
require_once "DAO/DAOEnAdopcion.php";
require_once "modelos/adopcion.php";

$dao = new DAOAnimalAdopcion();
$animal = new AnimalAdopcion();
$errores = [];

$animal->nombre = $_POST['nombre'] ?? '';
$animal->descripcion = $_POST['descripcion'] ?? '';
$animal->tipo = $_POST['tipo'] ?? '';
$animal->tamano = $_POST['tamano'] ?? '';
$animal->color = $_POST['color'] ?? '';
$animal->genero = $_POST['genero'] ?? '';

$isEdit = isset($_POST['id']) && !empty($_POST['id']);

// Validaciones
if (strlen(trim($animal->nombre)) < 3) {
    $errores[] = "El nombre debe tener al menos 3 caracteres.";
}

if (strlen(trim($animal->descripcion)) < 10) {
    $errores[] = "La descripción debe tener al menos 10 caracteres.";
}

if (!$isEdit && (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== UPLOAD_ERR_OK)) {
    $errores[] = "Debes seleccionar una imagen.";
}

if (!in_array($animal->tipo, ['perro', 'gato'])) {
    $errores[] = "Debes seleccionar un tipo válido.";
}

if (!in_array($animal->tamano, ['pequeño', 'mediano', 'grande'])) {
    $errores[] = "Debes seleccionar un tamaño válido.";
}

if (strlen(trim($animal->color)) < 3) {
    $errores[] = "El color debe tener al menos 3 caracteres.";
}

if (!in_array($animal->genero, ['macho', 'hembra'])) {
    $errores[] = "Debes seleccionar un género válido.";
}

$uploadDir = "img/";
$animal->imagen = '';
if ($isEdit) {
    $animal->id = $_POST['id'];
    $existingAnimal = $dao->obtenerUno($animal->id);
    if ($existingAnimal) {
        $animal->imagen = $existingAnimal->imagen;
    }
}

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $fileName = basename($_FILES['imagen']['name']);
    $uploadPath = $uploadDir . $fileName;
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadPath)) {
        $animal->imagen = $uploadPath;
    } else {
        $errores[] = "Error al cargar la imagen.";
    }
}

if (!empty($errores)) {
    $_SESSION['errores'] = $errores;
    $_SESSION['form_data'] = $_POST;
    header("Location: formulario_animal.php" . ($isEdit ? "?id=" . $animal->id : ""));
    exit();
}

$success = false;
if ($isEdit) {
    $success = $dao->editar($animal);
} else {
    $success = $dao->agregar($animal);
}

if ($success) {
    header("Location: lista_EnAdopcion.php");
} else {
    $_SESSION['errores'] = ["Error al guardar el animal en la base de datos."];
    $_SESSION['form_data'] = $_POST;
    header("Location: formulario_animal.php" . ($isEdit ? "?id=" . $animal->id : ""));
}
exit();
?>