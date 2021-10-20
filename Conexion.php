<?php
include_once "Parametros.php";
include_once "bitacora.php";

class Conexion
{

    public static $conexion;

    /*--------------------------------------------------------------*/
    public static function abrirConexion()
    {
        self::$conexion = new mysqli(Parametros::$url, Parametros::$usuario, Parametros::$password, Parametros::$bbdd);
    }

    /*--------------------------------------------------------------*/
   /* public static function addPersona($p)
    {
        self::abrirConexion();
        $query = "INSERT INTO persona (nombre, contraseña, correo,id) VALUES (?,?,?,?)";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("sssi", $p->getNomUsuario(), $p->getContrasenia(), $p->getEmail(), $p->getNumIdent());
        $stmt->execute();

        $result = $stmt->get_result();

        if (mysqli_query(self::$conexion, $query)) {
            $mensaje = 'Registro insertado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = "Error al insertar: " . mysqli_error(self::$conexion) . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            Bitacora::guardarArchivo($mensaje);
        }
        $stmt->close();
        self::cerrarConexion();
    }*/

    /*--------------------------------------------------------------*/
   /* public static function delPersona($correo)
    {
        self::abrirConexion();
        $query = "DELETE FROM persona WHERE correo = ? ";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $correo);
        $stmt->execute();

        $result = $stmt->get_result();

        if (mysqli_query(self::$conexion, $query)) {
            $mensaje = 'Registro eliminado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = 'Error al eliminar' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            Bitacora::guardarArchivo($mensaje);
        }
        $stmt->close();
        self::cerrarConexion();
    }*/
    /*--------------------------------------------------------------*/

    public static function buscarPersona($correo, $cont)
    {
        $per = null;

        self::abrirConexion();

        $query = "SELECT * FROM persona WHERE correo like ? AND password like ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("ss", $correo, $cont);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $per = new persona($fila["nombre"], $fila["contraseña"], $fila["correo"], $fila["id"]);
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $per;
    }

      /*--------------------------------------------------------------*/

      public static function verRol($correo)
      {
          $rol = array();
          $i=0;
  
          self::abrirConexion();
  
          $query = "SELECT id_rol FROM rol_persona WHERE correo like ?";
          $stmt = self::$conexion->prepare($query);
  
          $stmt->bind_param("s", $correo);
          $stmt->execute();
  
          $result = $stmt->get_result();
  
  
          if ($result) {
              while ($fila = mysqli_fetch_array($result)) {
                $rol[$i] = $fila["id_rol"];
                $i++;
              }
          }
  
          $stmt->close();
          self::cerrarConexion();
  
          return $rol;
      }
      /*--------------------------------------------------------------*/

     /* public static function buscarPersonaPorCorreo($correo)
      {
          $per = null;
  
          self::abrirConexion();
  
          $query = "SELECT * FROM persona WHERE correo like ?";
          $stmt = self::$conexion->prepare($query);
  
          $stmt->bind_param("s", $correo);
          $stmt->execute();
  
          $result = $stmt->get_result();
  
  
          if ($result) {
              while ($fila = mysqli_fetch_array($result)) {
                  $per = new persona($fila["nombre"], $fila["contraseña"], $fila["correo"], $fila["id"]);
              }
          }
  
          $stmt->close();
          self::cerrarConexion();
  
          return $per;
      }

    /*--------------------------------------------------------------*/
   /* public static function editarPersona($perNu, $perAnt)
    {
        self::abrirConexion();
        $query = "UPDATE persona SET nombre = ? ,contraseña = ? ,correo= ? ,id= ? WHERE correo LIKE ? ";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("sssis", $perNu->getNomUsuario(), $perNu->getContrasenia(), $perNu->getEmail(), $perNu->getNumIdent(), $perAnt->getEmail());
        $stmt->execute();

        $result = $stmt->get_result();

        if (mysqli_query(self::$conexion, $query)) {
            $mensaje = 'Registro editado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = 'Error al editar' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            Bitacora::guardarArchivo($mensaje);
        }
        $stmt->close();
        self::cerrarConexion();
    }

    /*--------------------------------------------------------------*/

   /* public static function ArrayDePersonas()
    {
        $array = array();

        self::abrirConexion();

        $query = "SELECT * FROM persona";

        $resultado = mysqli_query(self::$conexion, $query);

        if ($resultado) {
            while ($fila = mysqli_fetch_array($resultado)) {
                $per = new persona($fila["nombre"], $fila["contraseña"], $fila["correo"], $fila["id"]);
                $array[] = $per;
            }
        }
        mysqli_free_result($resultado);

        self::cerrarConexion();

        return $array;
    }
    /*--------------------------------------------------------------*/
    public static function cerrarConexion()
    {
        self::$conexion->close();
    }
}
