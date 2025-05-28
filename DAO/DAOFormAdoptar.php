<?php
require_once 'conexion.php';

class DAOFormAdoptar
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::getConexion();
    }

    /**
     * Valida y guarda el formulario de adopción en la BD
     */
    public function validarYGuardarFormulario($datos)
    {
        $errores = $this->validarDatos($datos);

        if (!empty($errores)) {
            return ['valido' => false, 'errores' => $errores];
        }

        try {
            // Procesar archivos
            $rutaCredencial = $this->guardarArchivo($FILES['credencial'], 'credencial');
            $rutaComprobante = $this->guardarArchivo($FILES['comprobante'], 'comprobante');

            // Insertar en BD
            $stmt = $this->conexion->prepare(
                "INSERT INTO FormularioAdopcion (
                    nombre, correo, direccion, edad, telefono, credencial, comprobante
                ) VALUES (?, ?, ?, ?, ?, ?, ?)"
            );

            $stmt->execute([
                $datos['nombre'],
                $datos['correo'],
                $datos['direccion'],
                $datos['edad'],
                $datos['telefono'],
                $rutaCredencial,
                $rutaComprobante
            ]);

            return [
                'valido' => true,
                'id_insertado' => $this->conexion->lastInsertId()
            ];

        } catch (PDOException $e) {
            error_log("Error en BD: " . $e->getMessage());
            $errores['general'] = "Error al guardar. Intente nuevamente.";
            return ['valido' => false, 'errores' => $errores];
        }
    }

    private function validarDatos($datos)
    {
        $errores = [];

        // Validar nombre
        if (empty($datos['nombre'])) {
            $errores['nombre'] = "El nombre es obligatorio.";
        } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $datos['nombre'])) {
            $errores['nombre'] = "Solo letras y espacios.";
        }

        // Validar correo
        if (empty($datos['correo'])) {
            $errores['correo'] = "El correo es obligatorio.";
        } elseif (!filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)) {
            $errores['correo'] = "Correo inválido.";
        }

        // Validar dirección
        if (empty($datos['direccion'])) {
            $errores['direccion'] = "La dirección es obligatoria.";
        }

        // Validar edad
        if (empty($datos['edad'])) {
            $errores['edad'] = "La edad es obligatoria.";
        } elseif ($datos['edad'] < 18 || $datos['edad'] > 100) {
            $errores['edad'] = "Debe ser entre 18 y 100 años.";
        }

        // Validar teléfono
        if (empty($datos['telefono'])) {
            $errores['telefono'] = "El teléfono es obligatorio.";
        } elseif (!preg_match("/^\d{10}$/", $datos['telefono'])) {
            $errores['telefono'] = "Debe tener 10 dígitos.";
        }

        // Validar archivos
        if (empty($_FILES['credencial']['name'])) {
            $errores['credencial'] = "La credencial es obligatoria.";
        } elseif ($_FILES['credencial']['size'] > 5 * 1024 * 1024) {
            $errores['credencial'] = "Máximo 5MB.";
        }

        if (empty($_FILES['comprobante']['name'])) {
            $errores['comprobante'] = "El comprobante es obligatorio.";
        } elseif ($_FILES['comprobante']['size'] > 5 * 1024 * 1024) {
            $errores['comprobante'] = "Máximo 5MB.";
        }

        return $errores;
    }

    private function guardarArchivo($archivo, $prefijo)
    {
        $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
        $nombreUnico = $prefijo . uniqid() . '.' . $extension;
        $rutaDestino = 'uploads/' . $nombreUnico;

        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true);
        }

        move_uploaded_file($archivo['tmp_name'], $rutaDestino);
        return $rutaDestino;
    }
}
?>