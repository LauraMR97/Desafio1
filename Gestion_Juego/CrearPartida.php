<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Partida</title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
</head>

<body class="oriental">

    <?php
    session_start();
    if ($_SESSION['mensaje']) {
        $mensaje = $_SESSION['mensaje'];
        echo '<p>' . $mensaje . '<p>';
    }
    ?>
    <main class="container oriental">
        <header class="row oriental">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
            </div>
        </header>

        <section class="row">
            <div class="col-6 margen-3 s-col-12 s-margen-0">
                <div class="row">
                    <div class="xl-col-12  l-col-12 m-col-12 s-col-12 separado">
                        <h3>Crear Partida:</h3>
                    </div>


                    <div class="xl-col-12  l-col-12 m-col-12 s-col-12">
                        <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                            <div class="row p-a-1">
                                <label class="col-6">Codigo de Sala:</label>
                                <input class="col-6" type="text" name="Codigo" value="" placeholder="Codigo de sala">
                            </div>

                            <div class="row p-a-1">
                                <label class="col-6">Nombre de Sala:</label>
                                <input class="col-6" type="text" name="NomSala" value="" placeholder="Nombre de sala">
                            </div>


                            <div class="row p-a-1">
                                <div class="col-6">
                                    <input type="radio" value="Privada" name="opcion">Privada
                                </div>
                                <div class="col-6">
                                    <input type="radio" value="Publica" name="opcion">Publica
                                </div>
                            </div>

                            <div class="row p-a-1">
                                <input class="col-4" type="submit" value="Crear" name="CrearP">
                                <input class="col-4" type="submit" value="Volver" name="VolverJuego">
                                <input class="col-4" type="submit" value="Cerrar Sesion" name="CerrarSesion">
                            </div>
                        </form>
                    </div>
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