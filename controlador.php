<?php
require_once './Persona.php';
require_once './Conexion.php';
session_start();

if (isset($_REQUEST['Aceptar'])) {
    $email = $_REQUEST['Email'];
    $password = sha1($_REQUEST['Password']);
    $roles = array();

    $usu = Conexion::buscarPersona($email, $password);

    if ($usu != null) {
        $roles = Conexion::verRol($email);
        for ($i = 0; $i < count($roles); $i++) {
            if ($roles[$i] == 0) {
                header("Location:./reformas.php");
            } else {
                if ($roles[$i] == 1) {
                    header("Location:./fdg.php");
                } else {
                    if ($roles[$i] == 2) {
                        header("Location:./menu.php");
                    }
                }
            }
        }
    }
}
if (isset($_REQUEST['Registrarse'])) {
    header("Location:./registro.php");
}

if (isset($_REQUEST['Registrar'])) {
    $nombre = $_REQUEST['Nombre'];
    $email = $_REQUEST['Email'];
    $passwrd = sha1($_REQUEST['Password']);
    $passwrdConfirm = sha1($_REQUEST['PasswordRepeat']);
    $url = './PERFILES/' . $nombre . '.jpg';
    //$foto=$_FILES['Foto'][$url];

    if ($passwrd == $passwrdConfirm) {
        //if($foto!=null){
        $persona = new Persona($nombre, $email, $passwrd);
        //$persona->setFoto($url);
        //}
        //else{
        //$persona= new Persona($nombre,$email,$passwrd);
        Conexion::addPersona($persona, 2);
        header("Location:./reformas.php");
    } else {
        $_SESSION['mensaje'] = 'Las constraseñas son distintas';
        header("Location:./error.php");
    }
}



if (isset($_REQUEST['VolverIndex'])) {
    header("Location:./index.php");
}

if (isset($_REQUEST['VolverPassword'])) {
    header("Location:./password.php");
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
    $perNew = new Persona($perAnt->getNombre(), $perAnt->getEmail(), sha1($_SESSION['newPassword']));
    Conexion::editarPersona($perNew, $perAnt);

    header("Location:./enviar.php");
}

if (isset($_REQUEST['CerrarSesion'])) {
    header("Location:./index.php");
}
