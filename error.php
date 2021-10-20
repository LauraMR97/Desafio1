<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" type="text/css" href="./CSS/general.css">
</head>

<body class="oriental">

<?php
require_once 'controlador.php';
session_start();
$url=$_SESSION['url'];
?>
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
                <h3>Registro:</h3>
            </div>

            <div class=" margen-5 l-col-12 m-col-12 s-col-12 separado">
                <?php
                echo '<p>'.$_SESSION['mensaje'].'</p>';
                ?>
            </div>

            <form action="controlador.php" method="POST" class="oriental">
                <div class="row">
                    <div class=" margen-6 l-col-2 m-col-2 s-col-2 separadoPequeño">
                        <input type="submit" value="Volver" name="Volver">
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