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
        </header>
        <section class='row'>
            <div class="col-6 margen-3 s-col-12 s-margen-0">
                <div class="row">
                    <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                        <h3>Ranking:</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="oriental">
                            <tr>
                                <th>Nombre:</th>
                                <th>Puntuación:</th>
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
                        <input class="col-6" type="submit" value="Cerrar Sesion" name="CerrarSesion">
                        <input class="col-6 botVolver" type="submit" value="Volver" name="VolverMenu">
                    </div>
                </form>
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