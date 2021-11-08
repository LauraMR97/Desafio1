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
        </header>

        <section class="row">
            <div class="col-6 margen-3 s-col-12 s-margen-0">
                <div class="row">
                    <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                        <h3>Registro:</h3>
                    </div>


                    <form action="../Base_de_datos/controlador.php" method="POST" class="oriental" novalidate>
                        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                        <div class="row p-d-1">
                            <label class="col-6">Nombre:</label>
                            <input class="col-6" type=" text" value="" id="nom" name="Nombre" placeholder="Inserta tu Nombre" required minlength="4" maxlength="8">
                            <span class="error" id="nombreError" aria-live="polite"></span>
                        </div>

                        <div class="row p-d-1">
                            <label class="col-6">Email:</label>
                            <input class="col-6" type="email" id="mail" value="" name="Email" placeholder="Inserta tu Email" required>
                            <span class="error" aria-live="polite"></span>
                        </div>

                        <div class="row p-d-1">
                            <label class="col-6">Contraseña:</label>
                            <input class="col-6" type="text" id="password" value="" name="Password" placeholder="Inserta tu Contraseña" required>
                            <span id="passwordError" class="error" aria-live="polite"></span>
                        </div>

                        <div class="row p-d-1">
                            <label class="col-6">Confirmar Contraseña:</label>
                            <input class="col-6" type="text" id="passwordConfirm" value="" name="PasswordRepeat" placeholder="Inserta tu Contraseña de nuevo" required>
                            <span class="error" id="passwordConfirmError" aria-live="polite"></span>
                        </div>

                        <div class="row p-d-1">
                            <label class="col-6">Foto(opcional):</label>
                            <input class="col-6" type="file" value="" name="Foto">
                        </div>

                        <div class="row p-d-1">
                            <input class="col-6" type="submit" value="Registrar" id="Registro" name="Registrar">
                            <input class="col-6 botVolver" type="submit" class="botVolver" value="Volver" name="VolverLogin">
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