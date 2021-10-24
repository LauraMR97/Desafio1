<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas</title>
    <link rel="stylesheet" type="text/css" href="./CSS/general.css">
</head>

<body class="oriental">
    <?php
    require_once 'Persona.php';
    require_once 'Conexion.php';
    session_start();
    $preguntas = Conexion::ArrayDePreguntas();
    $perLoggeada = $_SESSION['per'];
    ?>
    <main class="container oriental">
        <header class="row oriental">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
            </div>
        </header>
        <section class='row'>

            <form name="formulario" action="Administracion.php" method="POST" class="oriental">
                <div class="row">
                    <div class="xl-col-3 l-col-3 m-col-3 s-col-3 separado">
                        <input type="text" name="parametroBuscado" placeholder="Inserta un nombre o email" value="">
                    </div>

                    <div class="xl-col-2 l-col-2 m-col-2 s-col-2 separado">
                        <input type="submit" value="Buscar" name="Buscar">
                    </div>

                    <div class="xl-col-2 l-col-2 m-col-2 s-col-2 separado">
                        <input type="submit" value="Ver Todas" name="Todos">
                    </div>
                </div>
            </form>

            <?php
            foreach ($preguntas as $pregunta) {
            ?>
                <form action="controlador.php" method="POST" class="oriental">

                    <div class="row">
                        <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                            Pregunta:<input type='text' value='<?php echo $pregunta; ?>' name='nombre'>
                            Respuesta:<input type='text' value='<?php echo $pregunta; ?>' name='email'>
                            <button type="submit" name='X'><img src="./ICONOS/eliminar.jpg" class="tamaño"></button>
                            <button type="submit" name='E'><img src="./ICONOS/edit.png" class="tamaño"></button>
                        </div>
                    </div>
                </form>
            <?php
            }

            ?>
            <form action="controlador.php" method="POST" class="oriental">
                <div class="row">
                    <div class=" margen-2 xl-col-2 l-col-2 m-col-2 s-col-2 separado">
                        <button type="submit" name='Aniadir'><img src="./ICONOS/addPregunta.png" class="tamaño"></button>
                    </div>
                    <div class="xl-col-2 l-col-2 m-col-2 s-col-2 separado">
                        <input type="submit" value="Cerrar Sesion" name="CerrarSesion">
                    </div>
                    <div class="xl-col-2 l-col-2 m-col-2 s-col-2 separado">
                        <input type="submit" value="Volver" name="VolverMenuEditor">
                    </div>
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