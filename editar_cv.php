<?php
include "config/baseDatos.php"; //incluye la conexion con la base de datos
$id = $_GET['id'] ?? 0; // recoge el id que le llega por el enlace, si no existe le da el valor 0
$arrayDatos = $conexion_bd->query("SELECT * FROM datos_cv WHERE id=$id")->fetch_assoc(); //devuelve todos los datos relacionados con ese id, en forma de array asociativo

if(!$arrayDatos){ //si no existen registros devuelve un "CV no encontrado"
    die("CV no encontrado"); //( die= detiene el programa y evita que se siga ejecutando)
}

include "index.php"; // incluye index.php
?>
