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
    public static function addPersona($p, $rol, $password)
    {
        self::abrirConexion();
        $query = "INSERT INTO persona (nombre, correo, password, foto, prestigio, aciertos, victorias,activo) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("sssssiii", $p->getNombre(), $p->getEmail(), $password, $p->getFoto(), $p->getPrestigio(), $p->getAciertos(), $p->getActivo(), $p->getVictorias());


        if ($stmt->execute()) {
            $mensaje = 'Registro insertado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            // Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = "Error al insertar: " . mysqli_error(self::$conexion) . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            //Bitacora::guardarArchivo($mensaje);
        }
        $stmt->close();
        self::cerrarConexion();

        self::actualizarRolPersona($p, $rol);
    }

    /*--------------------------------------------------------------*/

    public static function actualizarRolPersona($p, $rol)
    {

        self::abrirConexion();
        $query = "INSERT INTO rol_persona (id_rol, correo) VALUES (?,?)";
        $stmt = self::$conexion->prepare($query);
        $stmt->bind_param("is", $rol, $p->getEmail());


        if (!$stmt->execute()) {
            $mensaje = "Error al insertar: " . mysqli_error(self::$conexion) . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            // Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = 'Registro insertado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            // Bitacora::guardarArchivo($mensaje);
        }


        $stmt->close();
        self::cerrarConexion();
    }
    /*----------------------------------------------------------------------*/
    public static function delPersona($correo)
    {
        self::abrirConexion();
        $query = "DELETE FROM persona WHERE correo = ? ";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $correo);

        if ($stmt->execute()) {
            $mensaje = 'Registro eliminado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            // Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = 'Error al eliminar' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            // Bitacora::guardarArchivo($mensaje);
        }
        $stmt->close();
        self::cerrarConexion();
        self::borrarRolPersona($correo);
    }
    /*--------------------------------------------------------------*/
    public static function borrarRolPersona($correo)
    {

        self::abrirConexion();
        $query = "DELETE FROM rol_persona WHERE correo = ? ";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $correo);

        if ($stmt->execute()) {
            $mensaje = 'Registro eliminado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            // Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = 'Error al eliminar' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            // Bitacora::guardarArchivo($mensaje);
        }
        $stmt->close();
        self::cerrarConexion();
    }
    /*-------------------------------------------------------------------------*/
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
                $per = new Persona($fila["nombre"], $fila["correo"]);
                $per->setPassword($fila["password"]);
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
    public static function editarRol($p, $rol)
    {
        self::abrirConexion();
        $query = "UPDATE rol_persona SET id_rol = ? WHERE correo LIKE ?";
        $stmt = self::$conexion->prepare($query);
        $stmt->bind_param("is", $rol, $p->getEmail());

        if ($stmt->execute()) {
            $mensaje = 'Registro editado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            //Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = 'Error al editar' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            //Bitacora::guardarArchivo($mensaje);
        }
        $stmt->close();
        self::cerrarConexion();
    }
    /*---------------------------------------------------------------------------------*/
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
                $per = new Persona($fila["nombre"], $fila["correo"]);
                $per->setPassword($fila["password"]);
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

        if ($stmt->execute()) {
            $mensaje = 'Registro editado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            //Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = 'Error al editar' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            //Bitacora::guardarArchivo($mensaje);
        }
        $stmt->close();
        self::cerrarConexion();
    }
    /*--------------------------------------------------------------*/
    public static function editarPersonaAdministracion($perNu, $perAnt)
    {
        self::abrirConexion();
        $query = "UPDATE persona SET nombre = ? ,correo = ? WHERE correo LIKE ? ";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("sss", $perNu->getNombre(), $perNu->getEmail(), $perAnt->getEmail());

        if ($stmt->execute()) {
            $mensaje = 'Registro editado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            //Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = 'Error al editar' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            //Bitacora::guardarArchivo($mensaje);
        }
        $stmt->close();
        self::cerrarConexion();
    }

    /*--------------------------------------------------------------*/

    public static function ArrayDePersonas()
    {
        $array = array();

        self::abrirConexion();

        $query = "SELECT * FROM persona";

        $resultado = self::$conexion->query($query);

        if ($resultado) {
            while ($fila = mysqli_fetch_array($resultado)) {
                $per = new Persona($fila["nombre"], $fila["correo"]);
                $per->setPassword($fila['password']);
                $per->setFoto($fila['foto']);
                $per->setPrestigio($fila['prestigio']);
                $per->setAciertos($fila['aciertos']);
                $per->setVictoria($fila['victorias']);
                $per->setActivo($fila['activo']);
                $array[] = $per;
            }
        }
        mysqli_free_result($resultado);

        self::cerrarConexion();

        return $array;
    }

    /*--------------------------------------------------------------*/

    public static function ArrayDePreguntas()
    {
        $array = array();

        self::abrirConexion();

        $query = "SELECT * FROM pregunta";

        $resultado = self::$conexion->query($query);

        if ($resultado) {
            while ($fila = mysqli_fetch_array($resultado)) {
                $array[] = $fila['descripcion'];
            }
        }
        mysqli_free_result($resultado);

        self::cerrarConexion();

        return $array;
    }
    /*--------------------------------------------------------------*/

    public static function PersonasOrdenadasPorAciertos()
    {
        $array = array();

        self::abrirConexion();

        $query = "SELECT * FROM persona ORDER BY aciertos DESC";

        $resultado = self::$conexion->query($query);

        if ($resultado) {
            while ($fila = mysqli_fetch_array($resultado)) {
                $per = new Persona($fila["nombre"], $fila["correo"]);
                $per->setPassword($fila['password']);
                $per->setFoto($fila['foto']);
                $per->setPrestigio($fila['prestigio']);
                $per->setAciertos($fila['aciertos']);
                $per->setVictoria($fila['victorias']);
                $per->setActivo($fila['activo']);
                $array[] = $per;
            }
        }
        mysqli_free_result($resultado);

        self::cerrarConexion();

        return $array;
    }

    /*--------------------------------------------------------------*/
    public static function GestionActivacionPersona($valor,$correo)
    {
        self::abrirConexion();
        $query = "UPDATE persona SET activo = ? WHERE correo LIKE ? ";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("is",$valor,$correo);

        if ($stmt->execute()) {
            $mensaje = 'Registro editado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            //Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = 'Error al editar' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            //Bitacora::guardarArchivo($mensaje);
        }
        $stmt->close();
        self::cerrarConexion();

    }
    /*--------------------------------------------------------------*/
    public static function cerrarConexion()
    {
        self::$conexion->close();
    }
}
