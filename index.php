<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./CSS/general.css">
</head>

<body class="oriental">
    <?php
    session_start();
    $_SESSION['url'] = 'index.php';
    ?>
    <main class="container oriental">
        <header class="oriental row">
            <div class="row">
                <div class="l-col-12 m-col-12 s-col-12">
                    <h1 class='centrado'>ESCAPE WEB</h1>
                </div>
            </div>  
            <div class="row">
                <div class="l-col-12 m-col-12 s-col-12">
                    <h4 class='centrado'>Tu pagina de scape room</h4>
                </div>
            </div>
        </header>

        <section class="row">
        <div class="row">
            <div class=" margen-5 l-col-12 m-col-12 s-col-12 separado">
                <h2>Login:</h2>
            </div>
        </div>

            <form action="controlador.php" method="POST" class="oriental">
                <div class="row">
                        <label class="l-col-3 m-col-3 s-col-3 ">Email:</label>
                        <input class=" l-col-3 m-col-3 s-col-3 " type="text" value="" name="Email" placeholder="Inserta tu Email" require>
                </div>

                <div class="row">
                        <label class="l-col-3 m-col-3 s-col-3">Contraseña:</label>
                        <input class=" l-col-3 m-col-3 s-col-3" type="text" value="" name="Password" placeholder="Inserta tu Contraseña" require>
                </div>

                <div class="row">
                    <div class=" l-col-2 m-col-2 s-col-2 ">
                        <input type="submit" value="Aceptar" name="Aceptar">
                    </div>
                    <div class="l-col-2 m-col-2 s-col-2 ">
                        <input type="submit" value="Registrarse" name="Registrarse">
                </div>

                <div class="row">
                <div class=" l-col-12 m-col-12 s-col-12">
                        <a class='oriental' href="./password.php">Se me ha olvidado la contraseña...</a>
                    </div>
                    <div class="row">
            </form>
        </section>
        <footer class=" oriental row">
            <div class="l-col-12 m-col-12 s-col-12">
                <h4>Email: EscapeRoom@juegos.com</h4>
            </div>
        </footer>
    </main>
</body>

</html>