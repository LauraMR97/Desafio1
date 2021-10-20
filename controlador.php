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
