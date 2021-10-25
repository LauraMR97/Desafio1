<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegir Rol </title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
</head>

<body class="oriental">

    <?php
    session_start();
    $_SESSION['url'] = 'ElegirRol.php';
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
                        <h2>Elegir Rol:</h2>
                    </div>
                </div>

                <form action="../controlador.php" method="POST" class="margen-3 xl-col-12 l-col-12 m-col-12 s-col-12 oriental">
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
                </form>
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