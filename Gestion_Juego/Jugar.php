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
            <div class="col-6 margen-3 s-col-12 s-margen-0">
                <div class="xl-col-12  l-col-12 m-col-12 s-col-12 separado linea">
                    <h1 class="">Pública:</h1>
                </div>

                <div class="xl-col-12  l-col-12 m-col-12 s-col-12">
                    <?php
                    foreach ($salas as $sala) {
                    ?>
                        <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                            <input class="col-4" type='text' value='<?php echo $sala->getNombre() ?>' name='Nombre'>
                            <input class="col-4" type='text' value='<?php echo $sala->getNumPersonas() . '/5 Personas' ?>' name='Nombre'>
                            <input class="ocultar" type="texto" value="<?php echo $sala->getCodigo() ?>" name="codigoSecreto">
                            <input class="col-4" type="submit" value="Unirme" name="Unirse">
                        </form>
                    <?php
                    }
                    ?>

                    <div class="xl-col-12  l-col-12 m-col-12 s-col-12 separado linea">
                        <h1>Privada:</h1>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                                <input class="col-6" type="text" value="" name="codigo" placeholder="Ingresar Codigo">
                                <input class="col-6" type="submit" value="Unirme" name="UnirmePartida">
                            </form>
                        </div>
                    </div>

                    <div class="xl-col-12  l-col-12 m-col-12 s-col-12 separado linea">
                        <h1>Ser Anfitrión:</h1>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                                <input class="col-12" type="submit" value="Crear Partida" name="CrearPartida">
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                                <input class="col-6 botVolver" type="submit" value="Volver" name="VolverMenu">
                                <input class="col-6" type="submit" value="Cerrar Sesion" name="CerrarSesion">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        header("refresh:3;url=Jugar.php");
        ?>
        <footer class=" oriental row">
            <div class="xl-col-12 l-col-12 m-col-12 s-col-12">
                <p>Email: EscapeRoom@juegos.com</p>
            </div>
        </footer>
    </main>
</body>

</html>