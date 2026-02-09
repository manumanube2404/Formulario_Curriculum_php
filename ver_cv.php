<?php
include "config/baseDatos.php";

$id = $_GET['id'] ?? 0; //trae el id y si no existe ninguno, le da el valor 0
$datos = $conexion_bd->query("SELECT * FROM datos_cv WHERE id = $id"); //selecciona todos los datos de la tabla datos_cv, donde coincide el id
$arrayDatos = $datos->fetch_assoc(); //crea una array asociativa con los datos obtenidos 

if (!$arrayDatos) { //si la array asociativa esta vacia, salta un mensaje de no encontrado y para el flujo de la ejecucion
    die("CV no encontrado");
}

// Variables claras
$nombre = $arrayDatos['nombre'];
$apellido1 = $arrayDatos['apellido1'];
$apellido2 = $arrayDatos['apellido2'];
$email = $arrayDatos['email'];
$edad = $arrayDatos['edad'];
$experiencia = nl2br($arrayDatos['experiencia']); //el nl2br = convierte los \n en <br>

$imagenGuardada = $arrayDatos['foto'] 
    ? "assets/uploads/" . $arrayDatos['foto'] //si el usuario uso una foto, se muestra esa
    : "assets/uploads/default.png"; //en caso de que no usara , se mostrara la foto por defecto

//remplaza las x por espacios vacios
$arrayDatos['habilidades'] = str_replace("×", "", $arrayDatos['habilidades']); 
$arrayDatos['formacion'] = str_replace("×", "", $arrayDatos['formacion']);
$arrayDatos['idiomas'] = str_replace("×", "", $arrayDatos['idiomas']);

/*
 * explode = crea una array con los string (separandolos por las ",")
 * array_map 'trim'= quita los espacios del principio y del final a cada elemento de la array 
 * array_filter con (array_map 'trim') = devuelve los elementos de la array sin espacios
 */
$arrHabilidades = array_filter(array_map('trim', explode(",", $arrayDatos['habilidades'])));
$arrFormaciones = array_filter(array_map('trim', explode(",", $arrayDatos['formacion'])));
$arrIdiomas = array_filter(array_map('trim', explode(",", $arrayDatos['idiomas'])));
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="cv_style.css">

    <title>CV <?= $nombre . " " . $apellido1 ?></title>
</head>

<body>

    <header class="banner">
        <div class="container_16">
            <figure>
                <img src="<?= $imagenGuardada ?>" alt="<?= $nombre ?>">
            </figure>
            <hgroup>
                <h1 class="fadeInDown">
                    <?= $nombre . " " . $apellido1 . " " . $apellido2 ?>
                </h1>
                <h2 class="fadeInUp">Currículum vitae</h2>
            </hgroup>
        </div>
    </header>

    <section role="main" class="container_16">

        <div class="grid_16">
            <div class="grid_8 fadeInLeft">
                <i class="fa-regular fa-circle-user"></i>
                <h3>Sobre mí</h3>
                <p>
                    Mi nombre es <?= $nombre . " " . $apellido1 . " " . $apellido2 ?>
                    y tengo <?= $edad ?> años.
                </p>
                <p><?= $experiencia ?></p>
            </div>

            <div class="grid_8 knowledge fadeInRight">
                <i class="fa-regular fa-bookmark"></i>
                <h3>Habilidades</h3>
                <ul class="values">
                    <!-- recorremos la array y vamos mostrando cada elemento de esta misma -->
                    <?php foreach ($arrHabilidades as $habilidad): ?>
                        <li><?= htmlspecialchars($habilidad) ?></li> <!-- htmlspecialchars= convierte los caracteres especiales en string -->
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="grid_16 training appear">
            <i class="fa-solid fa-book"></i>
            <h3>Formación</h3>
            <div class="formation1">
                <ul>
                    <?php foreach ($arrFormaciones as $formacion): ?>
                        <li>
                            <h4><strong><?= htmlspecialchars($formacion) ?></strong></h4>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="grid_8 information fadeInUp">
            <i class="fa-solid fa-language"></i>
            <h3>Idiomas</h3>
            <ul class="information">
                <?php foreach ($arrIdiomas as $idioma): ?>
                    <li><?= htmlspecialchars($idioma) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

    </section>

    <footer class="footer">
        <div class="container_16">
            <div class="footer-content">
                <p>© 2026 <?= $nombre . " " . $apellido1 . " " . $apellido2 ?></p>

                <ul class="footer-social">
                    <li>
                        <a href="mailto:<?= $email ?>">
                            <i class="fa-solid fa-envelope"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com" target="_blank">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <div class="print-actions">
        <button class="print-btn" onclick="window.print()">Imprimir / PDF</button> <!-- cuando pulsas se abre el modo impresion del navegador para poder descargar el .pdf -->
    </div>

    <script src="https://kit.fontawesome.com/568acb1372.js" crossorigin="anonymous"></script>
    <script src="app.js"></script>

</body>

</html>