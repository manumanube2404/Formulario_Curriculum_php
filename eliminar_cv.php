<?php
include "config/baseDatos.php"; //incluye la conexion con la base de datos
$id = $_GET['id']; // recoge el id
$conexion_bd->query("DELETE FROM datos_cv WHERE id=$id"); //borra el registro con ese id
header("Location: lista_versiones.php"); //te redirige a la lista de versiones
?>