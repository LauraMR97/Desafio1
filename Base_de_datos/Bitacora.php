<?php
include_once "Parametros.php";

class Bitacora
{
        public static function guardarArchivo($mensaje){
            $file = fopen(Parametros::$nombre_archivo, "a");
            fwrite($file, $mensaje . PHP_EOL);
            fclose($file);
        }
}