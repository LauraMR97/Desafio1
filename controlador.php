<?php
require_once './Persona.php';
require_once './Conexion.php';
session_start();

if ($_REQUEST['Aceptar']) {
    $email = $_REQUEST['Email'];
    $password = $_REQUEST['Password'];

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

if($_REQUEST['Registrar']){
    header("Location:./registro.php");
}
