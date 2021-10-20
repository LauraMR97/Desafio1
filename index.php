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
    <main class="container oriental">
        <header class="oriental row centrado">
            <div class="row">
                <div class="l-col-12 m-col-12 s-col-12">
                    <h1>ESCAPE WEB</h1>
                </div>
                <div class="l-col-12 m-col-12 s-col-12">
                    <h5>Tu pagina de scape room</h5>
                </div>
            </div>
        </header>

        <section class="row">

            <div class=" margen-5 l-col-12 m-col-12 s-col-12 separado">
                <h3>Login:</h3>
            </div>

            <form action="controlador.php" method="POST" class="oriental">
                <div class="row">
                    <div class=" margen-5 l-col-3 m-col-3 s-col-3 separado">
                        <label>Email:</label>
                        <input type="text" value="" name="Email" placeholder="Inserta tu Email" require>
                    </div>
                </div>

                <div class="row">
                    <div class="margen-5 l-col-3 m-col-3 s-col-3">
                        <label>Contraseña:</label>
                        <input type="text" value="" name="Password" placeholder="Inserta tu Contraseña" require>
                    </div>
                </div>

                <div class="row">
                    <div class="margen-4 l-col-2 m-col-2 s-col-2 separado">
                        <input type="submit" value="Aceptar" name="Aceptar">
                    </div>
                    <div class=" margen-6 l-col-2 m-col-2 s-col-2 ">
                        <input type="submit" value="Registrarse" name="Registrarse">
                    </div>

                    <div class=" margen-8 l-col-3 m-col-3 s-col-3">
                        <a  class='oriental' href="./password.php">Se me ha olvidado...</a>
                    </div>
                </div>
            </form>
        </section>
        <footer class=" oriental row">
            <div class="l-col-12 m-col-12 s-col-12">
                <h5>Email: EscapeRoom@juegos.com</h5>
            </div>
        </footer>
    </main>
</body>

</html>