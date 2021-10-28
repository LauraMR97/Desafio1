<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Usuarios</title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
</head>

<body class="oriental">

    <?php
    require_once '../Objetos/Persona.php';
    require_once '../Base_de_datos/Conexion.php';
    session_start();
    $users = Conexion::ArrayDePersonas();
    ?>
    <main class="container oriental">
        <header class="row oriental">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
            </div>
        </header>

        <section class="row">

            <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                <h3>Lista de Usuarios:</h3>
            </div>
            <div class="row margen-3">
                <div class="xl-col-12 l-col-12 m-col-12 s-col-12">
                    <?php

                    foreach ($users as $persona) {
                    ?>
                        <div class="xl-col-7 l-col-7 m-col-7 s-col-7">
                            <table class="oriental">
                                <tr>
                                    <td><?php echo $persona->getNombre() ?></td>
                                    <td><?php echo $persona->getConectado() ?></td>
                                </tr>
                            </table>
                        </div>

                    <?php
                    }
                    ?>

                    <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                        <div class="row p-a-1 p-d-1">
                            <input class="xl-col-7 l-col-7 m-col-7 s-col-7" type="submit" value="Volver" name="CerrarSesion">
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