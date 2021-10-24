<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
        <header class="row oriental">
                <h1>Escape Web</h1>
                <h4>Tu pagina de scape room</h4>
            </div>
        </header>

        <section class="row">
            <div class="row">
                <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                    <h2>Login:</h2>
                </div>
            </div>

            
            <form action="controlador.php" method="POST" class="oriental">

                <div class="row">
                    <label class=" margen-4 xl-col-1 l-col-1 m-col-1 s-col-1">Email:</label>
                    <input class="xl-col-3 l-col-3 m-col-3 s-col-3" type="text" value="" name="Email" placeholder="Inserta tu Email" require>
                </div>

                <div class="row">
                    <label class="margen-4 xl-col-1 l-col-1 m-col-1 s-col-1">Contraseña:</label>
                    <input class="xl-col-3 l-col-3 m-col-3 s-col-3" type="text" value="" name="Password" placeholder="Inserta tu Contraseña" require>
                </div>

                <div class="row">
                    <div class=" margen-4 xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                        <input type="submit" value="Aceptar" name="Aceptar">
                        <input type="submit" value="Registrarse" name="Registrarse">
                    </div>

                    <div class="row">
                        <div class="xl-col-12 l-col-12 m-col-12 s-col-12">
                            <a class='oriental' href="./password.php">Se me ha olvidado la contraseña...</a>
                        </div>
                        <div class="row">
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