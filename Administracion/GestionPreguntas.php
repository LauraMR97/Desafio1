<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Preguntas</title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
    <script src="../ValidacionYCaptcha/validarPreguntas.js"></script>
</head>

<body class="oriental" onload="validacion()">
    <?php
    include_once '../Objetos/Persona.php';
    include_once '../Base_de_datos/Conexion.php';
    session_start();
    ?>
    <main class="container oriental">
        <header class="row oriental">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
            </div>
        </header>

        <section class="row">
            <?php
            if ($_SESSION['Eleccion'] == 'AniadirPreg') {
            ?>
                <div class="xl-margen-3 l-margen-3 m-margen-3 s-margen-0 xl-col-6 l-col-6 m-col-6 s-col-12">
                    <form action="../Base_de_datos/controlador.php" method="POST" class="oriental" novalidate>
                        <div class="row">
                            <label class="col-5">Pregunta:</label>
                            <input class="col-6" type="text" value="" id='preg' name="Pregunta" placeholder="Inserta una Pregunta" required>
                            <span class="error" id='PreguntaError' aria-live="polite"></span>
                        </div>

                        <div class="row p-a-1">
                            <label class="col-5">Opcion 1:</label>
                            <input class="col-6" type="text" value="" name="Op1" id="o1" placeholder="Inserta la Opcion 1" required>
                            <div class="col-1">
                                <input type="radio" value="1" name="opcion"><br>
                            </div>
                            <span class="error" aria-live="polite" id="ErrorO1"></span>
                        </div>

                        <div class="row p-a-1">
                            <label class="col-5">Opcion 2:</label>
                            <input class="col-6" type="text" value="" name="Op2" id="o2" placeholder="Inserta la Opcion 2" required>
                            <div class="col-1">
                                <input type="radio" value="2" name="opcion"><br>
                            </div>
                            <span class="error" aria-live="polite" id="ErrorO2"></span>
                        </div>

                        <div class="row p-a-1">
                            <label class="col-5">Opcion 3:</label>
                            <input class="col-6" type="text" value="" name="Op3" id="o3" placeholder="Inserta la Opcion 3" required>
                            <div class="col-1">
                                <input type="radio" value="3" name="opcion"><br>
                            </div>
                            <span class="error" aria-live="polite" id="ErrorO3"></span>
                        </div>

                        <div class="row p-a-1">
                            <label class="col-5">Opcion 4:</label>
                            <input class="col-6" type="text" value="" name="Op4" id="o4" placeholder="Inserta la Opcion 4" required>
                            <div class="col-1">
                                <input type="radio" value="4" name="opcion"><br>
                            </div>
                            <span class="error" aria-live="polite" id="ErrorO4"></span>
                        </div>

                        <div class="row p-a-1">
                            <button class="col-2 s-col-12 m-col-12" type="submit" name='EditarPre' disabled><img src="../ICONOS/edit.png" class="tamaño"></button>
                            <button class="col-2 s-col-12 m-col-12" type="submit" id="Gestionar" name='ADDPre'><img src="../ICONOS/addPregunta.png" class="tamaño"></button>
                            <input class="col-4 s-col-12 m-col-12" type="submit" value="Volver" name="VolverAPreguntas">
                            <input class="col-4 s-col-12 m-col-12" type="submit" value="Cerrar Sesion" name="CerrarSesion">
                        </div>

                    </form>
                </div>
            <?php
            } else {
                $preAnt = Conexion::buscarPreguntaConRespuesta($_SESSION['pregunta']);
                $_SESSION['preAnt'] = $preAnt;
                $idPregunta = Conexion::obtenerIDPregunta($preAnt->getDescripcion());
                $opciones = Conexion::obtenerArrayDeOpciones($idPregunta);
                $_SESSION['opcionesAnt'] = $opciones;
                $idRespuesta = Conexion::obtenerIDRespuesta($preAnt->getRespuesta());
                $respuestaAnt = Conexion::obtenerRespuesta($idRespuesta);
                $_SESSION['respuestaAnt'] = $respuestaAnt;
            ?>
                <div class="xl-margen-3 l-margen-3 m-margen-3 s-margen-0 xl-col-6 l-col-6 m-col-6 s-col-12">

                    <form action="../Base_de_datos/controlador.php" method="POST" class="oriental" novalidate>
                        <div class="row p-a-1">
                            <label class="col-5">Pregunta:</label>
                            <input class="col-6" type="text" id='preg' value="<?php echo $preAnt->getDescripcion(); ?>" name="Pregunta" placeholder="Inserta una Pregunta" required>
                            <span class="error" id='PreguntaError' aria-live="polite"></span>
                        </div>

                        <div class="row p-a-1">
                            <label class="col-5">Opcion 1:</label>
                            <input class="col-6" type="text" id="o1" value="<?php echo $opciones[0]; ?>" name="Op1" placeholder="Inserta la Opcion 1" required>
                            <div class="col-1">
                                <input type="radio" value="1" name="opcion" <?php echo $opciones[0] == $respuestaAnt ? ' checked' : ' '; ?>>
                            </div>
                            <span class="error" id="ErrorO1" aria-live="polite"></span>
                        </div>

                        <div class="row p-a-1">
                            <label class="col-5">Opcion 2:</label>
                            <input class="col-6" type="text" id="o2" value="<?php echo $opciones[1]; ?>" name="Op2" placeholder="Inserta la Opcion 2" required>
                            <div class="col-1">
                                <input type="radio" value="2" name="opcion" <?php echo $opciones[1] == $respuestaAnt ? ' checked' : ' '; ?>>
                            </div>
                            <span class="error" id="ErrorO2" aria-live="polite"></span>
                        </div>

                        <div class="row p-a-1">
                            <label class="col-5">Opcion 3:</label>
                            <input class="col-6" type="text" id="o3" value="<?php echo $opciones[2]; ?>" name="Op3" placeholder="Inserta la Opcion 3" required>
                            <div class="col-1">
                                <input type="radio" value="3" name="opcion" <?php echo $opciones[2] == $respuestaAnt ? ' checked' : ' '; ?>>
                            </div>
                            <span class="error" id="ErrorO3" aria-live="polite"></span>
                        </div>

                        <div class="row p-a-1">
                            <label class="col-5">Opcion 4:</label>
                            <input class="col-6" type="text" id="o4" value="<?php echo $opciones[3]; ?>" name="Op4" placeholder="Inserta la Opcion 4" required>
                            <div class="col-1">
                                <input type="radio" value="4" name="opcion" <?php echo $opciones[3] == $respuestaAnt ? ' checked' : ' '; ?>>
                            </div>
                            <span class="error" id="ErrorO4s" aria-live="polite"></span>
                        </div>


                        <div class="row p-a-1">
                            <button class="col-2 s-col-12 m-col-12" type="submit" id="Gestionar" name='EditarPre'><img src="../ICONOS/edit.png" class="tamaño"></button>
                            <button class="col-2 s-col-12 m-col-12" type="submit" name='ADDPre' disabled><img src="../ICONOS/addPregunta.png" class="tamaño"></button>
                            <input class="col-4 s-col-12 m-col-12" type="submit" value="Volver" name="VolverAPreguntas">
                            <input class="col-4 s-col-12 m-col-12" type="submit" value="Cerrar Sesion" name="CerrarSesion">
                        </div>
                    </form>
                </div>
            <?php
            }
            ?>
        </section>
        <footer class=" oriental row">
            <div class="xl-col-12 l-col-12 m-col-12 s-col-12">
                <p>Email: EscapeRoom@juegos.com</p>
            </div>
        </footer>
    </main>
</body>

</html>