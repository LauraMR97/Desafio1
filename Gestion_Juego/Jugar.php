<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jugar</title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
</head>

<body class="oriental">

    <?php
    require_once '../Base_de_datos/Conexion.php';
    require_once '../Objetos/Sala.php';
    session_start();
    $salas = Conexion::verSalasPublicas();

    ?>
    <main class="container oriental">
        <header class="row oriental">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
            </div>
        </header>

        <section class="row">

            <div class="xl-col-12  l-col-12 m-col-12 s-col-12 separado">
                <h3>Jugar:</h3>
            </div>

            <?php
            foreach ($salas as $sala) {
            ?>
                <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                    <input type='text' value='<?php echo $sala->getNombre() ?>' name='Nombre'>
                    <input type='text' value='<?php echo $sala->getNumPersonas() . '/5 Participantes' ?>' name='Nombre'>
                    <input type="submit" value="Unirme" name="Unirse">
                </form>
            <?php
            }
            ?>

            <div class="row margen-2">
                <div class="xl-col-12  l-col-12 m-col-12 s-col-12">
                    <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                        <input class="xl-col-2 l-col-2 m-col-2 s-col-2" type="submit" value="Crear Partida" name="CrearPartida">
                        <input class="xl-col-2 l-col-2 m-col-2 s-col-2" type="submit" value="Unirme" name="UnirmePartida">
                        <input class="xl-col-2 l-col-2 m-col-2 s-col-2" type="text" value="" name="codigo" placeholder="Codigo">
                        <input class="xl-col-2 l-col-2 m-col-2 s-col-2" type="submit" value="Volver" name="VolverMenu">
                        <input class="xl-col-2 l-col-2 m-col-2 s-col-2" type="submit" value="Cerrar Sesion" name="CerrarSesion">
                    </form>
                </div>
            </div>

        </section>

        <footer class=" oriental row">
            <div class="xl-col-12 l-col-12 m-col-12 s-col-12">
                <p>Email: EscapeRoom@juegos.com</p>
            </div>
        </footer>
    </main>
</body>

</html>