<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupera tu cuenta</title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
    <script src='https://www.google.com/recaptcha/api.js?render=6LdfMfEcAAAAAO5Q2ukW9JjGwfcFrsAr26it8u58'></script>
    <script src='../ValidacionYCaptcha/CaptchaEnviar.js'></script>
    <script src='../ValidacionYCaptcha/validarEmail.js'></script>
</head>

<body class="oriental" onload="validacion()">
<main class="container oriental">
        <header class="row oriental">
                <h1>Escape Web</h1>
                <h4>Tu pagina de scape room</h4>
            </div>
        </header>

        <section class="row">

            <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                <h3>Recupera tu cuenta:</h3>
            </div>

            <form  action="../Base_de_datos/controlador.php" method="POST" class="oriental" novalidate>
            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

                <div class="row">
                    <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                        <label>Email:</label>
                        <input  type="email" id="mail" value="" name="correoDest" placeholder="Inserta tu Email" required>
                        <span class="error" aria-live="polite"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="margen-4 l-col-2 m-col-2 s-col-2 ">
                        <input type="submit" value="Enviar" name="Enviar" id="send">
                    </div>
                    <div class="l-col-2 m-col-2 s-col-2 ">
                        <input type="submit" value="Volver" name="CerrarSesion">
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