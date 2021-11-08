<?php
require_once '../Objetos/Persona.php';
require_once './Conexion.php';
session_start();

/**
 * Me permite acceder a mi cuenta de usuario segun sea Admin, User o Editor
 */
if (isset($_REQUEST['Aceptar'])) {
    /*---------------------------------------CAPTCHA---------------------------------------*/
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LdfMfEcAAAAAFfwba49VTzhRfD6plZdZZx2RUiH';
    $recaptcha_response = $_POST['recaptcha_response'];
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    if ($recaptcha->score >= 0.7) {
        // OK. ERES HUMANO, EJECUTA ESTE CÓDIGO
    } else {
        // KO. ERES ROBOT, EJECUTA ESTE CÓDIGO
    }
    /*---------------------------------------------------------------------------------------------*/
    $email = $_REQUEST['Email'];
    $password = sha1($_REQUEST['Password']);
    $roles = array();

    $usu = Conexion::buscarPersona($email, $password);

    if ($usu->getActivo() != 0) {
        if ($usu != null) {
            $_SESSION['per'] = $usu;
            $rol = Conexion::verRol($email);
            $usu->Conectar();
            Conexion::ConectarPersona($email);

            if ((isset($rol[0]) && ($rol[0] == 0)) || (isset($rol[1]) && ($rol[1] == 0)) || (isset($rol[2]) && ($rol[2] == 0))) {
                header("Location:../MENUS/ElegirRol.php");
            } else {
                if ((isset($rol[0]) && ($rol[0] == 1)) || (isset($rol[1]) && ($rol[1] == 1)) || (isset($rol[2]) && ($rol[2] == 1))) {
                    header("Location:../MENUS/MenuEditor.php");
                } else {
                    if ((isset($rol[0]) && ($rol[0] == 2)) || (isset($rol[1]) && ($rol[1] == 2)) || (isset($rol[2]) && ($rol[2] == 2))) {
                        header("Location:../MENUS/menu.php");
                    }
                }
            }
        }
    } else {
        $_SESSION['mensaje'] = 'Aun no estas activo en este sitio web';
        header("Location:../Error_y_Reformas/error.php");
    }
}
/**
 * Me permite acceder a Registro.php
 */
if (isset($_REQUEST['Registrarse'])) {
    header("Location:../Ventanas/registro.php");
}

/**
 * Me permite registrar un usuario Estandar
 */
if (isset($_REQUEST['Registrar'])) {
    /*---------------------------------------CAPTCHA---------------------------------------*/
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LdfMfEcAAAAAFfwba49VTzhRfD6plZdZZx2RUiH';
    $recaptcha_response = $_POST['recaptcha_response'];
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    if ($recaptcha->score >= 0.7) {
        // OK. ERES HUMANO, EJECUTA ESTE CÓDIGO
    } else {
        // KO. ERES ROBOT, EJECUTA ESTE CÓDIGO
    }
    /*---------------------------------------------------------------------------------------------*/
    $nombre = $_REQUEST['Nombre'];
    $email = $_REQUEST['Email'];
    $passwrd = sha1($_REQUEST['Password']);
    $passwrdConfirm = sha1($_REQUEST['PasswordRepeat']);
    // $url = './PERFILES/' . $nombre . '.jpg';
    //$foto=$_FILES['Foto'][$url];

    //if($foto!=null){
    $persona = new Persona($nombre, $email);
    //$persona->setFoto($url);
    //}
    //else{
    //$persona= new Persona($nombre,$email,$passwrd);
    Conexion::addPersona($persona, $passwrd);
    Conexion::actualizarRolPersona($persona, 2);
    //-------------------------------Envio de mensaje de confirmacion
    $_SESSION['correoDest'] = $email;
    $_SESSION['urlConfirm'] = 'http://localhost/Desafio1/Mensaje_Confirmacion/confirmacion.php?email=' . $email;
    header("Location:../Mensaje_Confirmacion/enviarConfirmacion.php");
}

if (isset($_REQUEST['Enviar'])) {
    /*---------------------------------------CAPTCHA---------------------------------------*/
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LdfMfEcAAAAAFfwba49VTzhRfD6plZdZZx2RUiH';
    $recaptcha_response = $_POST['recaptcha_response'];
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    if ($recaptcha->score >= 0.7) {
        // OK. ERES HUMANO, EJECUTA ESTE CÓDIGO
    } else {
        // KO. ERES ROBOT, EJECUTA ESTE CÓDIGO
    }
    /*---------------------------------------------------------------------------------------------*/
    $email = $_REQUEST['correoDest'];
    $perAnt = Conexion::buscarPersonaPorCorreo($email);


    if ($perAnt != null) {
        $alea = rand(0, 3);
        $_SESSION['newPassword'] = '';
        $_SESSION['correoDest'] = $email;

        switch ($alea) {
            case 0:
                $_SESSION['newPassword'] = 'sdfdsfgs';
                break;
            case 1:
                $_SESSION['newPassword'] = 'jdsnfusdnfsu';
                break;
            case 2:
                $_SESSION['newPassword'] = 'fednfjsifs';
                break;
            case 3:
                $_SESSION['newPassword'] = 'iaushfgd';
                break;
        }
    }
    $perNew = new Persona($perAnt->getNombre(), $perAnt->getEmail());
    $perNew->setPassword(sha1($_SESSION['newPassword']));
    Conexion::editarPersona($perNew, $perAnt);

    header("Location:../Correo/enviar.php");
}

/*************************************************************************** */
/***********************************GESTION********************************** */
/*************************************************************************** */
/**
 * Añades como administrador a un Usuario,Administrador o Editor
 */
if (isset($_REQUEST['ADD'])) {
    /*---------------------------------------CAPTCHA---------------------------------------*/
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LdfMfEcAAAAAFfwba49VTzhRfD6plZdZZx2RUiH';
    $recaptcha_response = $_POST['recaptcha_response'];
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    if ($recaptcha->score >= 0.7) {
        // OK. ERES HUMANO, EJECUTA ESTE CÓDIGO
    } else {
        // KO. ERES ROBOT, EJECUTA ESTE CÓDIGO
    }
    /*---------------------------------------------------------------------------------------------*/
    $nombre = $_REQUEST['Nombre'];
    $email = $_REQUEST['Email'];
    $passwrd = sha1($_REQUEST['Password']);
    $passwrdConfirm = sha1($_REQUEST['PasswordRepeat']);
    $rol = $_REQUEST['tipousur'];

    $persona = new Persona($nombre, $email);
    Conexion::addPersona($persona, $passwrd);

    if ((isset($rol[0]) && ($rol[0] == 'Ad'))) {
        Conexion::actualizarRolPersona($persona, 0);
    } else {
        if ((isset($rol[1]) && ($rol[1] == 'Ad'))) {

            Conexion::actualizarRolPersona($persona, 0);
        } else {
            if ((isset($rol[2]) && ($rol[2] == 'Ad'))) {

                Conexion::actualizarRolPersona($persona, 0);
            }
        }
    }

    if ((isset($rol[0]) && ($rol[0] == 'Ed'))) {
        Conexion::actualizarRolPersona($persona, 1);
    } else {
        if ((isset($rol[1]) && ($rol[1] == 'Ed'))) {

            Conexion::actualizarRolPersona($persona, 1);
        } else {
            if ((isset($rol[2]) && ($rol[2] == 'Ed'))) {

                Conexion::actualizarRolPersona($persona, 1);
            }
        }
    }

    if ((isset($rol[0]) && ($rol[0] == 'Us'))) {
        Conexion::actualizarRolPersona($persona, 2);
    } else {
        if ((isset($rol[1]) && ($rol[1] == 'Us'))) {

            Conexion::actualizarRolPersona($persona, 2);
        } else {
            if ((isset($rol[2]) && ($rol[2] == 'Us'))) {

                Conexion::actualizarRolPersona($persona, 2);
            }
        }
    }


    header("Location:../Administracion/Administracion.php");
}
/**
 * Editas como administrador a cualquier usuario
 */
if (isset($_REQUEST['Editar'])) {
    /*---------------------------------------CAPTCHA---------------------------------------*/
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LdfMfEcAAAAAFfwba49VTzhRfD6plZdZZx2RUiH';
    $recaptcha_response = $_POST['recaptcha_response'];
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    if ($recaptcha->score >= 0.7) {
        // OK. ERES HUMANO, EJECUTA ESTE CÓDIGO
    } else {
        // KO. ERES ROBOT, EJECUTA ESTE CÓDIGO
    }
    /*---------------------------------------------------------------------------------------------*/
    $perAnt = Conexion::buscarPersonaPorCorreo($_SESSION['email']);
    $nombre = $_REQUEST['Nombre'];
    $email = $_REQUEST['Email'];
    $rol = $_REQUEST['tipousur'];


    Conexion::borrarRolPersona($perAnt->getEmail());
    $perNew = new Persona($nombre, $email);
    Conexion::editarPersonaAdministracion($perNew, $perAnt);


    if ((isset($rol[0]) && ($rol[0] == 'Ad'))) {
        Conexion::actualizarRolPersona($perNew, 0);
    } else {
        if ((isset($rol[1]) && ($rol[1] == 'Ad'))) {

            Conexion::actualizarRolPersona($perNew, 0);
        } else {
            if ((isset($rol[2]) && ($rol[2] == 'Ad'))) {

                Conexion::actualizarRolPersona($perNew, 0);
            }
        }
    }

    if ((isset($rol[0]) && ($rol[0] == 'Ed'))) {
        Conexion::actualizarRolPersona($perNew, 1);
    } else {
        if ((isset($rol[1]) && ($rol[1] == 'Ed'))) {

            Conexion::actualizarRolPersona($perNew, 1);
        } else {
            if ((isset($rol[2]) && ($rol[2] == 'Ed'))) {

                Conexion::actualizarRolPersona($perNew, 1);
            }
        }
    }

    if ((isset($rol[0]) && ($rol[0] == 'Us'))) {
        Conexion::actualizarRolPersona($perNew, 2);
    } else {
        if ((isset($rol[1]) && ($rol[1] == 'Us'))) {

            Conexion::actualizarRolPersona($perNew, 2);
        } else {
            if ((isset($rol[2]) && ($rol[2] == 'Us'))) {

                Conexion::actualizarRolPersona($perNew, 2);
            }
        }
    }


    header("Location:../Administracion/Administracion.php");
}
/*************************************************************************** */
/****************************GESTION PREGUNTAS****************************** */
/*************************************************************************** */
/**
 * Elimina una pregunta con la respuesta. Como esta en cascada, elimina las opciones.
 */
if (isset($_REQUEST['XPreg'])) {
    $Resp = $_REQUEST['resp'];
    $Preg = $_REQUEST['desc'];
    Conexion::delPreg($Preg);
    Conexion::delResp($Resp);
    header("Location:../Administracion/Preguntas.php");
}
/**
 *  La eleccion del crud ha sido Añadir, lo almacenamos en una sesion y 
 * vamos a GestionPreguntas.php. Para asi, una vez alli, habilitar segun que cosas
 * segun si le hemos dado a Añadir o a Editar
 */
if (isset($_REQUEST['AniadirPreg'])) {
    $_SESSION['Eleccion'] = 'AniadirPreg';
    header("Location:../Administracion/GestionPreguntas.php");
}

/**
 *  La eleccion del crud ha sido Editar, lo almacenamos en una sesion y 
 * vamos a GestionPreguntas.php. Para asi, una vez alli, habilitar segun que cosas
 * segun si le hemos dado a Añadir o a Editar
 */
if (isset($_REQUEST['EPreg'])) {
    $_SESSION['pregunta'] = $_REQUEST['desc'];
    $_SESSION['Eleccion'] = 'EditarPreg';
    header("Location:../Administracion/GestionPreguntas.php");
}

/**
 * Añadimos una pregunta, respuestas y opciones
 */
if (isset($_REQUEST['ADDPre'])) {
    $respuestaCorrecta = '';
    $pregunta = $_REQUEST['Pregunta'];
    $respuesta = $_REQUEST['opcion'];
    $op1 = $_REQUEST['Op1'];
    $op2 = $_REQUEST['Op2'];
    $op3 = $_REQUEST['Op3'];
    $op4 = $_REQUEST['Op4'];

    Conexion::addPregunta($pregunta, $_SESSION['per']);

    if ($respuesta == 1) {
        $respuestaCorrecta = $op1;
    } else {
        if ($respuesta == 2) {
            $respuestaCorrecta = $op2;
        } else {
            if ($respuesta == 3) {
                $respuestaCorrecta = $op3;
            } else {
                if ($respuesta == 4) {
                    $respuestaCorrecta = $op4;
                }
            }
        }
    }
    Conexion::addRespuesta($respuestaCorrecta);
    $idResp = Conexion::obtenerIDRespuesta($respuestaCorrecta);
    $idPre = Conexion::obtenerIDPregunta($pregunta);
    Conexion::actualizarPregResp($idResp, $idPre);
    Conexion::addOpciones($op1, $idPre);
    Conexion::addOpciones($op2, $idPre);
    Conexion::addOpciones($op3, $idPre);
    Conexion::addOpciones($op4, $idPre);
    header("Location:../Administracion/Preguntas.php");
}

/**
 * Editamos la pregunta, la respuesta y las opciones
 */
if (isset($_REQUEST['EditarPre'])) {
    $preNew = $_REQUEST['Pregunta'];
    $opNew1 = $_REQUEST['Op1'];
    $opNew2 = $_REQUEST['Op2'];
    $opNew3 = $_REQUEST['Op3'];
    $opNew4 = $_REQUEST['Op4'];
    $respuesta = $_REQUEST['opcion'];
    $respuestaNueva = '';

    if ($respuesta == 1) {
        $respuestaNueva = $opNew1;
    } else {
        if ($respuesta == 2) {
            $respuestaNueva = $opNew2;
        } else {
            if ($respuesta == 3) {
                $respuestaNueva = $opNew3;
            } else {
                if ($respuesta == 4) {
                    $respuestaNueva = $opNew4;
                }
            }
        }
    }

    Conexion::editarPregunta($_SESSION['preAnt']->getDescripcion(), $preNew);
    Conexion::editarRespuesta($_SESSION['respuestaAnt'], $respuestaNueva);
    Conexion::editarOpcion($opNew1, $_SESSION['opcionesAnt'][0]);
    Conexion::editarOpcion($opNew2, $_SESSION['opcionesAnt'][1]);
    Conexion::editarOpcion($opNew3, $_SESSION['opcionesAnt'][2]);
    Conexion::editarOpcion($opNew4, $_SESSION['opcionesAnt'][3]);
    header("Location:../Administracion/Preguntas.php");
}
/*************************************************************************** */
/****************************ADMINISTRACION********************************* */
/*************************************************************************** */
/**
 * Eliminar una Persona 
 */
if (isset($_REQUEST['X'])) {
    $correo = $_REQUEST['email'];
    Conexion::delPersona($correo);
    header("Location:../Administracion/Administracion.php");
}

/**
 * Ir a Gestion.php para Editar una persona
 */
if (isset($_REQUEST['E'])) {
    $_SESSION['email'] = $_REQUEST['email'];
    $_SESSION['Eleccion'] = 'Editar';
    header("Location:../Administracion/Gestion.php");
}

/**
 * La eleccion del crud ha sido Añadir, lo almacenamos en una sesion y 
 * vamos a Gestion.php. Para asi, una vez alli, habilitar segun que cosas
 * segun si le hemos dado a Añadir o a Editar
 */
if (isset($_REQUEST['Aniadir'])) {
    $_SESSION['Eleccion'] = 'Aniadir';
    header("Location:../Administracion/Gestion.php");
}

/**
 * Esta funcion sirve para activar a una persona
 */
if (isset($_REQUEST['Activar'])) {
    $_SESSION['email'] = $_REQUEST['email'];
    Conexion::GestionActivacionPersona(1, $_SESSION['email']);
    header("Location:../Administracion/Administracion.php");
}
/**
 * Esta funcion sirve para desactivar a una persona
 */
if (isset($_REQUEST['Desactivar'])) {
    $_SESSION['email'] = $_REQUEST['email'];
    Conexion::GestionActivacionPersona(0, $_SESSION['email']);
    header("Location:../Administracion/Administracion.php");
}


/*************************************************************************** */
/***********************************VOLVER********************************** */
/*************************************************************************** */
/**
 * Este boton es para el menu de usuario, decide si has vuelto desde ElegirRol o desde 
 *Index,asi, si has iniciado sesion como admin, al hacer clic en volver en el menu
 *de usuario, te devolvera a elegirRol
 */
if (isset($_REQUEST['VolverAlternativo'])) {

    if ($_SESSION['url'] == 'index.php') {
        $per = $_SESSION['per'];
        $per->Desconectar();
        Conexion::DesconectarPersona($per->getEmail());
        header("Location:../index.php");
    } else {
        if ($_SESSION['url'] == 'ElegirRol.php') {
            header("Location:../MENUS/ElegirRol.php");
        }
    }
}


if (isset($_REQUEST['VolverAPreguntas'])) {
    header("Location:../Administracion/Preguntas.php");
}
/**
 * Me permite volver desde enviar.php a password.php
 */
if (isset($_REQUEST['VolverPassword'])) {
    header("Location:../Correo/password.php");
}
/**
 * Volver a ElegirRol.php
 */

if (isset($_REQUEST['VolverRol'])) {
    header("Location:../MENUS/ElegirRol.php");
}

/**
 * Volver al menu.php del usuario
 */
if (isset($_REQUEST['VolverMenu'])) {
    header("Location:../MENUS/menu.php");
}

/**
 * Volver a Administracion.php desde Gestion.php
 */
if (isset($_REQUEST['VolverAdministracion'])) {
    header("Location:../Administracion/Administracion.php");
}

/**
 * Volver al Login
 */
if (isset($_REQUEST['CerrarSesion'])) {

    $per = $_SESSION['per'];
    $per->Desconectar();
    Conexion::DesconectarPersona($per->getEmail());

    header("Location:../index.php");
}

/**
 * Volver al Login
 */
if (isset($_REQUEST['VolverLogin'])) {
    header("Location:../index.php");
}

/**
 * Volver a Juego.php. La pantalla principal donde me puedo unir o crear una partida
 */
if (isset($_REQUEST['VolverJuego'])) {
    header("Location:../Gestion_Juego/Jugar.php");
}

if (isset($_REQUEST['VolverJugar'])) {
    $fechaFin = date('h:i:s');
    $fechaIni = $_SESSION['fechaIni'];
    $idEquipo = Conexion::verIDEquipo($_SESSION['creador']);
    $personas = Conexion::PersonasEquipo($idEquipo);
    $PersonasEquipo = '';

    for ($i = 0; $i < count($personas); $i++) {
        $PersonasEquipo .=$personas[$i].',';
    }
    Conexion::CrearHistorial($_SESSION['codEquipo'], $PersonasEquipo, $fechaFin, $fechaIni, $_SESSION['resultado'], $_SESSION['Almirante']);
    Conexion::DropEquipo($_SESSION['codEquipo']);
    header("Location:../Gestion_Juego/Jugar.php");
}


/**
 * Volver al menu del editor
 */
if (isset($_REQUEST['VolverMenuEditor'])) {
    header("Location:../MENUS/MenuEditor.php");
}
/*************************************************************************** */
/*******************************REDIRECCIONAMIENTO************************* */
/*************************************************************************** */

if (isset($_REQUEST['CrearPartida'])) {
    header("Location:../Gestion_Juego/CrearPartida.php");
}
/**
 * Te lleva a administracion
 */
if (isset($_REQUEST['Administrador'])) {
    header("Location:../Administracion/Administracion.php");
}

if (isset($_REQUEST['Jugar'])) {
    header("Location:../Gestion_Juego/Jugar.php");
}

/**
 * Te lleva al menu de usuario
 */
if (isset($_REQUEST['Usuario'])) {
    header("Location:../MENUS/menu.php");
}
/**
 * Te lleva al menu del Editor
 */
if (isset($_REQUEST['Editor'])) {
    header("Location:../MENUS/MenuEditor.php");
}

/**
 * Te lleva a la lista de usuarios
 */
if (isset($_REQUEST['Usuarios'])) {
    header("Location:../Ventanas/Lista.php");
}


/**
 * Ir a Ranking.php
 */
if (isset($_REQUEST['Ranking'])) {
    header("Location:../Ventanas/Ranking.php");
}

/**
 * Ir a la pagina de estadisticas
 */
if (isset($_REQUEST['Estadisticas'])) {
    header("Location:../Error_y_Reformas/reformas.php");
}

/**
 * Ir al crud de preguntas y respuestas
 */
if (isset($_REQUEST['GestionPreguntas'])) {
    header("Location:../Administracion/Preguntas.php");
}


if (isset($_REQUEST['Historial'])) {
    header("Location:../Ventanas/Historial.php");
}

/*************************************************************************** */
/****************************GESTION SALA****************************** */
/*************************************************************************** */


if (isset($_REQUEST['EmpezarYA'])) {
    $_SESSION['creador'] = Conexion::verCreadorDeSala($_SESSION['codSala']);
    Conexion::ActivarEstadoPartida($_SESSION['creador']);
    header("Location:../Juego/Carga.php");
}


/**
 * Recojo la informacion de la sala, compruebo si esta existe. 
 * Si existe, me sale un mensaje de error. Si no existe, la crea y me manda a la 
 * sala de espera.
 */
if (isset($_REQUEST['CrearP'])) {
    $codigo = $_REQUEST['Codigo'];
    $nombreSala = $_REQUEST['NomSala'];
    $tipoSala = $_REQUEST['opcion'];

    $sala = Conexion::BuscarSala($codigo);

    if ($sala == null) {
        $_SESSION['codSala'] = $codigo;
        Conexion::CrearSala($codigo, $nombreSala, $tipoSala, 1, $_SESSION['per']->getEmail());
        Conexion::CrearEquipo($_SESSION['per']->getEmail());
        $codEquipo = Conexion::verCodigo($_SESSION['per']->getEmail());
        Conexion::AddParticipante($_SESSION['per']->getEmail(), $codEquipo);
        $_SESSION['codEquipo'] = $codEquipo;
        Conexion::CrearPartida($_SESSION['per']->getEmail());
        header("Location:../Gestion_Juego/SalaEspera.php");
    } else {
        $_SESSION['mensaje'] = 'Este codigo de sala ya existe';
        header("Location:../Gestion_Juego/CrearPartida.php");
    }
}

/**
 * Si pongo un codigo de una sala privada y le doy a unirme , se recoge el codigo,
 * se comprueba si este existe, si existe miramos el numero de jugadores de esta sala,
 * le sumamos uno (Por que estamos entrando), modificamos el numero de jugadores y me 
 * lleva a la sala. Si la sala no existe, me lleva a una pagina de error Tambien se añade a 
 * la persona al equipo correspondiente.
 */
if (isset($_REQUEST['UnirmePartida'])) {
    $codigo = $_REQUEST['codigo'];
    $sala = Conexion::BuscarSala($codigo);

    if ($sala != null) {
        $_SESSION['codSala'] = $codigo;
        $numJugadores = Conexion::verNumeroJugadoresDeSala($_SESSION['codSala']);
        $numJugadores = $numJugadores + 1;
        Conexion::modificarNumeroJugadores($_SESSION['codSala'], $numJugadores);
        $_SESSION['creador'] = Conexion::verCreadorDeSala($_SESSION['codSala']);
        $codEquipo = Conexion::verCodigo($_SESSION['creador']);
        Conexion::AddParticipante($_SESSION['per']->getEmail(), $codEquipo);
        header("Location:../Gestion_Juego/SalaEspera.php");
    } else {
        $_SESSION['mensaje'] = 'Esta sala no existe';
        header("Location:../Error_y_Reformas/error.php");
    }
}
if (isset($_REQUEST['Unirse'])) {
    $cod = $_REQUEST['codigoSecreto'];
    $_SESSION['codSala'] = $cod;
    $numJugadores = Conexion::verNumeroJugadoresDeSala($cod);
    $numJugadores = $numJugadores + 1;
    Conexion::modificarNumeroJugadores($cod, $numJugadores);
    $_SESSION['creador'] = Conexion::verCreadorDeSala($_SESSION['codSala']);
    $codEquipo = Conexion::verCodigo($_SESSION['creador']);
    Conexion::AddParticipante($_SESSION['per']->getEmail(), $codEquipo);
    header("Location:../Gestion_Juego/SalaEspera.php");
}

/**
 * Cuando vuelvo de la sala de espera miro el numero de jugadores que hay, le resto 1
 * (Por que me voy),modifico el numero de jugadores de la sala de espera.
 * Si no hay jugadores en esa sala, esta se borra y me lleva a Jugar.php, sino
 * solo me lleva a Jugar.php
 */
if (isset($_REQUEST['VolverDesdeSalaEspera'])) {
    $numJugadores = Conexion::verNumeroJugadoresDeSala($_SESSION['codSala']);
    $numJugadores = $numJugadores - 1;
    Conexion::modificarNumeroJugadores($_SESSION['codSala'], $numJugadores);
    Conexion::quitarPersonaDelEquipo($_SESSION['per']->getEmail());

    if ($numJugadores == 0) {
        header("Location:../Gestion_Juego/Jugar.php");
        Conexion::DropSala($_SESSION['codSala']);
        Conexion::DropEquipo($_SESSION['codEquipo']);
        // $creador = Conexion::verCreadorDeSala($_SESSION['codSala']);
        // Conexion::DropPartida($creador);
        header("Location:../Gestion_Juego/Jugar.php");
    } else {
        header("Location:../Gestion_Juego/Jugar.php");
    }
}
