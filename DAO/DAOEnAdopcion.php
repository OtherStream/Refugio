<?php
require_once __DIR__ . '/conexion.php';
require_once __DIR__ . '/../modelos/adopcion.php';

class DAOAnimalAdopcion
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

    public function agregar(AnimalAdopcion $obj)
{
    $clave = 0;
    try {
        $sql = 'INSERT INTO enadopcion
        (nombre, descripcion, imagen, tipo_animal, tamano, color, genero, estatus)
        VALUES
        (:nombre, :descripcion, :imagen, :tipo_animal, :tamano, :color, :genero, :estatus);';

        $this->conectar();
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':nombre' => $obj->nombre,
            ':descripcion' => $obj->descripcion,
            ':imagen' => $obj->imagen,
            ':tipo_animal' => $obj->tipo,
            ':tamano' => $obj->tamano,
            ':color' => $obj->color,
            ':genero' => $obj->genero,
            ':estatus' => 'activo' 
        ]);

        $clave = $this->conexion->lastInsertId();
        return $clave;
    } catch (Exception $e) {
        echo "Error al guardar en la base de datos: " . $e->getMessage();
        return 0;
    } finally {
        Conexion::desconectar();
    }
}



    public function obtenerTodos()
{
    try {
        $this->conectar();

        $lista = [];
        $sentenciaSQL = $this->conexion->prepare("SELECT * FROM enadopcion");
        $sentenciaSQL->execute();
        $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);

        foreach ($resultado as $fila) {
            $obj = new AnimalAdopcion();
            $obj->id = $fila->id_dar; // Cambia a id_dar
            $obj->nombre = $fila->nombre;
            $obj->descripcion = $fila->descripcion;
            $obj->imagen = $fila->imagen;
            $obj->tipo = $fila->tipo_animal; // Cambia a tipo_animal
            $obj->tamano = $fila->tamano;
            $obj->color = $fila->color;
            $obj->genero = $fila->genero;
            $lista[] = $obj;
        }

        return $lista;
    } catch (PDOException $e) {
        return null;
    } finally {
        Conexion::desconectar();
    }
}
public function obtenerUno($id)
{
    try {
        $this->conectar();
        $sentenciaSQL = $this->conexion->prepare("SELECT * FROM enadopcion WHERE id_dar = ?"); // Cambia a id_dar
        $sentenciaSQL->execute([$id]);

        $fila = $sentenciaSQL->fetch(PDO::FETCH_OBJ);
        if ($fila) {
            $obj = new AnimalAdopcion();
            $obj->id = $fila->id_dar; // Cambia a id_dar
            $obj->nombre = $fila->nombre;
            $obj->descripcion = $fila->descripcion;
            $obj->imagen = $fila->imagen;
            $obj->tipo = $fila->tipo_animal; // Cambia a tipo_animal
            $obj->tamano = $fila->tamano;
            $obj->color = $fila->color;
            $obj->genero = $fila->genero;
            return $obj;
        }

        return null;
    } catch (Exception $e) {
        return null;
    } finally {
        Conexion::desconectar();
    }
}

    public function eliminar($id)
    {
        try {
            $this->conectar();
            $sentenciaSQL = $this->conexion->prepare("DELETE FROM enadopcion WHERE id = ?");
            return $sentenciaSQL->execute([$id]);
        } catch (PDOException $e) {
            return false;
        } finally {
            Conexion::desconectar();
        }
    }

    public function editar(AnimalAdopcion $obj)
    {
        try {
            $sql = "UPDATE enadopcion
                    SET nombre = ?, descripcion = ?, imagen = ?, tipo = ?, tamano = ?, color = ?, genero = ?
                    WHERE id = ?";

            $this->conectar();
            $sentenciaSQL = $this->conexion->prepare($sql);
            $sentenciaSQL->execute([
                $obj->nombre,
                $obj->descripcion,
                $obj->imagen,
                $obj->tipo,
                $obj->tamano,
                $obj->color,
                $obj->genero,
                $obj->id
            ]);

            return true;
        } catch (PDOException $e) {
            return false;
        } finally {
            Conexion::desconectar();
        }
    }
}
?>