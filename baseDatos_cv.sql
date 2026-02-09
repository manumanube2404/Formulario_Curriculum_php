CREATE DATABASE IF NOT EXISTS formulario_cv;
USE formulario_cv;

CREATE TABLE datos_cv (
    id INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100),
    apellido1 VARCHAR(100),
    apellido2 VARCHAR(100),
    email VARCHAR(100),
    edad INT,
    experiencia TEXT,
    formacion TEXT,
    habilidades TEXT,
    idiomas TEXT,
    foto VARCHAR(255),
    version INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

