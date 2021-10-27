<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
    <script src='https://www.google.com/recaptcha/api.js?render=6LdfMfEcAAAAAO5Q2ukW9JjGwfcFrsAr26it8u58'></script>
    <script src='../ValidacionYCaptcha/CaptchaRegistro.js'></script>
    <script src='../ValidacionYCaptcha/validacionRegistro.js'></script>
</head>

<body class="oriental" onload='validacion()'>
    <main class="container oriental">
        <header class="row oriental">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
            </div>
        </header>

        <section class="row">

            <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                <h3>Registro:</h3>
            </div>

            <form action="../Base_de_datos/controlador.php" method="POST" class="oriental" novalidate>
                <div class="row margen-4">
                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                    <div class="row p-d-1">
                        <label class="xl-col-2 l-col-2 m-col-2 s-col-2">Nombre:</label>
                        <input class="xl-col-6 l-col-6 m-col-6 s-col-6" type=" text" value="" id="nom" name="Nombre" placeholder="Inserta tu Nombre" required minlength="4" maxlength="8">
                        <span class="error" id="nombreError" aria-live="polite"></span>
                    </div>

                    <div class="row p-d-1">
                        <label class="xl-col-2 l-col-2 m-col-2 s-col-2">Email:</label>
                        <input class="xl-col-6 l-col-6 m-col-6 s-col-6" type="email" id="mail" value="" name="Email" placeholder="Inserta tu Email" required>
                        <span class="error" aria-live="polite"></span>
                    </div>

                    <div class="row p-d-1">
                        <label class="xl-col-2 l-col-2 m-col-2 s-col-2">Contraseña:</label>
                        <input class="xl-col-6 l-col-6 m-col-6 s-col-6" type="text" id="password" value="" name="Password" placeholder="Inserta tu Contraseña" required>
                        <span id="passwordError" class="error" aria-live="polite"></span>
                    </div>

                    <div class="row p-d-1">
                        <label class="xl-col-2 l-col-2 m-col-2 s-col-2">Confirmar Contraseña:</label>
                        <input class="xl-col-6 l-col-6 m-col-6 s-col-6" type="text" id="passwordConfirm" value="" name="PasswordRepeat" placeholder="Inserta tu Contraseña de nuevo" required>
                        <span class="error" id="passwordConfirmError" aria-live="polite"></span>
                    </div>

                    <div class="row p-d-1">
                        <label class="xl-col-2 l-col-2 m-col-2 s-col-2">Foto(opcional):</label>
                        <input class="xl-col-6 l-col-6 m-col-6 s-col-6" type="file" value="" name="Foto">
                    </div>

                    <div class="row p-d-1">
                        <input class="xl-col-3 l-col-3 m-col-3 s-col-3" type="submit" value="Registrar" id="Registro" name="Registrar">
                        <input class="xl-col-3 l-col-3 m-col-3 s-col-3 botVolver" type="submit" class="botVolver" value="Volver" name="CerrarSesion">
                    </div>
                </div>
            </form>
        </section>
        <footer class=" oriental row">
            <div class="xl-col-12 l-col-12 m-col-12 s-col-12">
                <p>Email: EscapeRoom@juegos.com</p>
            </div>
        </footer>
    </main>
</body>

</html>