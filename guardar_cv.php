<?php
include "config/baseDatos.php";

//datos
$nombre = $_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$email = $_POST['email'];
$edad = $_POST['edad'];


$experiencia = $_POST['descripcion'];
$formacion = $_POST['formacionesHidden'];
$habilidades = $_POST['habilidadesHidden'];
$idiomas = $_POST['idiomasHidden'];

//Foto
$foto = null;
if (!empty($_FILES['imagen']['name'])) { //comprueba si se ha elegido una foto o no
    $foto = time() . "_" . $_FILES['imagen']['name']; //Usamo "time" para crear el nombre y asegurar que no haya 2 iguales
    move_uploaded_file($_FILES['imagen']['tmp_name'],"assets/uploads/" . $foto); //mete la imagen en la carpeta uploads, para guardarla 
}

//Versiones
$datos = $conexion_bd->query("SELECT MAX(version) AS versiones FROM datos_cv"); //hace una consulta a la base de datos, (trae la version mas alta)
$arrayDatos = $datos->fetch_assoc(); //Convierte el resultado de la consulta en un array asociativo
$version = ($arrayDatos['versiones'] ?? 0) + 1; //si ya existe alguno, se usa , si no se usa el 0


//hace la consulta de Sql y prepara la consulta SQL, pero SIN datos
$stmt = $conexion_bd->prepare("
    INSERT INTO datos_cv
    (nombre, apellido1, apellido2, email, edad,
     experiencia, formacion, habilidades, idiomas,
     foto, version)
    VALUES (?,?,?,?,?,?,?,?,?,?,?)
");

$stmt->bind_param( //Asocia las variables a los ? de la consulta y les dice su tipo (con -> accede a los metodos y propiedades del objeto) 
    "ssssisssssi", // s= string / i= int
    $nombre,
    $apellido1,
    $apellido2,
    $email,
    $edad,
    $experiencia,
    $formacion,
    $habilidades,
    $idiomas,
    $foto,
    $version
);

$stmt->execute(); // Ejecuta los comandos anteriores

header("Location: ver_cv.php?id=" . $conexion_bd->insert_id); //te redirige a viwe_cv donde el "id = "
exit;
?>
