<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Generador de CV</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Si eiste el id introducido, usara a "update" como el action, en caso de que no exista el id, usara "save" -->
    <form action="<?= isset($arrayDatos['id']) ? 'actualizar_cv.php' : 'guardar_cv.php' ?>" method="POST"
        enctype="multipart/form-data" id="formulario">
        <?php if (isset($arrayDatos['id'])): ?>
            <!-- si el id existe, se guarda en oculto para actualizar el cv con ese mismo id -->
            <input type="hidden" name="cv_id" value="<?= $arrayDatos['id'] ?>">
        <?php endif; ?>
        <div class="container">
            <h1>Crea Tú Currículum Vitae</h1>
            <!-- Barra de progreso -->
            <div class="progress">
                <div class="progress-bar" id="progressBar"></div>
            </div>

            <section class="step active">
                <h2>Datos personales</h2>

                <div class="grid">
                    <div class="field">
                        <label>Nombre <span style="color:red">*</span></label>
                        <input type="text" name="nombre" maxlength="30" required>
                    </div>

                    <div class="field">
                        <label>Apellido 1 <span style="color:red">*</span></label>
                        <input type="text" name="apellido1" maxlength="30" required >
                    </div>

                    <div class="field">
                        <label>Apellido 2</label>
                        <input type="text" name="apellido2" maxlength="30">
                    </div>

                    <div class="field">
                        <label>Email <span style="color:red">*</span></label>
                        <input type="email" name="email" maxlength="30" required>
                    </div>

                    <div class="field">
                        <label>Edad <span style="color:red">*</span></label>
                        <input type="number" name="edad" min="16" max="100" required>
                    </div>
                </div>

                <div class="photo-section">
                    <div class="avatar">No Preview</div>
                    <div>
                        <input type="file" name="imagen" accept="image/*" hidden id="cargarFoto">
                        <button type="button" class="cargarFoto-btn" onclick="document.getElementById('cargarFoto').click()">
                            Seleccionar archivo
                        </button>
                        <span class="file-text">Imagen de perfil</span>
                        <p class="hint">PNG/JPG. Max 5MB.</p>
                    </div>
                </div>

                <div class="actions right">
                    <a href="lista_versiones.php"><button type="button" class="btn primary">Ver versiones
                            guardadas</button></a>
                    <button type="button" class="btn primary" onclick="nextStep()">Next</button>
                </div>
            </section>

            <section class="step">
                <h2>Experiencia y formación</h2>

                <div class="field full">
                    <label>Experiencia laboral <span style="color:red">*</span></label>
                    <textarea name="descripcion" placeholder="Describe tu experiencia laboral" maxlength="300"></textarea>
                </div>

                <div class="grid">

                    <div class="field">
                        <label>Formación académica <span style="color:red">*</span></label>
                        <div class="chip-input">
                            <input type="text" id="formacionInput"
                                placeholder="Ej: FP DAW, Grado en Informática + (Pulsa enter por cada formación)" maxlength="30">
                        </div>
                    </div>
                </div>

                <div>
                    <h4>Formaciones añadidas: </h4>
                    <ol id="listaFormacion"></ol>
                    <input type="hidden" name="formacionesHidden" id="formacionesHidden">
                </div>

                <div class="actions space">
                    <button type="button" class="btn dark" onclick="prevStep()">Back</button>
                    <a href="lista_versiones.php"><button type="button" class="btn primary">Ver versiones
                            guardadas</button></a>
                    <button type="button" class="btn primary" onclick="nextStep()">Next</button>
                </div>
            </section>

            <section class="step">
                <h2>Habilidades e idiomas</h2>

                <div class="field">
                    <label>Habilidades <span style="color:red">*</span></label>
                    <div class="chip-input">
                        <input type="text" id="habilidadesInput" placeholder="Ej: Asertivo, Gran nivel de liderazgo, Organizado + (Pulsa enter por cada habilidad)" maxlength="30">
                    </div>
                </div>

                <div>
                    <h4>Habilidades añadidas: </h4>
                    <ol id="listaHabilidades"></ol>
                    <input type="hidden" name="habilidadesHidden" id="habilidadesHidden">

                </div>

                <div class="field">
                    <label>Idiomas <span style="color:red">*</span></label>
                    <div class="chip-input">
                        <input type="text" id="idiomasInput" placeholder="Ej: Inglés avanzado, Español nativo + (Pulsa enter por cada Idioma)" maxlength="30">
                    </div>
                </div>

                <div>
                    <h4>Idiomas añadidas: </h4>
                    <ol id="listaIdiomas"></ol>
                    <input type="hidden" name="idiomasHidden" id="idiomasHidden">

                </div>

                <div class="actions space">
                    <button type="button" class="btn dark" onclick="prevStep()">Back</button>
                    <a href="lista_versiones.php"><button type="button" class="btn primary">Ver versiones
                            guardadas</button></a>
                    <button type="button" class="btn primary" onclick="nextStep()">Next</button>
                </div>
            </section>

            <section class="step">
                <h2>Confirmación de datos</h2>
                <div class="review" id="review"></div>
                <div class="actions space">
                    <button type="button" class="btn dark" onclick="prevStep()">Back</button>
                    <a href="lista_versiones.php"><button type="button" class="btn primary">Ver versiones
                            guardadas</button></a>
                    <button type="submit" class="btn primary">Submit</button>


                </div>
            </section>
        </div>
    </form>



    <script src="script.js"></script>
</body>

</html>