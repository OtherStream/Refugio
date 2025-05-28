<?php
function imprimir(){
}
function conectarBD() {
    try {
        $host = "localhost";
        $dbname = "Refugio";
        $usuario = "postgres";
        $contrasena = "root";

        $dsn = "pgsql:host=$host;dbname=$dbname";
        $opciones = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        return new PDO($dsn, $usuario, $contrasena, $opciones);
    } catch (PDOException $e) {
        die("Error de conexión a la base de datos: " . $e->getMessage());
    }
}
?>