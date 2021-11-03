<?php
class Sala
{
    private $codigo;
    private $nombre;
    private $tipo;
    private $numPersonas;
    private $creador;
    public function __construct($codigo, $nombre, $tipo, $numPersonas,$creador)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->numPersonas = $numPersonas;
        $this->creador=$creador;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }
    public function getCreador()
    {
        return $this->creador;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getTipo()
    {
        return $this->descripcion;
    }
    public function getNumPersonas()
    {
        return $this->numPersonas;
    }

    public function __toString()
    {
        $string = '';
        $string = '[Codigo: ' . $this->codigo . ', Nombre: ' . $this->nombre . ', Tipo: ' . $this->tipo . ', Numero Personas: ' . $this->numPersonas . ']';
        return $string;
    }
}
