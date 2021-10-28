<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegir Rol </title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
</head>

<body class="gamer">

    <?php
    session_start();
    $_SESSION['url'] = 'ElegirRol.php';
    ?>

    <main class="container gamer">
        <header class="row gamer">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
            </div>
        </header>

        <section class="row">

            <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                <h3>Elegir Rol:</h3>
            </div>

                <form action="../Base_de_datos/controlador.php" method="POST" class="gamer">
                <div class="row margen-4">
                    <div class="row p-d-1">
                        <input class="xl-col-6 l-col-6 m-col-6 s-col-6" type="submit" value="Administrador" name="Administrador">
                    </div>
                    <div class="row p-d-1">
                        <input class="xl-col-6 l-col-6 m-col-6 s-col-6" type="submit" value="Usuario" name="Usuario">
                    </div>
                    <div class="row p-d-1">
                        <input class="xl-col-6 l-col-6 m-col-6 s-col-6 " type="submit" value="Editor" name="Editor">
                    </div>
                    <div class="row p-d-1">
                        <input class=" xl-col-6 l-col-6 m-col-6 s-col-6 " type="submit" value="Volver" name="CerrarSesion">
                    </div>
                </div>
                </form>
            </div>
        </section>
        <footer class=" gamer row">
            <div class="xl-col-12 l-col-12 m-col-12 s-col-12">
                <p>Email: EscapeRoom@juegos.com</p>
            </div>
        </footer>
    </main>
</body>

</html>