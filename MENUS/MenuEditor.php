<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Editor</title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
</head>

<body class="oriental">

    <main class="container oriental">
        <header class="row oriental">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
            </div>
        </header>

        <section class="row">

            <div class="xl-col-12 l-col-12 m-col-12 s-col-12 separado">
                <h3>Menú Editor:</h3>
            </div>

            <form action="../Base_de_datos/controlador.php" method="POST" class="oriental">
                <div class="row">
                    <div class="col-4 margen-4 s-margen-0 s-col-12">
                        <div class="row p-d-1">
                            <input class="col-12" type="submit" value="Preguntas" name="GestionPreguntas">
                        </div>
                        <div class="row p-d-1">
                            <input class="col-12" type="submit" value="Estadisticas" name="Estadisticas">
                        </div>
                        <div class="row p-d-1">
                            <input class="col-12 botVolver" type="submit" value="Volver" name="VolverAlternativo">
                        </div>
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