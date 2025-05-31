CREATE DATABASE Refugio;

CREATE TYPE estado_solicitud AS ENUM ('P', 'A', 'R');

CREATE TABLE adoptado (
id_adoptado SERIAL PRIMARY KEY,
nombre VARCHAR(50) NOT NULL,
imagen VARCHAR(100)
);

CREATE TABLE aviso(
id_aviso SERIAL PRIMARY KEY,
imagen VARCHAR(100) NOT NULL

);

CREATE TABLE enadopcion(
id_dar SERIAL PRIMARY KEY,
nombre VARCHAR(50) NOT NULL,
descripcion TEXT,
imagen VARCHAR(100),
tipo_animal VARCHAR(30),
tamano VARCHAR(20),
color VARCHAR(30),
genero VARCHAR(10),
estatus VARCHAR(20)
);

CREATE TABLE formularioadopcion(
id_formulario SERIAL PRIMARY KEY,
nombre VARCHAR(50) NOT NULL,
correo VARCHAR(100) NOT NULL,
direccion VARCHAR(100) NOT NULL,
edad INT,
telefono CHAR(10),
credencial VARCHAR(100),
comprobante VARCHAR(100)
);

CREATE TABLE producto (
id_producto SERIAL PRIMARY KEY,
nombre VARCHAR(50) NOT NULL,
descripcion TEXT,
precio NUMERIC(10,2),
imagen VARCHAR(100)
);

CREATE TABLE registrousuario(
id_usuario SERIAL PRIMARY KEY,
nombre VARCHAR(30) NOT NULL,
apellidos VARCHAR(45) NOT NULL,
usuario VARCHAR(30) NOT NULL,
pass VARCHAR(100) NOT NULL,
tipousuario VARCHAR(10) NOT NULL,
telefono CHAR(10) NOT NULL,
direccion VARCHAR(50) NOT NULL,
edad INT NOT NULL,
sexo VARCHAR(10)
);

CREATE TABLE servicio(
id_servicio SERIAL PRIMARY KEY,
nombre VARCHAR(30) NOT NULL,
descripcion TEXT,
imagen VARCHAR(100)
);

CREATE TABLE solicitudes (
id_solicitud SERIAL PRIMARY KEY,
id_usuario INT,
id_dar INT,
aceptado estado_solicitud NOT NULL,

FOREIGN KEY (id_usuario) REFERENCES registrousuario(id_usuario) ON DELETE CASCADE,
FOREIGN KEY (id_dar) REFERENCES enadopcion(id_dar) ON DELETE CASCADE
);

SELECT * from registrousuario;

INSERT INTO registrousuario (nombre, apellidos, usuario, pass, tipousuario, telefono, direccion, edad, sexo)
VALUES ('admminNombre', 'adminApellidos', 'admin', 'admin','admin','1123456789','adminDireccion',21,'Otro');

INSERT INTO registrousuario (nombre, apellidos, usuario, pass, tipousuario, telefono, direccion, edad, sexo)
VALUES ('Paty', 'Vega', 'paty', '1234','usuario','1123456789','patyDireccion',30,'Femenino');