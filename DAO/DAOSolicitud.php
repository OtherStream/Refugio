<?php
require_once __DIR__ . '/conexion.php';

class DAOSolicitud
{
    private $conexion;

    private function conectar()
    {
        try {
            $this->conexion = Conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function agregar($id_usuario, $id_animal, $aceptado = false)
    {
        try {
            $sql = "INSERT INTO solicitudes (id_usuario, id_animal, aceptado)
                    VALUES (:id_usuario, :id_animal, :aceptado)";

            $this->conectar();
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([
                ':id_usuario' => $id_usuario,
                ':id_animal' => $id_animal,
                ':aceptado' => $aceptado ? 1 : 0
            ]);

            return $this->conexion->lastInsertId();
        } catch (PDOException $e) {
            error_log("DAOSolicitud::agregar: Error - " . $e->getMessage());
            return 0;
        } finally {
            Conexion::desconectar();
        }
    }

    public function obtenerPorUsuario($id_usuario)
    {
        try {
            $this->conectar();
            $lista = [];
            $sql = "SELECT s.id_usuario, s.id_animal, s.aceptado
                    FROM solicitudes s
                    WHERE s.id_usuario = :id_usuario";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([':id_usuario' => $id_usuario]);
            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach ($resultado as $fila) {
                $obj = new stdClass();
                $obj->id_usuario = $fila->id_usuario;
                $obj->id_animal = $fila->id_animal;
                $obj->aceptado = (bool)$fila->aceptado;
                $lista[] = $obj;
            }

            return $lista;
        } catch (PDOException $e) {
            error_log("DAOSolicitud::obtenerPorUsuario: Error - " . $e->getMessage());
            return [];
        } finally {
            Conexion::desconectar();
        }
    }

    public function obtenerTodos()
    {
        try {
            $this->conectar();
            $lista = [];
            $sql = "SELECT s.id_usuario, s.id_animal, s.aceptado
                    FROM solicitudes s";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach ($resultado as $fila) {
                $obj = new stdClass();
                $obj->id_usuario = $fila->id_usuario;
                $obj->id_animal = $fila->id_animal;
                $obj->aceptado = (bool)$fila->aceptado;
                $lista[] = $obj;
            }

            return $lista;
        } catch (PDOException $e) {
            error_log("DAOSolicitud::obtenerTodos: Error - " . $e->getMessage());
            return [];
        } finally {
            Conexion::desconectar();
        }
    }

    public function actualizarEstatus($id_solicitud, $aceptado)
    {
        try {
            $sql = "UPDATE solicitudes SET aceptado = :aceptado WHERE id_solicitud = :id_solicitud";

            $this->conectar();
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([
                ':aceptado' => $aceptado ? 1 : 0,
                ':id_solicitud' => $id_solicitud
            ]);

            $affectedRows = $stmt->rowCount();
            error_log("DAOSolicitud::actualizarEstatus: Affected rows = $affectedRows for id_solicitud = $id_solicitud");
            return $affectedRows > 0;
        } catch (PDOException $e) {
            error_log("DAOSolicitud::actualizarEstatus: Error - " . $e->getMessage());
            return false;
        } finally {
            Conexion::desconectar();
        }
    }
}
?>