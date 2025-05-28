<?php
require_once "DAO/DAOEnAdopcion.php";
require_once "modelos/adopcion.php";

// Initialize DAO
$dao = new DAOAnimalAdopcion();
$animal = new AnimalAdopcion();

// Populate the animal object with form data
$animal->nombre = $_POST['nombre'] ?? '';
$animal->descripcion = $_POST['descripcion'] ?? '';
$animal->tipo = $_POST['tipo'] ?? '';
$animal->tamano = $_POST['tamano'] ?? '';
$animal->color = $_POST['color'] ?? '';
$animal->genero = $_POST['genero'] ?? '';

// Handle file upload for the image
$uploadDir = "img/"; // Adjust this path based on your project structure
$animal->imagen = '';
if (isset($_POST['id']) && !empty($_POST['id'])) {
    // If editing, fetch the existing animal to get the current image
    $animal->id = $_POST['id'];
    $existingAnimal = $dao->obtenerUno($animal->id);
    if ($existingAnimal) {
        $animal->imagen = $existingAnimal->imagen; // Default to existing image
    }
}

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $fileName = basename($_FILES['imagen']['name']);
    $uploadPath = $uploadDir . $fileName;
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadPath)) {
        $animal->imagen = $uploadPath;
    } else {
        // Handle upload error
        error_log("Failed to upload image: " . $_FILES['imagen']['error']);
    }
}

// Debug: Log the operation being performed
error_log("guardar_Animal.php: ID = " . ($_POST['id'] ?? 'Not set'));

// Perform the operation (edit or add)
$success = false;
if (isset($_POST['id']) && !empty($_POST['id'])) {
    // Edit existing animal
    $animal->id = $_POST['id'];
    $success = $dao->editar($animal);
    error_log("guardar_Animal.php: Editing animal with ID = " . $animal->id . ", Success = " . ($success ? 'true' : 'false'));
} else {
    // Add new animal
    $success = $dao->agregar($animal);
    error_log("guardar_Animal.php: Adding new animal, Success = " . ($success ? 'true' : 'false'));
}

// Redirect back to the list page
if ($success) {
    header("Location: lista_EnAdopcion.php");
} else {
    header("Location: lista_EnAdopcion.php?error=save_failed");
}
exit();
?>