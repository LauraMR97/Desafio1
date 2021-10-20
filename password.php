<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupera tu cuenta</title>
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

            <div class=" margen-4 l-col-12 m-col-12 s-col-12 separado">
                <h3>Recupera tu cuenta:</h3>
            </div>

            <form action="controlador.php" method="POST" class="oriental">

                <div class="row">
                    <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                        <label>Email:</label>
                        <input type="text" value="" name="correoDest" placeholder="Inserta tu Email" require>
                    </div>
                </div>

                <div class="row">
                    <div class="margen-4 l-col-2 m-col-2 s-col-2 separado">
                        <input type="submit" value="Enviar" name="Enviar">
                    </div>
                    <div class=" margen-6 l-col-2 m-col-2 s-col-2 ">
                        <input type="submit" value="Volver" name="VolverIndex">
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