<?php
require_once './Persona.php';
require_once './Conexion.php';
session_start();

if ($_REQUEST['Aceptar']) {
    $email = $_REQUEST['Email'];
    $password = sha1($_REQUEST['Password']);

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
                        header("Location:./fdg.php");
                    }
                }
            }
        }
    }
}

if($_REQUEST['Registrarse']){
    header("Location:./registro.php");
}

if($_REQUEST['Registrar']){
    $nombre=$_REQUEST['Nombre'];
    $email=$_REQUEST['Email'];
    $passwrd=sha1($_REQUEST['Password']);
    $passwrdConfirm=sha1($_REQUEST['PasswordRepeat']);
    $url='./PERFILES/'.$nombre.'.jpg';
    $foto=$_FILES['Foto'][$url];

    if($passwrd==$passwrdConfirm){
    if($foto!=null){
        $persona= new Persona($nombre,$email,$passwrd);
        //$persona->setFoto($url);
    }
else{
    $persona= new Persona($nombre,$email,$passwrd);
}
    
  Conexion::addPersona($persona); 
  header("Location:./reformas.php");
}
else{
    $_SESSION['mensaje']='Las constraseñas son distintas';
    header("Location:./error.php");
}  
}


if($_REQUEST['VolverIndex']){
    header("Location:./index.php");
}

if($_REQUEST['VolverPassword']){
    header("Location:./password.php");
}

if($_REQUEST['Enviar']){
    $email=$_REQUEST['correoDest'];
    $perAnt=Conexion::buscarPersonaPorCorreo($email);
    if ($perAnt != null) {
        $alea = rand(0, 3);
        $_SESSION['newPassword'] = '';

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
    $perNew = new Persona($perAnt->getNombre(),$perAnt->getEmail(),sha1($_SESSION['newPassword']));
    Conexion::editarPersona($perNew, $perAnt);

    header("Location:./enviar.php");
}

if($_REQUEST['CerrarSesion']){
    header("Location:./index.php");
}
