-- Crear la base de datos
CREATE DATABASE MIPROYECTO;

-- Seleccionar la base de datos
USE MIPROYECTO;

-- Crear la tabla "categorias"
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(255) NOT NULL
);

-- Crear la tabla "productos"
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(255) NOT NULL,
    descripcion_producto TEXT,
    precio_producto DECIMAL(10, 2) NOT NULL,
    categoria_producto INT,
    imagen_producto VARCHAR(255),
    FOREIGN KEY (categoria_producto) REFERENCES categorias(id)
);
