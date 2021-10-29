<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion</title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
    <script src='https://www.google.com/recaptcha/api.js?render=6LdfMfEcAAAAAO5Q2ukW9JjGwfcFrsAr26it8u58'></script>
    <script src='../ValidacionYCaptcha/CaptchaGestion.js'></script>
    <script src="../ValidacionYCaptcha/validacionRegistro.js"></script>
</head>

<body class="oriental" onload="validacion()">
    <?php
    include_once '../Objetos/Persona.php';
    include_once '../Base_de_datos/Conexion.php';
    session_start();
    ?>
    <main class="container oriental">
        <header class="row oriental">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
            </div>
        </header>

        <section class="row">

            <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                <h3>Gestion:</h3>
            </div>

            <?php
            if ($_SESSION['Eleccion'] == 'Aniadir') {
            ?>
                <form action="../Base_de_datos/controlador.php" method="POST" class="oriental" novalidate>
                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                    <div class="row">
                        <div class=" margen-5 l-col-3 m-col-3 s-col-3 separado">
                            <label>Nombre:</label>
                            <input type="text" value="" id="nom" name="Nombre" placeholder="Inserta un Nombre" required>
                            <span class="error" id="nombreError" aria-live="polite"></span>
                        </div>
                        <div class="l-col-3 m-col-3 s-col-3 separado">
                            <label><input type="checkbox" id="Admin" name="tipousur[]" value="Ad">Administrador</label>
                            <label><input type="checkbox" id="Edit" name="tipousur[]" value="Ed">Editor</label>
                            <label><input type="checkbox" id="User" name="tipousur[]" value="Us">Usuario</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Email:</label>
                            <input type="email" value="" id="mail" name="Email" placeholder="Inserta un Email" required>
                            <span class="error" aria-live="polite"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Contraseña:</label>
                            <input type="text" value="" id="password" name="Password" placeholder="Inserta una Contraseña" required>
                            <span id="passwordError" class="error" aria-live="polite"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Confirmar Contraseña:</label>
                            <input type="text" value="" id="passwordConfirm" name="PasswordRepeat" placeholder="Inserta la Contraseña de nuevo" required>
                            <span class="error" id="passwordConfirmError" aria-live="polite"></span>
                        </div>

                    </div>

                    <div class="l-col-2 m-col-2 s-col-2">
                        <button type="submit" name='Editar' disabled><img src="../ICONOS/edit.png" class="tamaño"></button>
                    </div>

                    <div class="l-col-2 m-col-2 s-col-2">
                        <button type="submit" id="Registro" name='ADD'><img src="../ICONOS/add.png" class="tamaño"></button>
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
                $rol = Conexion::verRol($perAnt->getEmail());
            ?>
                <form action="../Base_de_datos/controlador.php" method="POST" class="oriental" novalidate>
                    <div class="row">
                        <div class=" margen-5 l-col-3 m-col-3 s-col-3 separado">
                            <label>Nombre:</label>
                            <input type="text" id="nom" value="<?php echo $perAnt->getNombre() ?>" name="Nombre" placeholder="Inserta un Nombre" required>
                            <span class="error" id="nombreError" aria-live="polite"></span>
                        </div>
                        <div class="l-col-3 m-col-3 s-col-3 separado">
                            <label><input type="checkbox" id="Admin" name="tipousur[]" <?php echo (isset($rol[0]) && ($rol[0] == 0)) || (isset($rol[1]) && ($rol[1] == 0)) || (isset($rol[2]) && ($rol[2] == 0)) ? ' checked' : ' '; ?> value="Ad">Administrador</label>
                            <label><input type="checkbox" id="Edit" name="tipousur[]" <?php echo (isset($rol[0]) && ($rol[0] == 1)) || (isset($rol[1]) && ($rol[1] == 1)) || (isset($rol[2]) && ($rol[2] == 1)) ? ' checked' : ' '; ?> value="Ed">Editor</label>
                            <label><input type="checkbox" id="User" name="tipousur[]" <?php echo (isset($rol[0]) && ($rol[0] == 2)) || (isset($rol[1]) && ($rol[1] == 2)) || (isset($rol[2]) && ($rol[2] == 2)) ? ' checked' : ' '; ?> value="Us">Usuario</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                            <label>Email:</label>
                            <input type="email" id="mail" value="<?php echo $perAnt->getEmail() ?>" name="Email" placeholder="Inserta un Email" required>
                            <span class="error" aria-live="polite"></span>
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
                        <button type="submit" id="Registro" name='Editar'><img src="../ICONOS/edit.png" class="tamaño"></button>

                    </div>

                    <div class="l-col-2 m-col-2 s-col-2">
                        <button type="submit" name='ADD' disabled><img src="../ICONOS/add.png" class="tamaño"></button>
                    </div>


                    <div class="l-col-2 m-col-2 s-col-2">
                        <input class="botVolver" type="submit" value="Volver" name="VolverAdministracion">
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
            <div class="xl-col-12 l-col-12 m-col-12 s-col-12">
                <p>Email: EscapeRoom@juegos.com</p>
            </div>
        </footer>
    </main>
</body>

</html>