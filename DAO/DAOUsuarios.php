<?php
require_once __DIR__ . '/Conexion.php';

class DAOUsuarios {
    private $conexion;

    private function conectar() {
        try {
            $this->conexion = Conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function autenticarUsuario($usuario, $contrasenia) {
    try {
        $this->conectar();
        $sql = "SELECT * FROM RegistroUsuario WHERE Usuario = :usuario AND Pass = :contrasenia";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':usuario' => $usuario,
            ':contrasenia' => $contrasenia
        ]);

        $fila = $stmt->fetch(PDO::FETCH_OBJ);
        if ($fila) {
            $usuarioObj = new stdClass();
            $usuarioObj->id_usuario = $fila->id_usuario;
            $usuarioObj->Nombre = $fila->Nombre;
            $usuarioObj->Apellidos = $fila->Apellidos;
            $usuarioObj->Usuario = $fila->Usuario;
            $usuarioObj->tipousuario = $fila->tipousuario; // Fixed case here
            $usuarioObj->telefono = $fila->telefono;
            $usuarioObj->Direccion = $fila->Direccion;
            $usuarioObj->edad = $fila->edad;
            $usuarioObj->sexo = $fila->sexo;
            return $usuarioObj;
        }
        return null;
    } catch (PDOException $e) {
        return null;
    } finally {
        Conexion::desconectar();
    }
}

    public function registrarUsuario($nombre, $apellidos, $telefono, $direccion, $edad, $sexo, $usuario, $contrasenia, $tipoUsuario) {
        try {
            $this->conectar();
            $sql = "INSERT INTO RegistroUsuario (Nombre, Apellidos, Usuario, Pass, TipoUsuario, telefono, Direccion, edad, sexo) 
                    VALUES (:nombre, :apellidos, :usuario, :contrasenia, :tipoUsuario, :telefono, :direccion, :edad, :sexo)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':usuario' => $usuario,
                ':contrasenia' => $contrasenia, // Consider hashing the password in a production environment
                ':tipoUsuario' => $tipoUsuario,
                ':telefono' => $telefono,
                ':direccion' => $direccion,
                ':edad' => $edad,
                ':sexo' => $sexo
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Error al registrar usuario: " . $e->getMessage());
            return false;
        } finally {
            Conexion::desconectar();
        }
    }
    
}
?>