<?php
class Pregunta
{
    private $respuesta;
    private $creador;
    private $descripcion;
    public function __construct($respuesta, $descripcion, $creador)
    {
        $this->creador = $creador;
        $this->descripcion = $descripcion;
        $this->respuesta = $respuesta;
    }

    public function getRespuesta()
    {
        return $this->respuesta;
    }
    public function getCreador()
    {
        return $this->creador;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }


    public function __toString()
    {
        $string = '';
        $string = '[Descripcion: ' . $this->descripcion . ', Respuesta: ' . $this->respuesta . ', Creador: ' . $this->creador . ']';
        return $string;
    }
}
