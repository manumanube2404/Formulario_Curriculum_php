<?php include "config/baseDatos.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Versiones de CV</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <h2>Historial de versiones</h2>

        <div class="table-card">
            <table class="tablaDatos">
                <thead>
                    <tr>
                        <th>Versión</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $datos = $conexion_bd->query("SELECT * FROM datos_cv ORDER BY version DESC"); //se trae los registros de la base de datos
                    while ($arrayDatos = $datos->fetch_assoc()): //crea un array asociativo en $arrayDatos, mientras que sigan quedando datos en la base de datos devolvera true 
                    ?>
                        <tr>
                            <td>#<?= $arrayDatos['version'] ?></td> <!-- Cogemos la version -->
                            <td><?= $arrayDatos['created_at'] ?></td><!-- cogemos la hora a la que se creo -->
                            <td class="actions-cell">
                                <a class="btn small primary" href="ver_cv.php?id=<?= $arrayDatos['id'] ?>">Ver</a> <!-- si pulsas, te lleva al pdf con ese id -->
                                <a class="btn small dark" href="editar_cv.php?id=<?= $arrayDatos['id'] ?>">Editar</a> <!-- si pulsas te lleva a editar el pdf con ese id -->
                                <a class="btn small danger" href="eliminar_cv.php?id=<?= $arrayDatos['id'] ?>" onclick="return confirm('¿Eliminar esta versión?')"> Eliminar </a><!-- si pulsas, salta una confirmacion y si aceptas se elima el registro con el id seleccionado -->
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="actions right">
            <a href="index.php" class="btn primary">Volver</a>
            <a href="index.php" class="btn primary">Crear nuevo CV</a>
        </div>
    </div>

</body>
</html>
