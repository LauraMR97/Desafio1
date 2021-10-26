<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./CSS/general.css">
    <script src='https://www.google.com/recaptcha/api.js?render=6LdfMfEcAAAAAO5Q2ukW9JjGwfcFrsAr26it8u58'></script>
    <script src='./ValidacionYCaptcha/Captcha.js'></script>
    <script src='./ValidacionYCaptcha/validacion.js'></script>
</head>

<body class="oriental" onload="validacion()">
    <?php
    session_start();
    $_SESSION['url'] = 'index.php';
    ?>
    <main class="container oriental">
        <header class="row oriental">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
            </div>
        </header>

        <section class="row">
            <div class="margen-3 xl-col-6 l-col-6 m-col-6 s-col-6">
                <div class="row">
                    <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                        <h2>Login:</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="xl-col-12 l-col-12 m-col-12 s-col-12">
                        <form action="./Base_de_datos/controlador.php" method="POST" class="oriental" novalidate>
                            <div class="row">
                                <label class="xl-col-6 l-col-6 m-col-6 s-col-6 alignDerecha">Email:</label>
                                <input class="xl-col-6 l-col-6 m-col-6 s-col-6" type="email" id="mail" required minlength="8"  value="" name="Email" placeholder="Inserta tu Email" required>
                                <span class="error" aria-live="polite"></span>
                            </div>

                            <div class="row">
                                <label class="xl-col-6 l-col-6 m-col-6 s-col-6 alignDerecha">Contraseña:</label>
                                <input class="xl-col-6 l-col-6 m-col-6 s-col-6" type="text" id="password" value="" name="Password" placeholder="Inserta tu Contraseña" required>
                                <span  id="passwordError" class="error" aria-live="polite"></span>
                            </div>
                            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                            
                            <div class="row p-a-1">
                                <input class="xl-col-6 l-col-6 m-col-6 s-col-6" type="submit" value="Aceptar" name="Aceptar" id="aceptar">
                                <input class="xl-col-6 l-col-6 m-col-6 s-col-6" type="submit" value="Registrarse" name="Registrarse" id="registrar">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <div class="row">
            <div class="xl-col-12 l-col-12 m-col-12 s-col-12">
                <a class='oriental' href="./Correo/password.php">Se me ha olvidado la contraseña...</a>
            </div>
        </div>
        <footer class=" oriental row">
            <div class="xl-col-12 l-col-12 m-col-12 s-col-12">
                <p>Email: EscapeRoom@juegos.com</p>
            </div>
        </footer>
    </main>
</body>

</html>