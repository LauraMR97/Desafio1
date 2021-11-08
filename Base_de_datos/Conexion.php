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
    /*--------------------------------------------------------------*/
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
                $per->setConectar($fila['conectado']);
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


    /*--------------------------------------------------------------------------------------*/

    public static function ConectarPersona($email)
    {
        self::abrirConexion();
        $query = "UPDATE persona SET conectado = 1 WHERE correo LIKE ?";
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

    /*-----------------------------------------------------------------------------------------*/
    public static function DesconectarPersona($email)
    {
        self::abrirConexion();
        $query = "UPDATE persona SET conectado = 0 WHERE correo LIKE ?";
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
    public static function CrearSala($codigo, $nombreSala, $tipoSala, $num, $creador)
    {
        self::abrirConexion();
        $query = "INSERT INTO sala (codigo,nombre,tipo,num_personas,creador) VALUES (?,?,?,?,?)";
        $stmt = self::$conexion->prepare($query);
        $stmt->bind_param("sssis", $codigo, $nombreSala, $tipoSala, $num, $creador);


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

    public static function BuscarSala($codigo)
    {
        $sala = null;

        self::abrirConexion();

        $query = "SELECT nombre FROM sala WHERE codigo like ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $codigo);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $sala = $fila['nombre'];
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $sala;
    }

    /*--------------------------------------------------------------*/
    public static function verNumeroJugadoresDeSala($codigo)
    {
        $num  = null;

        self::abrirConexion();

        $query = "SELECT num_personas FROM sala WHERE codigo like ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $codigo);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $num = $fila['num_personas'];
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $num;
    }

    /*--------------------------------------------------------------*/
    public static function modificarNumeroJugadores($codSala, $numJugadores)
    {
        self::abrirConexion();
        $query = "UPDATE sala SET num_personas = ? WHERE codigo LIKE ?";
        $_SESSION['query'] = $query;
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("is", $numJugadores, $codSala);

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
    public static function DropSala($codSala)
    {
        self::abrirConexion();
        $query = "DELETE FROM sala WHERE codigo = ? ";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $codSala);

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

    /*--------------------------------------------------------------*/

    public static function verSalasPublicas()
    {
        $array = array();
        $tipo = 'Publica';

        self::abrirConexion();

        $query = "SELECT * FROM sala WHERE tipo like ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $tipo);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $sala = new Sala($fila['codigo'], $fila['nombre'], $fila['tipo'], $fila['num_personas'], $fila['creador']);
                $array[] = $sala;
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $array;
    }
    /*--------------------------------------------------------------*/
    public static function verCreadorDeSala($codigo)
    {
        $creador  = null;

        self::abrirConexion();

        $query = "SELECT creador FROM sala WHERE codigo like ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $codigo);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $creador = $fila['creador'];
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $creador;
    }
    /*------------------------------------------------------------------------------------*/
    public static function CrearEquipo($email)
    {
        self::abrirConexion();
        $llaves = 0;
        $query = "INSERT INTO equipo (llaves,anfitrion) VALUES (?,?)";
        $stmt = self::$conexion->prepare($query);
        $stmt->bind_param("is", $llaves, $email);


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
    /*-------------------------------------------------------------------------------*/
    public static function verCodigo($anfitrion)
    {
        $cod  = null;

        self::abrirConexion();

        $query = "SELECT id_equipo FROM equipo WHERE anfitrion like ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $anfitrion);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $cod = $fila['id_equipo'];
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $cod;
    }
    /*-------------------------------------------------------------------------------*/
    public static function AddParticipante($persona, $codEquipo)
    {
        self::abrirConexion();
        $query = "INSERT INTO equipo_persona (id_equipo,correo) VALUES (?,?)";
        $stmt = self::$conexion->prepare($query);
        $stmt->bind_param("is", $codEquipo, $persona);


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
    /*-------------------------------------------------------------------------------*/
    public static function DropEquipo($codEquipo)
    {
        self::abrirConexion();
        $query = "DELETE FROM equipo WHERE id_equipo = ? ";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("i", $codEquipo);

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
    /*-------------------------------------------------------------------------------*/

    public static function quitarPersonaDelEquipo($persona)
    {
        self::abrirConexion();
        $query = "DELETE FROM equipo_persona WHERE correo = ? ";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $persona);

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
    /*-------------------------------------------------------------------------------*/
    public static function CrearPartida($anfitrion)
    {
        self::abrirConexion();
        $resultado = 'nulo';
        $almirante = 'nadie';
        $estado = 'nulo';
        $fecha = date('h:i:s');
        $_SESSION['fechaIni'] = $fecha;

        $query = "INSERT INTO partida (resultado,almirante,estado,fecha,anfitrion) VALUES (?,?,?,?,?)";
        $stmt = self::$conexion->prepare($query);
        $stmt->bind_param("sssss", $resultado, $almirante, $estado, $fecha, $anfitrion);


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
    /*-------------------------------------------------------------------------------*/
    /*  public static function DropPartida($email)
    {
        self::abrirConexion();
        $query = "DELETE FROM partida WHERE anfitrion = ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $mensaje = 'Registro eliminado con éxito' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            // Bitacora::guardarArchivo($mensaje);
        } else {
            $mensaje = 'Error al eliminar' . ' ' . date('m-d-Y h:i:s a', time()) . '<br>';
            // Bitacora::guardarArchivo($mensaje);
        }
        $stmt->close();
        self::cerrarConexion();
    }*/
    /*-------------------------------------------------------------------------------*/
    public static function verEstado($creador)
    {
        $estado  = null;

        self::abrirConexion();

        $query = "SELECT estado FROM partida WHERE anfitrion like ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $creador);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $estado = $fila['estado'];
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $estado;
    }
    /*-------------------------------------------------------------------------------*/
    public static function ActivarEstadoPartida($email)
    {
        self::abrirConexion();
        $query = "UPDATE partida SET estado = ? WHERE anfitrion LIKE ?";
        $_SESSION['query'] = $query;
        $stmt = self::$conexion->prepare($query);

        $newEstado = 'Activo';
        $stmt->bind_param("ss", $newEstado, $email);

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
    /*-------------------------------------------------------------------------------*/
    public static function verLlaves($idEq)
    {
        $llave  = null;

        self::abrirConexion();

        $query = "SELECT llaves FROM equipo WHERE id_equipo like ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("i", $idEq);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $llave = $fila['llaves'];
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $llave;
    }
    /*-------------------------------------------------------------------------------*/
    /* public static function VerPregunta()
    {
        $array = array();

        self::abrirConexion();

        $query = "SELECT pregunta.descripcion,respuesta.descripcionR FROM pregunta JOIN preg_resp
        ON preg_resp.Id_pregunta=pregunta.Id_pregunta JOIN respuesta ON respuesta.id_respuesta=preg_resp.id_respuesta";

        $resultado = self::$conexion->query($query);

        if ($resultado) {
            while ($fila = mysqli_fetch_array($resultado)) {
                $array[] =['pregunta'=> $fila['descripcion'],'respuesta'=>$fila['descripcionR']];
            }
        }
        mysqli_free_result($resultado);

        self::cerrarConexion();

        return json_encode($array);
    }*/
    /*-------------------------------------------------------------------------------*/
    public static function VerPregunta()
    {
        $array = array();

        self::abrirConexion();

        $query = "SELECT pregunta.descripcion,respuesta.descripcionR,pregunta.correo FROM pregunta JOIN preg_resp
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

    /*-------------------------------------------------------------------------------*/
    public static function ContadorDePreguntasExistentes()
    {
        $numero = 0;

        self::abrirConexion();

        $query = "SELECT COUNT(*) AS numPreguntas FROM pregunta";
        $resultado = self::$conexion->query($query);

        if ($resultado) {
            while ($fila = mysqli_fetch_array($resultado)) {
                $numero = $fila['numPreguntas'];
            }
        }
        mysqli_free_result($resultado);

        self::cerrarConexion();

        return $numero;
    }
    /*-------------------------------------------------------------------------------*/
    public static function verIDEquipo($anfitrion)
    {
        $idEq  = null;

        self::abrirConexion();

        $query = "SELECT id_equipo FROM equipo WHERE anfitrion like ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $anfitrion);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $idEq = $fila['id_equipo'];
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $idEq;
    }
    /*-------------------------------------------------------------------------------*/
    public static function VerPersonasEquipo($idEquipo)
    {
        $array = array();

        self::abrirConexion();

        $query = "SELECT correo FROM equipo_persona WHERE id_equipo = '" . $idEquipo . "'";

        $resultado = self::$conexion->query($query);

        if ($resultado) {
            while ($fila = mysqli_fetch_array($resultado)) {
                $array[] = ['persona' => $fila['correo']];
            }
        }
        mysqli_free_result($resultado);

        self::cerrarConexion();

        return json_encode($array);
    }
    /*-------------------------------------------------------------------------------*/
    public static function verOpcionesDePregunta($idPregunta)
    {
        $array = array();

        self::abrirConexion();

        $query = "SELECT descripcion FROM opciones WHERE id_pregunta = '" . $idPregunta . "'";

        $resultado = self::$conexion->query($query);

        if ($resultado) {
            while ($fila = mysqli_fetch_array($resultado)) {
                $array[] = ['opcion' => $fila['descripcion']];
            }
        }
        mysqli_free_result($resultado);

        self::cerrarConexion();

        return json_encode($array);
    }
    /*-------------------------------------------------------------------------------*/
    public static function verAnfitrion($idEquipo)
    {
        $persona = '';

        self::abrirConexion();

        $query = "SELECT anfitrion FROM equipo WHERE id_equipo like ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("i", $idEquipo);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $persona = $fila['anfitrion'];
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $persona;
    }
    /*-------------------------------------------------------------------------------*/
    public static function verAlmirante($Anfitrion)
    {
        $persona = '';

        self::abrirConexion();

        $query = "SELECT almirante FROM partida WHERE anfitrion like ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $Anfitrion);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $persona = $fila['almirante'];
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $persona;
    }

    /*-------------------------------------------------------------------------------*/
    public static function sumarLlave($Anfitrion, $nuevasLlaves)
    {
        self::abrirConexion();

        $query = "UPDATE equipo SET llaves = ? WHERE anfitrion LIKE ?";
        $_SESSION['query'] = $query;
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("is", $nuevasLlaves, $Anfitrion);

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

    /*-------------------------------------------------------------------------------*/
    public static function addPersonaQueContesta($persona, $idEquipo)
    {
        self::abrirConexion();
        $query = "INSERT INTO partida_almirante (correo,id_equipo) VALUES (?,?)";
        $stmt = self::$conexion->prepare($query);
        $stmt->bind_param("si", $persona, $idEquipo);


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

    /*-------------------------------------------------------------------------------*/
    public static function verPrimeroEnAcertar($idEquipo)
    {
        $persona = '';

        self::abrirConexion();

        $query = "SELECT MIN(id_informacion),correo FROM partida_almirante WHERE id_equipo like ? GROUP BY id_informacion";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("i", $idEquipo);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $persona = $fila['correo'];
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $persona;
    }
    /*-------------------------------------------------------------------------------*/
    public static function AscenderAlmirante($almirante, $anfitrion)
    {
        self::abrirConexion();

        $query = "UPDATE partida SET almirante = ? WHERE anfitrion LIKE ?";

        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("ss", $almirante, $anfitrion);

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
    /*-------------------------------------------------------------------------------*/
    public static function verAciertos($correo)
    {
        $aciertos = '';

        self::abrirConexion();

        $query = "SELECT aciertos FROM persona WHERE correo like ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("s", $correo);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $aciertos = $fila['aciertos'];
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $aciertos;
    }
    /*-------------------------------------------------------------------------------*/
    public static function sumarAciertos($correo, $aciertos)
    {
        self::abrirConexion();

        $query = "UPDATE persona SET aciertos = ? WHERE correo LIKE ?";
        $_SESSION['query'] = $query;
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("is", $aciertos, $correo);

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
    /*-------------------------------------------------------------------------------*/
    public static function Victoria($anfitrion)
    {
        self::abrirConexion();

        $resultado = 'Victoria';
        $_SESSION['resultado'] = $resultado;
        $query = "UPDATE partida SET resultado = ? WHERE anfitrion LIKE ?";
        $_SESSION['query'] = $query;
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("ss", $resultado, $anfitrion);

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
    /*-------------------------------------------------------------------------------*/
    public static function Derrota($anfitrion)
    {
        self::abrirConexion();

        $resultado = 'Derrota';
        $_SESSION['resultado'] = $resultado;
        $query = "UPDATE partida SET resultado = ? WHERE correo LIKE ?";
        $_SESSION['query'] = $query;
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("ss", $resultado, $anfitrion);

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
    /*-------------------------------------------------------------------------------*/
    public static function CrearHistorial($codEquipo, $correo, $fechaFin, $fechaIni, $resultado, $almirante)
    {
        self::abrirConexion();
        $query = "INSERT INTO historial (id_equipo,correo,fechaIni,fechaFin,resultado,almirante) VALUES (?,?,?,?,?,?)";
        $stmt = self::$conexion->prepare($query);
        $stmt->bind_param("isssss", $codEquipo, $correo, $fechaIni, $fechaFin, $resultado, $almirante);


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
    /*-------------------------------------------------------------------------------*/
    public static function PersonasEquipo($idEquipo)
    {
        $array = array();

        self::abrirConexion();

        $query = "SELECT correo FROM equipo_persona WHERE id_equipo like ?";
        $stmt = self::$conexion->prepare($query);

        $stmt->bind_param("i", $idEquipo);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result) {
            while ($fila = mysqli_fetch_array($result)) {
                $persona = $fila['correo'];
                $array[] = $persona;
            }
        }

        $stmt->close();
        self::cerrarConexion();

        return $array;
    }
    /*-------------------------------------------------------------------------------*/
    public static function verHistorial()
    {
        $array = array();

        self::abrirConexion();

        $query = "SELECT * FROM historial";

        $resultado = self::$conexion->query($query);

        if ($resultado) {
            while ($fila = mysqli_fetch_array($resultado)) {
                $array[] = ['equipo' => $fila['id_equipo'], 'personas' => $fila['correo'], 'fechaIni' => $fila['fechaIni'], 'fechaFin' => $fila['fechaFin'], 'resultado' => $fila['resultado'], 'almirante' => $fila['almirante']];
            }
        }
        mysqli_free_result($resultado);

        self::cerrarConexion();

        return json_encode($array);
    }
    /*-------------------------------------------------------------------------------*/
    public static function cerrarConexion()
    {
        self::$conexion->close();
    }
}
