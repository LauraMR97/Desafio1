<?php
require_once './Persona.php';
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

    if ($usu != null) {
        $_SESSION['per'] = $usu;
        $roles = Conexion::verRol($email);
        for ($i = 0; $i < count($roles); $i++) {
            if ($roles[$i] == 0) {
                header("Location:./MENUS/ElegirRol.php");
            } else {
                if ($roles[$i] == 1) {
                    header("Location:./MENUS/MenuEditor.php");
                } else {
                    if ($roles[$i] == 2) {
                        header("Location:./MENUS/menu.php");
                    }
                }
            }
        }
    }
}
/**
 * Me permite acceder a Registro.php
 */
if (isset($_REQUEST['Registrarse'])) {
    header("Location:./registro.php");
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

    if ($passwrd == $passwrdConfirm) {
        //if($foto!=null){
        $persona = new Persona($nombre, $email);
        //$persona->setFoto($url);
        //}
        //else{
        //$persona= new Persona($nombre,$email,$passwrd);
        Conexion::addPersona($persona, 2, $passwrd);
        header("Location:./MENUS/menu.php");
    } else {
        $_SESSION['mensaje'] = 'Las constraseñas son distintas';
        header("Location:./error.php");
    }
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

    header("Location:./enviar.php");
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

    if ($passwrd == $passwrdConfirm) {
        $persona = new Persona($nombre, $email);
        Conexion::addPersona($persona, $rol, $passwrd);
        header("Location:./Administracion.php");
    } else {
        $_SESSION['mensaje'] = 'Las constraseñas son distintas';
        header("Location:./error.php");
    }
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

    $perNew = new Persona($nombre, $email);
    Conexion::editarPersonaAdministracion($perNew, $perAnt);
    Conexion::editarRol($perNew, $rol);
    header("Location:./Administracion.php");
}
/*************************************************************************** */
/****************************GESTION PREGUNTAS****************************** */
/*************************************************************************** */
if (isset($_REQUEST['XPreg'])) {
    $Resp = $_REQUEST['resp'];
    $Preg = $_REQUEST['desc'];
    Conexion::delPreg($Preg);
    Conexion::delResp($Resp);
    header("Location:./Preguntas.php");
}

if (isset($_REQUEST['AniadirPreg'])) {
    $_SESSION['Eleccion'] = 'AniadirPreg';
    header("Location:./GestionPreguntas.php");
}

if (isset($_REQUEST['EPreg'])) {
    $_SESSION['pregunta'] = $_REQUEST['desc'];
    $_SESSION['Eleccion'] = 'EditarPreg';
    header("Location:./GestionPreguntas.php");
}


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
    header("Location:./Preguntas.php");
}

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
    header("Location:./Preguntas.php");
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
    header("Location:./Administracion.php");
}

/**
 * Ir a Gestion.php para Editar una persona
 */
if (isset($_REQUEST['E'])) {
    $_SESSION['email'] = $_REQUEST['email'];
    $_SESSION['Eleccion'] = 'Editar';
    header("Location:./Gestion.php");
}

if (isset($_REQUEST['Aniadir'])) {
    $_SESSION['Eleccion'] = 'Aniadir';
    header("Location:./Gestion.php");
}

/**
 * Esta funcion sirve para activar a una persona
 */
if (isset($_REQUEST['Activar'])) {
    $_SESSION['email'] = $_REQUEST['email'];
    Conexion::GestionActivacionPersona(1, $_SESSION['email']);
    header("Location:./Administracion.php");
}
/**
 * Esta funcion sirve para desactivar a una persona
 */
if (isset($_REQUEST['Desactivar'])) {
    $_SESSION['email'] = $_REQUEST['email'];
    Conexion::GestionActivacionPersona(0, $_SESSION['email']);
    header("Location:./Administracion.php");
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
        header("Location:./index.php");
    } else {
        if ($_SESSION['url'] == 'ElegirRol.php') {
            header("Location:./MENUS/ElegirRol.php");
        }
    }
}


if (isset($_REQUEST['VolverAPreguntas'])) {
    header("Location:./Preguntas.php");
}
/**
 * Me permite volver desde enviar.php a password.php
 */
if (isset($_REQUEST['VolverPassword'])) {
    header("Location:./password.php");
}
/**
 * Volver a ElegirRol.php
 */

if (isset($_REQUEST['VolverRol'])) {
    header("Location:./MENUS/ElegirRol.php");
}

/**
 * Volver al menu.php del usuario
 */
if (isset($_REQUEST['VolverMenu'])) {
    header("Location:./MENUS/menu.php");
}

/**
 * Volver a Administracion.php desde Gestion.php
 */
if (isset($_REQUEST['VolverAdministracion'])) {
    header("Location:./Administracion.php");
}

/**
 * Volver al Login
 */
if (isset($_REQUEST['CerrarSesion'])) {
    header("Location:./index.php");
}

/**
 * Volver al menu del editor
 */
if (isset($_REQUEST['VolverMenuEditor'])) {
    header("Location:./MENUS/MenuEditor.php");
}
/*************************************************************************** */
/*******************************REDIRECCIONAMIENTO************************* */
/*************************************************************************** */
/**

/**
 * Te lleva a administracion
 */
if (isset($_REQUEST['Administrador'])) {
    header("Location:./Administracion.php");
}

/**
 * Te lleva al menu de usuario
 */
if (isset($_REQUEST['Usuario'])) {
    header("Location:./MENUS/menu.php");
}
/**
 * Te lleva al menu del Editor
 */
if (isset($_REQUEST['Editor'])) {
    header("Location:./MENUS/MenuEditor.php");
}

/**
 * Ir a Ranking.php
 */
if (isset($_REQUEST['Ranking'])) {
    header("Location:./Ranking.php");
}

/**
 * Ir a la pagina de estadisticas
 */
if (isset($_REQUEST['Estadisticas'])) {
    header("Location:./reformas.php");
}

/**
 * Ir al crud de preguntas y respuestas
 */
if (isset($_REQUEST['GestionPreguntas'])) {
    header("Location:./Preguntas.php");
}

if (isset($_REQUEST['Historial'])) {
    header("Location:./reformas.php");
}

if (isset($_REQUEST['Jugar'])) {
    header("Location:./reformas.php");
}
