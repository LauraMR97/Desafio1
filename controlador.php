<?php
require_once './Persona.php';
require_once './Conexion.php';
session_start();

/**
 * Me permite acceder a mi cuenta de usuario segun sea Admin, User o Editor
 */
if (isset($_REQUEST['Aceptar'])) {
    $email = $_REQUEST['Email'];
    $password = sha1($_REQUEST['Password']);
    $roles = array();

    $usu = Conexion::buscarPersona($email, $password);

    if ($usu != null) {
        $_SESSION['per'] = $usu;
        $roles = Conexion::verRol($email);
        for ($i = 0; $i < count($roles); $i++) {
            if ($roles[$i] == 0) {
                header("Location:./ElegirRol.php");
            } else {
                if ($roles[$i] == 1) {
                    header("Location:./MenuEditor.php");
                } else {
                    if ($roles[$i] == 2) {
                        header("Location:./menu.php");
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
        header("Location:./menu.php");
    } else {
        $_SESSION['mensaje'] = 'Las constraseñas son distintas';
        header("Location:./error.php");
    }
}

if (isset($_REQUEST['Enviar'])) {
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
            header("Location:./ElegirRol.php");
        }
    }
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
    header("Location:./ElegirRol.php");
}

/**
 * Volver al menu.php del usuario
 */
if (isset($_REQUEST['VolverMenu'])) {
    header("Location:./menu.php");
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
    header("Location:./menu.php");
}
/**
 * Te lleva al menu del Editor
 */
if (isset($_REQUEST['Editor'])) {
    header("Location:./MenuEditor.php");
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
