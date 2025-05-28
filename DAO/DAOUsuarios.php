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
                $usuarioObj->nombre = $fila->nombre;
                $usuarioObj->apellidos = $fila->apellidos;
                $usuarioObj->usuario = $fila->usuario;
                $usuarioObj->tipousuario = $fila->tipousuario;
                $usuarioObj->telefono = $fila->telefono;
                $usuarioObj->direccion = $fila->direccion;
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
                ':contrasenia' => $contrasenia,
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

    public function obtenerTodos() {
        try {
            $this->conectar();
            $sql = "SELECT id_usuario, Nombre, Apellidos, Usuario, telefono FROM RegistroUsuario";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log("Error al obtener usuarios: " . $e->getMessage());
            return [];
        } finally {
            Conexion::desconectar();
        }
    }

    public function obtenerPorId($id) {
        try {
            $this->conectar();
            $sql = "SELECT * FROM RegistroUsuario WHERE id_usuario = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([':id' => $id]);
            $fila = $stmt->fetch(PDO::FETCH_OBJ);
            if ($fila) {
                $usuarioObj = new stdClass();
                $usuarioObj->id_usuario = $fila->id_usuario;
                $usuarioObj->nombre = $fila->nombre;
                $usuarioObj->apellidos = $fila->apellidos;
                $usuarioObj->usuario = $fila->usuario;
                $usuarioObj->tipousuario = $fila->tipousuario;
                $usuarioObj->telefono = $fila->telefono;
                $usuarioObj->direccion = $fila->direccion;
                $usuarioObj->edad = $fila->edad;
                $usuarioObj->sexo = $fila->sexo;
                $usuarioObj->pass = $fila->pass;
                return $usuarioObj;
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error al obtener usuario por ID: " . $e->getMessage());
            return null;
        } finally {
            Conexion::desconectar();
        }
    }

    public function actualizarUsuario($id, $nombre, $apellidos, $telefono, $direccion, $edad, $sexo, $usuario, $contrasenia, $tipoUsuario) {
        try {
            $this->conectar();
            $sql = "UPDATE RegistroUsuario SET Nombre = :nombre, Apellidos = :apellidos, Usuario = :usuario, Pass = :contrasenia, 
                    TipoUsuario = :tipoUsuario, telefono = :telefono, Direccion = :direccion, edad = :edad, sexo = :sexo 
                    WHERE id_usuario = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':usuario' => $usuario,
                ':contrasenia' => $contrasenia,
                ':tipoUsuario' => $tipoUsuario,
                ':telefono' => $telefono,
                ':direccion' => $direccion,
                ':edad' => $edad,
                ':sexo' => $sexo
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Error al actualizar usuario: " . $e->getMessage());
            return false;
        } finally {
            Conexion::desconectar();
        }
    }

    public function eliminarUsuario($id) {
        try {
            $this->conectar();
            $sql = "DELETE FROM RegistroUsuario WHERE id_usuario = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->rowCount() > 0; // Returns true if a row was deleted
        } catch (PDOException $e) {
            error_log("Error al eliminar usuario: " . $e->getMessage());
            return false;
        } finally {
            Conexion::desconectar();
        }
    }
}
?>