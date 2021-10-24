<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking</title>
    <link rel="stylesheet" type="text/css" href="./CSS/general.css">
</head>

<body class="oriental">
    <?php
    require_once 'Persona.php';
    require_once 'Conexion.php';
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
                    <div class="margen-4 l-col-12 m-col-12 s-col-12 separado">
                        <table class="oriental">
                            <tr>
                                <td>Nombre:</td>
                                <td>Puntuacion:</td>
                            </tr>
                            <?php
                        foreach ($users as $persona) {
                            ?>
                            <tr>
                               <td><?php echo $persona->getNombre()?></td>
                               <td><?php echo $persona->getAciertos().' '.'pts'?></td>
                            </tr>
                            <?php
                        }
                            ?>
                        </table>  
                    </div>
                </div>

            <form action="controlador.php" method="POST" class="oriental">
                <div class="row">
                    <div class=" margen-4 l-col-3 m-col-3 s-col-3 separado">
                        <input type="submit" value="Cerrar Sesion" name="CerrarSesion">
                        <input type="submit" value="Volver" name="VolverMenu">
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