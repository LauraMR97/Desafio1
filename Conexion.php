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
    public static function addPersona($p, $rol)
    {
        self::abrirConexion();
        $query = "INSERT INTO persona (nombre, correo, password, foto, prestigio, aciertos, victorias) VALUES (?,?,?,?,?,?,?)";
        $query2 = "INSERT INTO rol_persona (id_rol, correo) VALUES (?,?)";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("sssssii", $p->getNombre(), $p->getEmail(), $p->getPassword(), $p->getFoto(), $p->getPrestigio(), $p->getAciertos(), $p->getVictorias());
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

        $stmt = self::$conexion->prepare($query2);
        $stmt->bind_param("is", $rol, $p->getEmail());
        $stmt->execute();


        if (mysqli_query(self::$conexion, $query2)) {
            $mensaje = 'Registro insertado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = "Error al insertar: " . mysqli_error(self::$conexion) . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            Bitacora::guardarArchivo($mensaje);
        }


        $stmt->close();
        self::cerrarConexion();
    }

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
                $per = new Persona($fila["nombre"], $fila["correo"], $fila["password"]);
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
        $i = 0;

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

    public static function buscarPersonaPorCorreo($correo)
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
                $per = new Persona($fila["nombre"], $fila["correo"], $fila["password"]);
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $per;
    }

    /*--------------------------------------------------------------*/
    public static function editarPersona($perNu, $perAnt)
    {
        self::abrirConexion();
        $query = "UPDATE persona SET nombre = ? ,correo = ? ,password= ? WHERE correo LIKE ? ";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("ssss", $perNu->getNombre(), $perNu->getEmail(), $perNu->getPassword(), $perAnt->getEmail());
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
