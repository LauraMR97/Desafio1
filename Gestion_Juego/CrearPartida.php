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
    ?>
    <main class="container oriental">
        <header class="row oriental">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
            </div>
        </header>

        <section class="row">

            <div class="xl-col-12  l-col-12 m-col-12 s-col-12 separado">
                <h3>Crear Partida:</h3>
            </div>

            <div class="row margen-4">
                <div class="xl-col-12  l-col-12 m-col-12 s-col-12">
                    <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                        <div class="row p-a-1">
                            <label class="xl-col-3  l-col-3 m-col-3 s-col-3">Codigo de Sala:</label>
                            <input class="xl-col-4  l-col-4 m-col-4 s-col-4" type="text" name="Codigo" value="" placeholder="Codigo de sala">
                        </div>

                        <div class="row p-a-1">
                            <label class="xl-col-3  l-col-3 m-col-3 s-col-3">Nombre de Sala:</label>
                            <input class="xl-col-4  l-col-4 m-col-4 s-col-4" type="text" name="NomSala" value="" placeholder="Nombre de sala">
                        </div>

                        <div class="row p-a-1">
                        <span><input type="radio" value="Privada" name="opcion">Privada</span>
                        <span><input type="radio" value="Publica" name="opcion">Publica</span>
                        </div>

                        <div class="row p-a-1">
                            <input class="xl-col-2 l-col-2 m-col-2 s-col-2" type="submit" value="Crear" name="CrearP">
                            <input class="xl-col-2 l-col-2 m-col-2 s-col-2" type="submit" value="Volver" name="VolverJuego">
                            <input class="xl-col-3 l-col-3 m-col-3 s-col-3" type="submit" value="Cerrar Sesion" name="CerrarSesion">
                        </div>
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