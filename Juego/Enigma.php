<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
    <title>Enigma</title>
    <script src="Enigma.js"></script>
</head>

<body class="oriental" onload="tiempo();pintar()">
    <?php
    require_once '../Base_de_datos/Conexion.php';
    require_once '../Objetos/Pregunta.php';
    require_once '../Objetos/Persona.php';
    session_start();
    $idEquipo = Conexion::verIDEquipo($_SESSION['creador']);
    $llaves = Conexion::verLlaves($idEquipo);
    $preguntas = Conexion::VerPregunta();
    $numPreguntas = Conexion::ContadorDePreguntasExistentes();
    $PersonasEquipo = Conexion::VerPersonasEquipo($idEquipo);
    $alea = rand(0, $numPreguntas - 1);
    $preguntaAleatoria = $preguntas[$alea];
    $idPregunta = Conexion::obtenerIDPregunta($preguntaAleatoria->getDescripcion());
    $Opciones = Conexion::verOpcionesDePregunta($idPregunta);
    $Anfitrion = Conexion::verAnfitrion($idEquipo);
    $Almirante = Conexion::verAlmirante($Anfitrion);
    $_SESSION['Almirante'] = $Almirante;
    $PerLoggeada = $_SESSION['per'];

    if ($llaves < 4) {
        if (isset($_REQUEST['verSolucion'])) {
            $res = $_REQUEST['opcion'];
            echo $res . '<br>';
            echo $preguntaAleatoria->getRespuesta() . '<br>';
            if ($preguntaAleatoria->getRespuesta() == $res) {
                $llaves = $llaves + 1;
                Conexion::sumarLlave($Anfitrion, $llaves);
                Conexion::addPersonaQueContesta($PerLoggeada->getEmail(), $idEquipo);
                $primeroEnContestar = Conexion::verPrimeroEnAcertar($idEquipo);
                Conexion::AscenderAlmirante($primeroEnContestar, $Anfitrion);
                $aciertos = Conexion::VerAciertos($PerLoggeada->getEmail());
                echo $aciertos;
                $aciertos = $aciertos + 1;
                Conexion::SumarAciertos($PerLoggeada->getEmail(), $aciertos);
            } else {
                echo 'Fallo';
            }
        }
        if (isset($_REQUEST['AnularPersona'])) {

        }
    } else {
        Conexion::Victoria($Anfitrion);
    ?>
        <script>
            ganar();
        </script>
    <?php
    }
    ?>
    <script>
        cargar('<?php echo $llaves ?>', '<?php echo  $preguntaAleatoria->getDescripcion(); ?>', '<?php echo $numPreguntas ?>', '<?php echo $PersonasEquipo ?>', '<?php echo $Opciones ?>', '<?php echo $Almirante ?>', '<?php echo $PerLoggeada->getEmail() ?>');
    </script>
    <main class="container oriental">
        <header class="row oriental">
            <h1>Escape Web</h1>
            <h4>Tu pagina de scape room</h4>
        </header>

        <section class="row">
            <div class="margen-3 s-margen-0 xl-col-6 l-col-6 m-col-6 s-col-12">

                <div class="row">
                    <div class="col-6" id="llaves"></div>
                </div>

                <div class="row p-d-1">
                    <div class="col-12" id="pregunta"></div>
                </div>

                <div id="respuestas"></div>

                <div class="row p-a-2">
                    <div id="personas"></div>
                </div>

                <div class="row p-a-1">
                    <div id="tiempo"></div>
                </div>

            </div>
        </section>

        <footer class=" oriental row">
            <div class="xl-col-12 l-col-12 m-col-12 s-col-12">
                <p>Email: EscapeRoom@juegos.com</p>
            </div>
        </footer>
    </main>
    <?php
    header("refresh:60;url=Enigma.php");
    ?>
</body>

</html>