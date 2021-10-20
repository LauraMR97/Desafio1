<?php
class Persona
{
    private $nombre;
    private $correo;
    private $password;
    private $foto;
    private $prestigio;
    private $aciertos;
    private $victorias;

    public function __construct($nombre, $correo, $password)
    {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->password = $password;
        $this->foto = './PERFILES/usuario.jpg';
        $this->prestigio = 'madera';
        $this->aciertos = 0;
        $this->victorias = 0;
    }

    public function setFoto($foto){
        $this->foto=$foto;
    }

    public function getNombre(){
       return $this->nombre;
    }

    public function getPassword(){
        return $this->password;
     }

     public function getEmail(){
        return $this->correo;
     }


     public function getFoto(){
        return $this->foto;
     }

    public function __toString()
    {
        $string = '';

        $string = '[Nombre: ' . $this->nombre . ', Contraseña: ' . $this->password . ', Correo: ' . $this->correo . ' ,Prestigio: ' . $this->prestigio . ' ,Aciertos: ' . $this->aciertos . ' ,Victorias: ' . $this->victorias . ']';
        return $string;
    }
}
