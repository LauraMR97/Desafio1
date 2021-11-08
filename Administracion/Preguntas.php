<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas</title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
</head>

<body class="oriental">
    <?php
    require_once '../Objetos/Persona.php';
    require_once '../Objetos/Pregunta.php';
    require_once '../Base_de_datos/Conexion.php';
    session_start();
    $preguntas = Conexion::ArrayDePreguntas();
    $perLoggeada = $_SESSION['per'];
    ?>
    <main class="container oriental">
        <header class="row oriental">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
            </div>
        </header>
        <section class='row'>

            <form name="formulario" action="Preguntas.php" method="POST" class="oriental">
                <div class="row">
                    <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado margen-3">
                        <input type="text" name="parametroBuscado" placeholder="Inserta un nombre o email" value="">

                        <input type="submit" value="Buscar" name="BuscarPreg">
                
                        <input type="submit" value="Ver Todas" name="TodasPreg">
        
                </div>
            </form>

            <?php
            if (isset($_REQUEST['BuscarPreg'])) {
                foreach ($preguntas as $pregunta) {
                    if ($_REQUEST['parametroBuscado'] == $pregunta->getCreador()) {
            ?>
                <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">

                            <div class="row">
                                <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                                    Pregunta:<input type='text' value='<?php echo $pregunta->getDescripcion() ?>' name='desc' readonly>
                                    Respuesta:<input type='text' value='<?php echo $pregunta->getRespuesta(); ?>' name='resp' readonly>
                                    Creador:<input type='text' value='<?php echo $pregunta->getCreador(); ?>' name='creador' disabled>

                                    <button type="submit" name='XPreg'><img src="../ICONOS/eliminar.jpg" class="tamaño"></button>
                                    <button type="submit" name='EPreg'><img src="../ICONOS/edit.png" class="tamaño"></button>
                                </div>
                            </div>
                        </form>
                    <?php
                    }
                }
            }
            if (isset($_REQUEST['TodasPreg'])) {
                foreach ($preguntas as $pregunta) {
                    ?>
                <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">

                        <div class="row">
                            <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                                Pregunta:<input type='text' value='<?php echo $pregunta->getDescripcion() ?>' name='desc' readonly>
                                Respuesta:<input type='text' value='<?php echo $pregunta->getRespuesta(); ?>' name='resp' readonly>
                                Creador:<input type='text' value='<?php echo $pregunta->getCreador(); ?>' name='creador' disabled>

                                <button type="submit" name='XPreg'><img src="../ICONOS/eliminar.jpg" class="tamaño"></button>
                                <button type="submit" name='EPreg'><img src="../ICONOS/edit.png" class="tamaño"></button>
                            </div>
                        </div>
                    </form>
                <?php
                }
            }
            if (!isset($_REQUEST['BuscarPreg']) && !isset($_REQUEST['TodasPreg'])) {
                foreach ($preguntas as $pregunta) {
                ?>
                <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">

                        <div class="row">
                            <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                                Pregunta:<input type='text' value='<?php echo $pregunta->getDescripcion() ?>' name='desc' readonly>
                                Respuesta:<input type='text' value='<?php echo $pregunta->getRespuesta(); ?>' name='resp' readonly>
                                Creador:<input type='text' value='<?php echo $pregunta->getCreador(); ?>' name='creador' disabled>

                                <button type="submit" name='XPreg'><img src="../ICONOS/eliminar.jpg" class="tamaño"></button>
                                <button type="submit" name='EPreg'><img src="../ICONOS/edit.png" class="tamaño"></button>
                            </div>
                        </div>
                    </form>
            <?php
                }
            }
            ?>
                <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                <div class="row">
                    <div class="margen-4 xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                        <button type="submit" name='AniadirPreg'><img src="../ICONOS/addPregunta.png" class="tamaño"></button>
                        <input type="submit" value="Cerrar Sesion" name="CerrarSesion">

                        <input type="submit" value="Volver" name="VolverMenuEditor">
                    </div>
                </div>
                </div>
            </form>

            <footer class=" oriental row">
                <div class="xl-col-12 l-col-12 m-col-12 s-col-12">
                    <p>Email: EscapeRoom@juegos.com</p>
                </div>
            </footer>
        </section>
    </main>


</body>

</html>