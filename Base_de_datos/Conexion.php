<?php
include_once "Parametros.php";
include_once "bitacora.php";
include_once "../Objetos/Pregunta.php";
class Conexion
{

    public static $conexion;

    /*--------------------------------------------------------------*/
    public static function abrirConexion()
    {
        self::$conexion = new mysqli(Parametros::$url, Parametros::$usuario, Parametros::$password, Parametros::$bbdd);
    }

    /*--------------------------------------------------------------*/
    public static function addPersona($p, $password)
    {
        self::abrirConexion();
        $query = "INSERT INTO persona (nombre, correo, password, foto, prestigio, aciertos, victorias,activo,conectado) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("sssssiiii", $p->getNombre(), $p->getEmail(), $password, $p->getFoto(), $p->getPrestigio(), $p->getAciertos(), $p->getActivo(), $p->getVictorias(), $p->getConectado());


        if ($stmt->execute()) {
            $mensaje = 'Registro insertado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            // Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = "Error al insertar: " . mysqli_error(self::$conexion) . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            //Bitacora::guardarArchivo($mensaje);
        }
        $stmt->close();
        self::cerrarConexion();
    }
    /*--------------------------------------------------------------*/
    public static function addPregunta($desc, $creador)
    {
        self::abrirConexion();
        $query = "INSERT INTO pregunta (descripcion,correo) VALUES (?,?)";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("ss", $desc, $creador->getEmail());

        if ($stmt->execute()) {
            $mensaje = 'Registro insertado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            // Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = "Error al insertar: " . mysqli_error(self::$conexion) . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            //Bitacora::guardarArchivo($mensaje);
        }
        $stmt->close();
        self::cerrarConexion();
    }
    /*--------------------------------------------------------------*/
    public static function addRespuesta($resp)
    {
        self::abrirConexion();
        $query = "INSERT INTO respuesta (descripcionR) VALUES (?)";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $resp);


        if ($stmt->execute()) {
            $mensaje = 'Registro insertado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            // Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = "Error al insertar: " . mysqli_error(self::$conexion) . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            //Bitacora::guardarArchivo($mensaje);
        }
        $stmt->close();
        self::cerrarConexion();
    }
    /*--------------------------------------------------------------*/
    public static function addOpciones($opcion, $idPre)
    {
        self::abrirConexion();
        $query = "INSERT INTO opciones (descripcion,id_pregunta) VALUES (?,?)";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("si", $opcion, $idPre);


        if ($stmt->execute()) {
            $mensaje = 'Registro insertado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            // Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = "Error al insertar: " . mysqli_error(self::$conexion) . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            //Bitacora::guardarArchivo($mensaje);
        }
        $stmt->close();
        self::cerrarConexion();
    }
    /*--------------------------------------------------------------*/
    public static function actualizarPregResp($idResp, $idPreg)
    {
        self::abrirConexion();
        $query = "INSERT INTO preg_resp (id_pregunta,id_respuesta) VALUES (?,?)";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("ii", $idPreg, $idResp);


        if ($stmt->execute()) {
            $mensaje = 'Registro insertado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            // Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = "Error al insertar: " . mysqli_error(self::$conexion) . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            //Bitacora::guardarArchivo($mensaje);
        }
        $stmt->close();
        self::cerrarConexion();
    }



    public static function obtenerIDPregunta($pregunta)
    {
        $id = null;

        self::abrirConexion();

        $query = "SELECT Id_pregunta FROM pregunta WHERE descripcion LIKE '" . $pregunta . "'";

        $resultado = self::$conexion->query($query);

        if ($resultado) {
            while ($fila = mysqli_fetch_array($resultado)) {
                $id = $fila['Id_pregunta'];
            }
        }
        mysqli_free_result($resultado);

        self::cerrarConexion();

        return $id;
    }
    public static function obtenerIDRespuesta($respuesta)
    {
        $id = null;

        self::abrirConexion();

        $query = "SELECT id_respuesta FROM respuesta WHERE descripcionR LIKE '" . $respuesta . "'";

        $resultado = self::$conexion->query($query);

        if ($resultado) {
            while ($fila = mysqli_fetch_array($resultado)) {
                $id = $fila['id_respuesta'];
            }
        }
        mysqli_free_result($resultado);

        self::cerrarConexion();

        return $id;
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
    /*----------------------------------------------------------------------*/
    public static function delPreg($desc)
    {
        self::abrirConexion();
        $query = "DELETE FROM pregunta WHERE descripcion = ? ";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $desc);

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

    /*----------------------------------------------------------------------*/
    public static function delResp($desc)
    {
        self::abrirConexion();
        $query = "DELETE FROM respuesta WHERE descripcionR = ? ";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $desc);

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
                $per->setActivo($fila['activo']);
                $per->setConectar($fila['conectado']);
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
        $_SESSION['res'] = $result;

        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $per = new Persona($fila["nombre"], $fila["correo"]);
                $per->setPassword($fila["password"]);
                $per->setConectar($fila["conectado"]);
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $per;
    }
    /*---------------------------------------------------------------------------------*/
    public static function buscarPreguntaConRespuesta($pregunta)
    {
        $pre = null;

        self::abrirConexion();

        $query = "SELECT pregunta.descripcion,pregunta.correo,respuesta.descripcionR FROM pregunta JOIN preg_resp
    ON preg_resp.Id_pregunta=pregunta.Id_pregunta JOIN respuesta ON respuesta.id_respuesta=preg_resp.id_respuesta WHERE
     pregunta.descripcion LIKE ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $pregunta);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $pre = new Pregunta($fila["descripcionR"], $fila["descripcion"], $fila['correo']);
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $pre;
    }
    /*--------------------------------------------------------------*/
    public static function obtenerArrayDeOpciones($idPreg)
    {
        $array = array();

        self::abrirConexion();

        $query = "SELECT descripcion FROM opciones WHERE id_pregunta LIKE ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("i", $idPreg);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $opcion = $fila['descripcion'];
                $array[] = $opcion;
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $array;
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

        $query = "SELECT pregunta.descripcion,pregunta.correo,respuesta.descripcionR FROM pregunta JOIN preg_resp
        ON preg_resp.Id_pregunta=pregunta.Id_pregunta JOIN respuesta ON respuesta.id_respuesta=preg_resp.id_respuesta";

        $resultado = self::$conexion->query($query);

        if ($resultado) {
            while ($fila = mysqli_fetch_array($resultado)) {
                $pregunta = new Pregunta($fila['descripcionR'], $fila['descripcion'], $fila['correo']);
                $array[] = $pregunta;
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
    public static function GestionActivacionPersona($valor, $correo)
    {
        self::abrirConexion();
        $query = "UPDATE persona SET activo = ? WHERE correo LIKE ? ";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("is", $valor, $correo);

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

    /*---------------------------------------------------------------*/
    public static function obtenerRespuesta($idResp)
    {
        $resp = null;

        self::abrirConexion();

        $query = "SELECT descripcionR FROM respuesta WHERE id_respuesta like ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $idResp);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $resp = $fila['descripcionR'];
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $resp;
    }


    /*---------------------------------------------------------------*/
    public static function editarPregunta($preAnt, $preNew)
    {

        self::abrirConexion();
        $query = "UPDATE pregunta SET descripcion = ? WHERE descripcion LIKE ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("ss", $preNew, $preAnt);

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

    public static function editarRespuesta($resp_Ant, $respuestaNueva)
    {
        self::abrirConexion();
        $query = "UPDATE respuesta SET descripcionR = ? WHERE descripcionR LIKE ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("ss", $respuestaNueva, $resp_Ant);

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

    public static function editarOpcion($opNew, $opAnt)
    {
        self::abrirConexion();
        $query = "UPDATE opciones SET descripcion = ? WHERE descripcion LIKE ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("ss", $opNew, $opAnt);

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

    /*-----------------------------------------------------------------------------------*/
    public static function activarPersona($email)
    {
        self::abrirConexion();
        $query = "UPDATE persona SET activo = 1 WHERE correo LIKE ?";
        $_SESSION['query'] = $query;
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $email);

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
