<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Preguntas</title>
    <link rel="stylesheet" type="text/css" href="./CSS/general.css">
</head>

<body class="oriental">
    <?php
    include_once 'Pregunta.php';
    include_once 'Conexion.php';
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
                <form action="controlador.php" method="POST" class="oriental">
                    <div class="row">
                        <div class=" margen-5 l-col-3 m-col-3 s-col-3 separado">
                            <label>Pregunta:</label>
                            <input type="text" value="" name="Pregunta" placeholder="Inserta una Pregunta">
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Opcion 1:</label>
                            <input type="text" value="" name="Op1" placeholder="Inserta la Opcion 1">
                            <input type="radio" value="1" name="opcion"><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Opcion 2:</label>
                            <input type="text" value="" name="Op2" placeholder="Inserta la Opcion 2">
                            <input type="radio" value="2" name="opcion"><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Opcion 3:</label>
                            <input type="text" value="" name="Op3" placeholder="Inserta la Opcion 3">
                            <input type="radio" value="3" name="opcion"><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Opcion 4:</label>
                            <input type="text" value="" name="Op4" placeholder="Inserta la Opcion 4">
                            <input type="radio" value="4" name="opcion"><br>
                        </div>
                    </div>

                    <div class="l-col-2 m-col-2 s-col-2">
                        <button type="submit" name='EditarPre' disabled><img src="./ICONOS/edit.png" class="tamaño"></button>
                    </div>

                    <div class="l-col-2 m-col-2 s-col-2">
                        <button type="submit" name='ADDPre'><img src="./ICONOS/add.png" class="tamaño"></button>
                    </div>


                    <div class="l-col-2 m-col-2 s-col-2">
                        <input type="submit" value="Volver" name="VolverAPreguntas">
                    </div>

                    <div class="l-col-2 m-col-2 s-col-2 ">
                        <input type="submit" value="Cerrar Sesion" name="CerrarSesion">
                    </div>
                    </div>
                </form>
            <?php
            } else {
                $preAnt = Conexion::buscarPreguntaConRespuesta($_SESSION['pregunta']);
            ?>
                <form action="controlador.php" method="POST" class="oriental">

                    <div class="row">
                        <div class=" margen-5 l-col-3 m-col-3 s-col-3 separado">
                            <label>Pregunta:</label>
                            <input type="text" value="<?php $preAnt->getDescripcion(); ?>" name="Pregunta" placeholder="Inserta una Pregunta">
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Opcion 1:</label>
                            <input type="text" value="" name="Op1" placeholder="Inserta la Opcion 1">
                            <input type="radio" value="1" name="opcion"><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Opcion 2:</label>
                            <input type="text" value="" name="Op2" placeholder="Inserta la Opcion 2">
                            <input type="radio" value="2" name="opcion"><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Opcion 3:</label>
                            <input type="text" value="" name="Op3" placeholder="Inserta la Opcion 3">
                            <input type="radio" value="3" name="opcion"><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Opcion 4:</label>
                            <input type="text" value="" name="Op4" placeholder="Inserta la Opcion 4">
                            <input type="radio" value="4" name="opcion"><br>
                        </div>
                    </div>


                    <div class="l-col-2 m-col-2 s-col-2">
                        <button type="submit" name='EditarPre'><img src="./ICONOS/edit.png" class="tamaño"></button>

                    </div>

                    <div class="l-col-2 m-col-2 s-col-2">
                        <button type="submit" name='ADDPre' disabled><img src="./ICONOS/add.png" class="tamaño"></button>
                    </div>


                    <div class="l-col-2 m-col-2 s-col-2">
                        <input type="submit" value="Volver" name="VolverAPreguntas">
                    </div>

                    <div class="l-col-2 m-col-2 s-col-2 ">
                        <input type="submit" value="Cerrar Sesion" name="CerrarSesion">
                    </div>
                    </div>
                </form>
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