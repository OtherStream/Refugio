<?php
require_once __DIR__ . '/conexion.php';
require_once __DIR__ . '/../modelos/solicitudConDatos.php';

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

    public function agregar($id_usuario, $id_dar, $aceptado = 'P')
    {
        try {
            $this->conectar();
            $this->conexion->beginTransaction();

            // Insertar la solicitud
            $sql_solicitud = "INSERT INTO solicitudes (id_usuario, id_dar, aceptado)
                VALUES (:id_usuario, :id_dar, :aceptado)";
            $stmt_solicitud = $this->conexion->prepare($sql_solicitud);
            $stmt_solicitud->execute([
                ':id_usuario' => $id_usuario,
                ':id_dar' => $id_dar,
                ':aceptado' => $aceptado
            ]);

            // // Actualizar el estatus en la tabla enadopcion a 'inactivo'
            $sql_enadopcion = "UPDATE enadopcion SET estatus = 'inactivo' WHERE id_dar = :id_dar";
            $stmt_enadopcion = $this->conexion->prepare($sql_enadopcion);
            $stmt_enadopcion->execute([
                ':id_dar' => $id_dar
            ]);

            // Verificar si ambas operaciones afectaron filas
            $affectedRowsSolicitud = $stmt_solicitud->rowCount();
            $affectedRowsEnadopcion = $stmt_enadopcion->rowCount();

            if ($affectedRowsSolicitud > 0 && $affectedRowsEnadopcion > 0) {
                $this->conexion->commit();
                return [
                    'success' => true,
                    'message' => 'Solicitud registrada y estatus del animal actualizado exitosamente.',
                    'debug' => [
                        'id_usuario' => $id_usuario,
                        'id_dar' => $id_dar,
                        'aceptado' => $aceptado
                    ]
                ];
            } else {
                $this->conexion->rollBack();
                return [
                    'success' => false,
                    'message' => 'Error al registrar la solicitud o actualizar el estatus del animal.',
                    'debug' => [
                        'id_usuario' => $id_usuario,
                        'id_dar' => $id_dar,
                        'aceptado' => $aceptado,
                        'affectedRowsSolicitud' => $affectedRowsSolicitud,
                        'affectedRowsEnadopcion' => $affectedRowsEnadopcion
                    ]
                ];
            }
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            return [
                'success' => false,
                'message' => 'Error interno en la base de datos.',
                'debug' => [
                    'id_usuario' => $id_usuario,
                    'id_dar' => $id_dar,
                    'aceptado' => $aceptado,
                    'error' => $e->getMessage()
                ]
            ];
        } finally {
            if ($this->conexion) {
                Conexion::desconectar();
            }
        }
    }

    public function obtenerPorUsuario($id_usuario)
    {
        try {
            $this->conectar();
            $lista = [];
            $sql = "SELECT s.id_solicitud, s.id_usuario, CONCAT(ru.nombre, ' ', ru.apellidos) AS nombre_usuario, enad.nombre AS nombre_animal, s.aceptado
                    FROM solicitudes s JOIN enadopcion enad ON s.id_dar = enad.id_dar
                    JOIN registrousuario ru ON ru.id_usuario = s.id_usuario
                    WHERE s.id_usuario = :id_usuario";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([':id_usuario' => $id_usuario]);
            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach ($resultado as $fila) {
                $obj = new solicitudConDatos();
                $obj->id_solicitud = $fila->id_solicitud;
                $obj->id_usuario = $fila->id_usuario;
                $obj->nombre_usuario = $fila->nombre_usuario;   
                $obj->nombre_animal = $fila->nombre_animal;
                $obj->aceptado = $fila->aceptado;
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
            $sql = "SELECT s.id_solicitud, s.id_usuario, CONCAT(ru.nombre, ' ', ru.apellidos) AS nombre_usuario, enad.nombre AS nombre_animal, s.aceptado
                    FROM solicitudes s JOIN enadopcion enad ON s.id_dar = enad.id_dar
                    JOIN registrousuario ru ON ru.id_usuario = s.id_usuario";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach ($resultado as $fila) {
                $obj = new solicitudConDatos();
                $obj->id_solicitud = $fila->id_solicitud;
                $obj->id_usuario = $fila->id_usuario;
                $obj->nombre_usuario = $fila->nombre_usuario;   
                $obj->nombre_animal = $fila->nombre_animal;
                $obj->aceptado = $fila->aceptado;
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

    public function actualizarEstadoSolicitud($id_solicitud, $aceptado)
    {
        try {
            $this->conectar();
            $this->conexion->beginTransaction();

            // Actualizar el estado en la tabla solicitudes
            $sql_solicitudes = "UPDATE solicitudes SET aceptado = :aceptado WHERE id_solicitud = :id_solicitud";
            $stmt_solicitudes = $this->conexion->prepare($sql_solicitudes);
            $stmt_solicitudes->execute([
                ':aceptado' => $aceptado,
                ':id_solicitud' => $id_solicitud
            ]);
            $affectedRowsSolicitudes = $stmt_solicitudes->rowCount();

            // Actualizar el estado en la tabla enadopcion
            $sql_enadopcion = "UPDATE enadopcion SET estatus = :estado WHERE id_dar = (SELECT id_dar FROM solicitudes WHERE id_solicitud = :id_solicitud)";
            $stmt_enadopcion = $this->conexion->prepare($sql_enadopcion);
            $estado = $aceptado === 'a' ? 'adoptado' : 'activo';
            $stmt_enadopcion->execute([
                ':estado' => $estado,
                ':id_solicitud' => $id_solicitud
            ]);
            $affectedRowsEnadopcion = $stmt_enadopcion->rowCount();

            if ($affectedRowsEnadopcion === 0) {
                $this->conexion->rollBack();
                return [
                    'success' => false,
                    'message' => 'No se encontró el animal asociado a la solicitud'
                ];
            }

            $this->conexion->commit();
            error_log("DAOSolicitud::actualizarEstadoSolicitud: Affected rows = $affectedRowsSolicitudes for id_solicitud = $id_solicitud, estado = $estado");
            return [
                'success' => $affectedRowsSolicitudes > 0,
                'message' => $affectedRowsSolicitudes > 0 ? 'Estado de la solicitud y animal actualizado correctamente' : 'No se pudo actualizar el estado de la solicitud'
            ];
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            error_log("DAOSolicitud::actualizarEstadoSolicitud: Error - " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Error al actualizar el estado: ' . $e->getMessage()
            ];
        } finally {
            Conexion::desconectar();
        }
    }
}
?>