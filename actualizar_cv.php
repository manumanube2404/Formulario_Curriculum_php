<?php
include "config/baseDatos.php";

// Recoger datos
$id = $_POST['cv_id'];
$nombre = $_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$email = $_POST['email'];
$edad = $_POST['edad'];
$experiencia = $_POST['descripcion'];
$habilidades = $_POST['habilidadesHidden'];
$formacion = $_POST['formacionesHidden'];
$idiomas = $_POST['idiomasHidden'];

/**
* ($_FILES = se rellena automaticamente con el archivo al enviar el formulario, guardandolo temporalmente)
* $_FILES['imagen']['name'] = nombre original del archivo
* $_FILES['imagen']['type'] = tipo (image/jpeg, etc.)
* $_FILES['imagen']['tmp_name'] = ruta temporal en el servidor
* $_FILES['imagen']['error'] = código de error (0 = OK)
* $_FILES['imagen']['size'] = tamaño en bytes
 * 
*/

if(isset($_FILES['imagen']) && $_FILES['imagen']['name'] != '') { // comprueba si se ha elegido una foto o no 
    $imagenNombre = time() . "_" . $_FILES['imagen']['name']; // usamos "time" para crear el nombre y asegurar que no haya 2 iguales 
    move_uploaded_file($_FILES['imagen']['tmp_name'], "assets/uploads/" . $imagenNombre); //mete la imagen en la carpeta uploads, para guardarla 
    $imagenSQL = ", foto='$imagenNombre'"; //crea un adelanto de la consulta sql, 
} else { //si no existe se le da valor vacio
    $imagenSQL = "";
}

// Actualizar en la base de datos
$sql = "UPDATE datos_cv SET 
        nombre='$nombre',
        apellido1='$apellido1',
        apellido2='$apellido2',
        email='$email',
        edad='$edad',
        experiencia='$experiencia',
        habilidades='$habilidades',
        formacion='$formacion',
        idiomas='$idiomas'
        $imagenSQL
        WHERE id=$id";

if($conexion_bd->query($sql)) { //si se actualiza lo manda a la vista del curriculum con ese id
    header("Location: ver_cv.php?id=$id");
    exit;
} else { //si no, salta un error
    echo "Error al actualizar: " . $conexion_bd->error;
}
?>
