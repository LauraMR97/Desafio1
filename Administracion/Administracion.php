<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion</title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
</head>

<body class="oriental">
    <?php
    require_once '../Objetos/Persona.php';
    require_once '../Base_de_datos/Conexion.php';
    session_start();
    $_SESSION['url'] = './administracion.php';
    $users = Conexion::ArrayDePersonas();
    $perLoggeada = $_SESSION['per'];
    ?>
    <main class="container oriental">
        <header class="row oriental">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
            </div>
        </header>
        <section class='row'>

            <div class="row p-a-1 margen-4">
                <form name="formulario" action="Administracion.php" method="POST" class="oriental">
                    <div class="row">
                        <input class="xl-col-3 l-col-3 m-col-3 s-col-3" type="text" name="parametroBuscado" placeholder="Inserta un nombre o email" value="">
                        <input class="xl-col-2 l-col-2 m-col-2 s-col-2" type="submit" value="Buscar" name="Buscar">
                        <input class="xl-col-2 l-col-2 m-col-2 s-col-2" type="submit" value="Ver Todos" name="Todos">
                    </div>
                </form>
            </div>

            <?php
            if (isset($_REQUEST['Buscar'])) {
                $valor = $_POST['parametroBuscado'];
                foreach ($users as $persona) {
                    if ($valor == $persona->getNombre() || $valor == $persona->getEmail()) {
                        if ($perLoggeada->getEmail() == $persona->getEmail()) {
            ?>
                            <div class="row margen-1">
                                <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                                    <div class="row p-a-1">
                                        <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Nombre:</label>
                                        <input class=" xl-col-2 l-col-2 m-col-2 s-col-2" type='text' value='<?php echo $persona->getNombre(); ?>' name='nombre' disabled>
                                        <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Email:</label>
                                        <input class="xl-col-2 l-col-2 m-col-2 s-col-2" type='text' value='<?php echo $persona->getEmail(); ?>' name='email' disabled>
                                        <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Activo:</label>
                                        <input class=" xl-col-1 l-col-1 m-col-1 s-col-1" type='text' value='<?php if ($persona->getActivo()) {
                                                                                                                echo 'Si';
                                                                                                            } else {
                                                                                                                echo 'No';
                                                                                                            } ?>' name='email' disabled>
                                    </div>
                                </form>
                            </div>
                        <?php
                        } else {
                            //CRUD DE LOS DEMÁS USUARIOS
                        ?>
                            <?php
                            ?>
                            <div class="row margen-1">
                                <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">

                                    <div class="row p-a-1">

                                        <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Nombre:</label>
                                        <input class=" xl-col-2 l-col-2 m-col-2 s-col-2" type='text' value='<?php echo $persona->getNombre(); ?>' name='nombre' disabled>
                                        <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Email:</label>
                                        <input class=" xl-col-2 l-col-2 m-col-2 s-col-2" type='text' value='<?php echo $persona->getEmail(); ?>' name='email' disabled>
                                        <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Activo:</label>
                                        <input class=" xl-col-1 l-col-1 m-col-1 s-col-1" type='text' value='<?php if ($persona->getActivo()) {
                                                                                                                echo 'Si';
                                                                                                            } else {
                                                                                                                echo 'No';
                                                                                                            } ?>' name='email' disabled>

                                        <button type="submit" name='X'><img src="../ICONOS/eliminar.jpg" class="tamaño"></button>
                                        <button type="submit" name='E'><img src="../ICONOS/edit.png" class="tamaño"></button>
                                        <button type="submit" name='Activar'><img src="../ICONOS/up.png" class="tamaño"></button>
                                        <button type="submit" name='Desactivar'><img src="../ICONOS/down.png" class="tamaño"></button>

                                    </div>
                                </form>
                            </div>
            <?php
                        }
                    }
                }
            }
            ?>
            <?php
            if (isset($_REQUEST['Todos'])) {
                foreach ($users as $persona) {
                    if ($perLoggeada->getEmail() == $persona->getEmail()) {
            ?>
                        <div class="row margen-1">
                            <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                                <div class="row p-a-1">
                                    <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Nombre:</label>
                                    <input class=" xl-col-2 l-col-2 m-col-2 s-col-2" type='text' value='<?php echo $persona->getNombre(); ?>' name='nombre' disabled>
                                    <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Email:</label>
                                    <input class=" xl-col-2 l-col-2 m-col-2 s-col-2" type='text' value='<?php echo $persona->getEmail(); ?>' name='email' disabled>
                                    <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Activo:</label>
                                    <input class=" xl-col-1 l-col-1 m-col-1 s-col-1" type='text' value='<?php if ($persona->getActivo()) {
                                                                                                            echo 'Si';
                                                                                                        } else {
                                                                                                            echo 'No';
                                                                                                        } ?>' name='email' disabled>
                                </div>
                            </form>
                        </div>
                    <?php
                    } else {
                        //CRUD DE LOS DEMÁS USUARIOS
                    ?>
                        <div class="row margen-1">
                            <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">

                                <div class="row p-a-1">

                                    <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Nombre:</label>
                                    <input class=" xl-col-2 l-col-2 m-col-2 s-col-2" type='text' value='<?php echo $persona->getNombre(); ?>' name='nombre' disabled>
                                    <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Email:</label>
                                    <input class=" xl-col-2 l-col-2 m-col-2 s-col-2" type='text' value='<?php echo $persona->getEmail(); ?>' name='email' disabled>
                                    <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Activo:</label>
                                    <input class=" xl-col-1 l-col-1 m-col-1 s-col-1" type='text' value='<?php if ($persona->getActivo()) {
                                                                                                            echo 'Si';
                                                                                                        } else {
                                                                                                            echo 'No';
                                                                                                        } ?>' name='email' disabled>

                                    <button type="submit" name='X'><img src="../ICONOS/eliminar.jpg" class="tamaño"></button>
                                    <button type="submit" name='E'><img src="../ICONOS/edit.png" class="tamaño"></button>
                                    <button type="submit" name='Activar'><img src="../ICONOS/up.png" class="tamaño"></button>
                                    <button type="submit" name='Desactivar'><img src="../ICONOS/down.png" class="tamaño"></button>
                                </div>

                            </form>
                        </div>
                    <?php
                    }
                }
            }

            if (!isset($_REQUEST['Todos']) && !isset($_REQUEST['Buscar'])) {
                foreach ($users as $persona) {
                    if ($perLoggeada->getEmail() == $persona->getEmail()) {
                    ?>
                        <div class="row margen-1">
                            <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                                <div class="row p-a-1">
                                    <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Nombre:</label>
                                    <input class=" xl-col-2 l-col-2 m-col-2 s-col-2" type='text' value='<?php echo $persona->getNombre(); ?>' name='nombre' disabled>
                                    <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Email:</label>
                                    <input class=" xl-col-2 l-col-2 m-col-2 s-col-2" type='text' value='<?php echo $persona->getEmail(); ?>' name='email' disabled>
                                    <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Activo:</label>
                                    <input class=" xl-col-1 l-col-1 m-col-1 s-col-1" type='text' value='<?php if ($persona->getActivo()) {
                                                                                                            echo 'Si';
                                                                                                        } else {
                                                                                                            echo 'No';
                                                                                                        } ?>' name='email' disabled>
                                </div>
                            </form>
                        </div>
                    <?php
                    } else {
                        //CRUD DE LOS DEMÁS USUARIOS
                    ?>
                        <div class="row margen-1">
                            <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">

                                <div class="row p-a-1">

                                    <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Nombre:</label>
                                    <input class=" xl-col-2 l-col-2 m-col-2 s-col-2" type='text' value='<?php echo $persona->getNombre(); ?>' name='nombre' disabled>
                                    <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Email:</label>
                                    <input class=" xl-col-2 l-col-2 m-col-2 s-col-2" type='text' value='<?php echo $persona->getEmail(); ?>' name='email' disabled>
                                    <label class=" xl-col-1 l-col-1 m-col-1 s-col-1">Activo:</label>
                                    <input class="xl-col-1 l-col-1 m-col-1 s-col-1" type='text' value='<?php if ($persona->getActivo()) {
                                                                                                            echo 'Si';
                                                                                                        } else {
                                                                                                            echo 'No';
                                                                                                        } ?>' name='email' disabled>

                                    <button type="submit" name='X'><img src="../ICONOS/eliminar.jpg" class="tamaño"></button>
                                    <button type="submit" name='E'><img src="../ICONOS/edit.png" class="tamaño"></button>
                                    <button type="submit" name='Activar'><img src="../ICONOS/up.png" class="tamaño"></button>
                                    <button type="submit" name='Desactivar'><img src="../ICONOS/down.png" class="tamaño"></button>
                                </div>

                            </form>
                        </div>
            <?php
                    }
                }
            }
            ?>
            <div class="row margen-4">
                <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                    <div class="row p-a-1 p-d-1">
                        <button class="xl-col-2 l-col-2 m-col-2 s-col-2" type="submit" name='Aniadir'><img src="../ICONOS/add.png" class="tamaño"></button>
                        <input class="xl-col-3 l-col-3 m-col-3 s-col-3" type="submit" value="Cerrar Sesion" name="CerrarSesion">
                        <input class="xl-col-3 l-col-3 m-col-3 s-col-3" type="submit" value="Volver" name="VolverRol">
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