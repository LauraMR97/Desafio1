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

            <?php
            ?>
            <div class="row margen-4">
                <div class="xl-col-12 l-col-12 m-col-12 s-col-12">
                    <form action="Lista.php" method="POST" class="oriental" novalidate>
                        <div class="row">
                            <span><input type="radio" value="0" name="opcion">Desconectados</span>
                            <span><input type="radio" value="1" name="opcion">Conectados</span>
                            <span><input type="radio" value="2" name="opcion">Todos</span>
                        </div>
                        <div class="row p-a-1 p-d-1">
                            <input class="xl-col-6 l-col-6 m-col-6 s-col-6" type="submit" value="Filtrar" name="Filtro">
                        </div>
                    </form>
                </div>
            </div>

            <?php
            if (isset($_REQUEST['Filtro'])) {
                $estado = $_REQUEST['opcion'];

                if ($estado == 0) {
            ?>
                    <div class="row margen-4">
                        <div class="xl-col-6 l-col-6 m-col-6 s-col-6">
                            <?php
                            foreach ($users as $persona) {
                                if ($persona->getConectado() == 0) {
                            ?>
                                    <table class="oriental">
                                        <tr>
                                            <td><?php echo '<h4>' . $persona->getNombre() . '</h4>' ?></td>
                                            <td><?php echo '<img src="../ICONOS/Desconectado.png" class="tamaño">' ?></td>
                                        </tr>
                                    </table>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                <?php
                }
                if ($estado == 1) {
                ?>
                    <div class="row margen-4">
                        <div class="xl-col-6 l-col-6 m-col-6 s-col-6">
                            <?php
                            foreach ($users as $persona) {
                                if ($persona->getConectado() == 1) {
                            ?>
                                    <table class="oriental">
                                        <tr>
                                            <td><?php echo '<h4>' . $persona->getNombre() . '</h4>' ?></td>
                                            <td><?php echo '<img src="../ICONOS/Conectado.png" class="tamaño">' ?></td>
                                        </tr>
                                    </table>

                            <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                <?php
                }
                if ($estado == 2) {
                ?>
                    <div class="row margen-4">
                        <div class="xl-col-6 l-col-6 m-col-6 s-col-6">
                            <?php
                            foreach ($users as $persona) {
                            ?>
                                <table class="oriental">
                                    <tr>
                                        <td><?php echo '<h4>' . $persona->getNombre() . '</h4>' ?></td>
                                        <td><?php if ($persona->getConectado() == 1) {
                                                echo '<img src="../ICONOS/Conectado.png" class="tamaño">';
                                            } else {
                                                echo '<img src="../ICONOS/Desconectado.png" class="tamaño">';
                                            } ?></td>
                                    </tr>
                                </table>
                    <?php
                            }
                        }
                    }

                    ?>
                        </div>
                    </div>

                    <div class="row margen-4">
                        <div class="xl-col-6 l-col-6 m-col-6 s-col-6">
                            <?php
                            if (!isset($_REQUEST['Filtro'])) {
                                foreach ($users as $persona) {
                            ?>
                                    <table class="oriental">
                                        <tr>
                                            <td><?php echo '<h4>' . $persona->getNombre() . '</h4>' ?></td>
                                            <td><?php if ($persona->getConectado() == 1) {
                                                    echo '<img src="../ICONOS/Conectado.png" class="tamaño">';
                                                } else {
                                                    echo '<img src="../ICONOS/Desconectado.png" class="tamaño">';
                                                } ?></td>
                                        </tr>
                                    </table>
                            <?php
                                }
                            }

                            ?>
                        </div>
                    </div>

                    <div class="row margen-4">
                        <div class="xl-col-6 l-col-6 m-col-6 s-col-6">
                            <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                                <div class="row p-a-1 p-d-1">
                                    <input class="xl-col-12 l-col-12 m-col-12 s-col-12 botVolver" type="submit" value="Volver" name="VolverMenu">
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