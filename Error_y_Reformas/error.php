<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
</head>

<body class="oriental">

    <?php
    session_start();
    $url = $_SESSION['url'];
    ?>
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
            <div class="col-6 margen-4 s-col-12 s-margen-0">
                <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                    <?php
                    echo '<p>' . $_SESSION['mensaje'] . '</p>';
                    ?>
                </div>

                <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                    <div class="row">
                        <input class="col-7 s-col-12 botVolver" type="submit" value="Volver" name="VolverLogin">
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