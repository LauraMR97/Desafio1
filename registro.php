<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="./CSS/general.css">
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
                <h3>Registro:</h3>
            </div>

            <form action="controlador.php" method="POST" class="oriental">
                <div class="row">
                    <div class=" margen-5 l-col-3 m-col-3 s-col-3 separado">
                        <label>Nombre:</label>
                        <input type="text" value="" name="Nombre" placeholder="Inserta tu Nombre">
                    </div>
                </div>

                <div class="row">
                    <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                        <label>Email:</label>
                        <input type="text" value="" name="Email" placeholder="Inserta tu Email">
                    </div>
                </div>

                <div class="row">
                    <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                        <label>Contraseña:</label>
                        <input type="text" value="" name="Password" placeholder="Inserta tu Contraseña">
                    </div>
                </div>

                <div class="row">
                    <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                        <label>Confirmar Contraseña:</label>
                        <input type="text" value="" name="PasswordRepeat" placeholder="Inserta tu Contraseña de nuevo">
                    </div>
                </div>

                <div class="row">
                    <div class="margen-5 l-col-3 m-col-3 s-col-3 separadoPequeño">
                        <label>Foto(opcional):</label>
                        <input type="file" value="" name="Foto">
                    </div>
                </div>

                <div class="row">
                    <div class="l-col-2 m-col-2 s-col-2">
                        <input type="submit" value="Registrar" name="Registrar">
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