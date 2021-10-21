<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion</title>
    <link rel="stylesheet" type="text/css" href="./CSS/general.css">
</head>

<body class="oriental">
    <?php
    require_once 'Persona.php';
    require_once 'Conexion.php';
    session_start();
    $_SESSION['url'] = './administracion.php';
    $users = Conexion::ArrayDePersonas();
    $perLoggeada = $_SESSION['per'];
    ?>
    <main class="container oriental">
        <header class="oriental row">
            <div class="row">
                <div class="l-col-12 m-col-12 s-col-12">
                    <h1>ESCAPE WEB</h1>
                </div>
            </div>

            <div class="row">
                <div class="l-col-12 m-col-12 s-col-12">
                    <h4>Tu pagina de scape room</h4>
                </div>
            </div>
        </header>
        <section class='row'>

            <form name="formulario" action="Administracion.php" method="POST" class="oriental">
                <div class="row">
                    <div class="l-col-12 m-col-12 s-col-12 separado">
                        <select name="Roles" onchange="d1(this)">
                            <option selected value="0"> Elige un Rol </option>
                            <optgroup label="Rol">
                                <option value="1">Administrador</option>
                                <option value="2">Editor</option>
                                <option value="3">Usuario</option>
                            </optgroup>
                    </div>
                </div>
                <div class="row">
                    <div class="l-col-12 m-col-12 s-col-12 separado">
                        <input type="submit" value="Buscar" name="Buscar">
                    </div>
                </div>
            </form>

            <?php
            if (isset($_REQUEST['Buscar'])) {
                $valor = $_POST['Roles'];
            }
            foreach ($users as $persona) {
                $rol = Conexion::verRol($persona->getEmail());
                if ($perLoggeada->getEmail() == $persona->getEmail()) {
            ?>
                    <form action="controlador.php" method="POST" class="oriental">
                        <div class="row">
                            <div class=" margen-1 l-col-12 m-col-12 s-col-12">
                                Nombre:<input type='text' value='<?php echo $persona->getNombre(); ?>' name='nombre' disabled>
                                Email:<input type='text' value='<?php echo $persona->getEmail(); ?>' name='email' disabled>
                            </div>
                        </div>
                    </form>
                <?php
                } else {
                    //CRUD DE LOS DEMÁS USUARIOS
                ?>
                    <?php
                    ?>
                    <form action="controlador.php" method="POST" class="oriental">

                        <div class="row">
                            <div class=" margen-1 l-col-12 m-col-12 s-col-12 separado">
                                Nombre:<input type='text' value='<?php echo $persona->getNombre(); ?>' name='nombre'>
                                Email:<input type='text' value='<?php echo $persona->getEmail(); ?>' name='email'>

                                <button type="submit" name='X'><img src="./ICONOS/eliminar.jpg.png" class="tamaño"></button>
                                <button type="submit" name='E'><img src="./ICONOS/edit.jpg.png" class="tamaño"></button>
                            </div>
                        </div>
                    </form>
            <?php
                }
            }
            ?>
            <form action="controlador.php" method="POST" class="oriental">
                <div class="row">
                    <div class=" margen-3 l-col-3 m-col-3 s-col-3 separado">
                        <button type="submit" name='ADD'><img src="./ICONOS/add.jpg.png" class="tamaño"></button>
                        <input type="submit" value="Cerrar Sesion" name="CerrarSesion">
                        <input type="submit" value="Volver" name="VolverRol">
                    </div>
                </div>
            </form>

            <footer class=" oriental row">
                <div class="l-col-12 m-col-12 s-col-12">
                    <h5>Email: EscapeRoom@juegos.com</h5>
                </div>
            </footer>
        </section>
    </main>


</body>

</html>