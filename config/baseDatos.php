<?php
$conexion_bd = new mysqli("localhost", "root", "", "formulario_cv"); //crea la conexion con la base de datos "formulario_cv"

if ($conexion_bd->connect_error) { //si da un error de conexion salta el mensaje y para la ejecucución del codigo
    die("Error de conexión: " . $conexion_bd->connect_error);
}
?>