<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking</title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
</head>

<body class="oriental">
    <?php
    require_once '../Objetos/Persona.php';
    require_once '../Base_de_datos/Conexion.php';
    session_start();
    $users = Conexion::PersonasOrdenadasPorAciertos();
    ?>
    <main class="container oriental">
        <header class="row oriental">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
            </div>
        </header>
        <section class='row'>

            <div class="row">
                <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                    <h3>Ranking:</h3>
                </div>
            </div>
            <div class="row margen-4">
                <div class="row">
                    <div class="xl-col-6 l-col-6 m-col-6 s-col-6 separado">
                        <table class="oriental">
                            <tr>
                                <td>Nombre:</td>
                                <td>Puntuacion:</td>
                            </tr>
                            <?php
                            foreach ($users as $persona) {
                            ?>
                                <tr>
                                    <td><?php echo $persona->getNombre() ?></td>
                                    <td><?php echo $persona->getAciertos() . ' ' . 'pts' ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>


                <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                    <div class="row p-d-1">
                        <input class="xl-col-3 l-col-3 m-col-3 s-col-3" type="submit" value="Cerrar Sesion" name="CerrarSesion">
                        <input class="xl-col-3 l-col-3 m-col-3 s-col-3" type="submit" value="Volver" name="VolverMenu">
                    </div>
                </form>
            </div>

            <footer class=" oriental row">
                <div class="xl-col-12 l-col-12 m-col-12 s-col-12">
                    <p>Email: EscapeRoom@juegos.com</p>
                </div>
            </footer>
        </section>
    </main>


</body>

</html>