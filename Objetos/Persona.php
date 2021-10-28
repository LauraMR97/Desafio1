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
   private $activo;
   private $conectado;

   public function __construct($nombre, $correo)
   {
      $this->nombre = $nombre;
      $this->correo = $correo;
      $this->password = '';
      $this->foto = './PERFILES/usuario.jpg';
      $this->prestigio = 'madera';
      $this->aciertos = 0;
      $this->victorias = 0;
      $this->activo = false;
      $this->conectado = false;
   }

   public function setFoto($foto)
   {
      $this->foto = $foto;
   }

   public function Conectar()
   {
      $this->conectado = true;
   }

   public function Desconectar()
   {
      $this->conectado = false;
   }

   public function setConectar($conectado)
   {
      $this->conectado = $conectado;
   }

   public function setActivo($act)
   {
      $this->activo = $act;
   }

   public function setPassword($password)
   {
      $this->password = $password;
   }

   public function setPrestigio($prestigio)
   {
      $this->prestigio = $prestigio;
   }

   public function setAciertos($aciertos)
   {
      $this->aciertos = $aciertos;
   }

   public function setVictoria($victoria)
   {
      $this->victoria = $victoria;
   }

   public function getNombre()
   {
      return $this->nombre;
   }

   public function getPassword()
   {
      return $this->password;
   }

   public function getEmail()
   {
      return $this->correo;
   }
   public function getActivo()
   {
      return $this->activo;
   }

   public function getConectado()
   {
      return $this->conectado;
   }
   public function getPrestigio()
   {
      return $this->prestigio;
   }
   public function getAciertos()
   {
      return $this->aciertos;
   }
   public function getVictorias()
   {
      return $this->victorias;
   }

   public function getFoto()
   {
      return $this->foto;
   }

   public function __toString()
   {
      $string = '';

      $string = '[Nombre: ' . $this->nombre . ', Contraseña: ' . $this->password . ', Correo: ' . $this->correo . ' ,Prestigio: ' . $this->prestigio . ' ,Aciertos: ' . $this->aciertos . ' ,Victorias: ' . $this->victorias . ' ,Conectado: ' . $this->conectado . ']';
      return $string;
   }
}
