<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
    <script src="Historial.js"></script>
</head>

<body class="oriental" onload="pintar()">
    <?php
    require_once '../Objetos/Persona.php';
    require_once '../Base_de_datos/Conexion.php';
    session_start();
    $historial = Conexion::verHistorial();
    ?>
    <main class="container oriental">
        <header class="row oriental">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
        </header>
        <section class='row'>
            <div class="xl-col-12 l-col-12 m-col-12 s-col-12">

                <div id="historial"></div>
                <script>
                    cargar('<?php echo $historial ?>');
                </script>

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