<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sala Espera</title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
</head>

<body class="oriental">

    <?php
    require_once '../Base_de_datos/Conexion.php';
    require_once '../Objetos/Persona.php';
    require_once '../Objetos/Sala.php';
    session_start();
    $_SESSION['jugadores'] = Conexion::verNumeroJugadoresDeSala($_SESSION['codSala']);
    $_SESSION['creador'] = Conexion::verCreadorDeSala($_SESSION['codSala']);
    $numJugadores = $_SESSION['jugadores'];
    $creador =  $_SESSION['creador'];
    $perLoggeada = $_SESSION['per'];
    $_SESSION['estado'] = Conexion::verEstado($creador);
    $estado = $_SESSION['estado'];
    ?>
    <main class="container oriental">
        <header class="row oriental">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
            </div>
        </header>

        <section class="row">

            <div class="xl-col-12  l-col-12 m-col-12 s-col-12 separado">
                <h3>Sala Espera:</h3>
            </div>

            <div class="col-6 margen-4 s-col-12 s-margen-0">
                <div class="row p-i-4">
                    <div class="col-12">
                        <p><?php echo 'Participantes: ' . $numJugadores . '/5'; ?></p>
                    </div>
                </div>

                <div class="row p-i-2">
                    <div class="xl-col-12  l-col-12 m-col-12 s-col-12">
                        <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                            <?php
                            if ($numJugadores < 2) {
                            ?>
                                <input class="col-6 s-col-12" type="submit" value="Empezar Ya" name="EmpezarYA" disabled>
                                <?php
                            } else {
                                if (($numJugadores >= 2) && ($numJugadores <= 5) && ($perLoggeada->getEmail() == $creador)) {
                                ?>
                                    <input class="col-6 s-col-12" type="submit" value="Empezar Ya" name="EmpezarYA">
                                <?php

                                } else {
                                ?>
                                    <input class="col-6 s-col-12" type="submit" value="Empezar Ya" name="EmpezarYA" disabled>
                            <?php
                                }
                            }
                            header("refresh:1;url=SalaEspera.php");
                            if ($estado == 'Activo') {
                                header("Location:../Juego/Carga.php");
                                Conexion::DropSala($_SESSION['codSala']);
                            }
                            ?>
                        </form>
                    </div>
                </div>

                <div class="row p-i-2">
                    <div class="xl-col-12  l-col-12 m-col-12 s-col-12">
                        <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                            <input class="col-6 s-col-12 botVolver" type="submit" value="Volver" name="VolverDesdeSalaEspera">
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