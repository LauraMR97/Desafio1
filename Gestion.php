<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion</title>
    <link rel="stylesheet" type="text/css" href="./CSS/general.css">
</head>

<body class="oriental">
    <?php
    include_once 'Persona.php';
    include_once 'Conexion.php';
    session_start();
    ?>
    <main class="container oriental">
        <header class="row oriental">
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

        <section class="row">

            <div class=" margen-5 l-col-12 m-col-12 s-col-12 separado">
                <h3>Gestion:</h3>
            </div>

            <?php
            if ($_SESSION['Eleccion'] == 'Aniadir') {
            ?>
                <form action="controlador.php" method="POST" class="oriental">
                    <div class="row">
                        <div class=" margen-5 l-col-3 m-col-3 s-col-3 separado">
                            <label>Nombre:</label>
                            <input type="text" value="" name="Nombre" placeholder="Inserta un Nombre">
                        </div>
                        <div class="l-col-3 m-col-3 s-col-3 separado">
                            <input type="radio" value="0" name="tipousur">Administrador<br>
                            <input type="radio" value="1" name="tipousur">Editor<br>
                            <input type="radio" value="2" name="tipousur">Usuario<br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Email:</label>
                            <input type="text" value="" name="Email" placeholder="Inserta un Email">
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Contraseña:</label>
                            <input type="text" value="" name="Password" placeholder="Inserta una Contraseña">
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Confirmar Contraseña:</label>
                            <input type="text" value="" name="PasswordRepeat" placeholder="Inserta la Contraseña de nuevo">
                        </div>

                    </div>

                    <div class="l-col-2 m-col-2 s-col-2">
                        <button type="submit" name='Editar' disabled><img src="./ICONOS/edit.png" class="tamaño"></button>
                    </div>

                    <div class="l-col-2 m-col-2 s-col-2">
                        <button type="submit" name='ADD'><img src="./ICONOS/add.png" class="tamaño"></button>
                    </div>


                    <div class="l-col-2 m-col-2 s-col-2">
                        <input type="submit" value="Volver" name="VolverAdministracion">
                    </div>

                    <div class="l-col-2 m-col-2 s-col-2 ">
                        <input type="submit" value="Cerrar Sesion" name="CerrarSesion">
                    </div>
                    </div>
                </form>
            <?php
            } else {
                $perAnt = Conexion::buscarPersonaPorCorreo($_SESSION['email']);
            ?>
                <form action="controlador.php" method="POST" class="oriental">
                    <div class="row">
                        <div class=" margen-5 l-col-3 m-col-3 s-col-3 separado">
                            <label>Nombre:</label>
                            <input type="text" value="<?php echo $perAnt->getNombre() ?>" name="Nombre" placeholder="Inserta un Nombre">
                        </div>
                        <div class="l-col-3 m-col-3 s-col-3 separado">
                            <input type="radio" value="0" name="tipousur">Administrador<br>
                            <input type="radio" value="1" name="tipousur">Editor<br>
                            <input type="radio" value="2" name="tipousur">Usuario<br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Email:</label>
                            <input type="text" value="<?php echo $perAnt->getEmail() ?>" name="Email" placeholder="Inserta un Email">
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Contraseña:</label>
                            <input type="text" value="" name="Password" placeholder="Inserta una Contraseña" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Confirmar Contraseña:</label>
                            <input type="text" value="" name="PasswordRepeat" placeholder="Inserta la Contraseña de nuevo" disabled>
                        </div>

                    </div>

                    <div class="l-col-2 m-col-2 s-col-2">
                        <button type="submit" name='Editar'><img src="./ICONOS/edit.png" class="tamaño"></button>

                    </div>

                    <div class="l-col-2 m-col-2 s-col-2">
                        <button type="submit" name='ADD' disabled><img src="./ICONOS/add.png" class="tamaño"></button>
                    </div>


                    <div class="l-col-2 m-col-2 s-col-2">
                        <input type="submit" value="Volver" name="VolverAdministracion">
                    </div>

                    <div class="l-col-2 m-col-2 s-col-2 ">
                        <input type="submit" value="Cerrar Sesion" name="CerrarSesion">
                    </div>
                    </div>
                </form>
            <?php
            }
            ?>
        </section>
        <footer class=" oriental row">
            <div class="l-col-12 m-col-12 s-col-12">
                <h4>Email: EscapeRoom@juegos.com</h4>
            </div>
        </footer>
    </main>
</body>

</html>