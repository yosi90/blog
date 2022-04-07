<?php
require_once ROOT . 'config/Conexion.inc.php';
require_once ROOT . 'app/usuarios/usuario.inc.php';
require_once ROOT . 'app/purificador.inc.php';

class RepositorioUsuario
{
    public static function obtener_numero_usuarios($conexion)
    {
        $total_usuarios = null;
        if (isset($conexion)) {
            try {
                $sql = "select count(*) as total from usuarios where activo = 1";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                $total_usuarios = $resultado['total'];
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $total_usuarios;
    }

    public static function insertar_usuario($conexion, $usuario)
    {
        $usuario_insertado = FALSE;
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO usuarios (nombre, correo, password, fecha_registro, activo) VALUES (:nombre, :correo, :password, NOW(), 0)";
                $sentencia = $conexion->prepare($sql);
                $nombreTemp = $usuario->getNombre();
                $passwordTemp = $usuario->getPassword();
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':nombre', $nombreTemp, PDO::PARAM_STR);
                $correo = purifier::purifier($usuario->getEmail(), 'email');
                $sentencia->bindParam(':correo', $correo, PDO::PARAM_STR);
                $sentencia->bindParam(':password', $passwordTemp, PDO::PARAM_STR);
                $usuario_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $usuario_insertado;
    }

    public static function nombre_existe($conexion, $nombre)
    {
        $nombre_existe = true;
        if (isset($conexion)) {
            try {
                $sql = "SELECT nombre FROM usuarios WHERE nombre = :nombre";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    $nombre_existe = TRUE;
                } else {
                    $nombre_existe = FALSE;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $nombre_existe;
    }

    public static function email_existe($conexion, $correo)
    {
        $email_existe = true;
        if (isset($conexion)) {
            try {
                $sql = "SELECT correo FROM usuarios WHERE correo = :correo";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':correo', $correo, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    $email_existe = TRUE;
                } else {
                    $email_existe = FALSE;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $email_existe;
    }

    public static function obtener_usuario_email($conexion, $correo)
    {
        $usuario = null;
        if (isset($conexion)) {
            try {
                require_once ROOT . 'app/usuarios/usuario.inc.php';
                $sql = "SELECT * FROM usuarios WHERE correo = :correo";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':correo', $correo, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $usuario = new usuario($resultado['id_usuario'], $resultado['nombre'], $resultado['correo'], $resultado['password'], $resultado['fecha_registro'], $resultado['activo'], $resultado['moderador'], $resultado['administrador']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $usuario;
    }

    public static function obtener_usuario_id($conexion, $id_usuario)
    {
        $usuario = null;
        if (isset($conexion)) {
            try {
                require_once ROOT . 'app/usuarios/usuario.inc.php';
                $sql = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $usuario = new usuario($resultado['id_usuario'], $resultado['nombre'], $resultado['correo'], $resultado['password'], $resultado['fecha_registro'], $resultado['activo'], $resultado['moderador'], $resultado['administrador']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $usuario;
    }

    public static function getCountFiltered($conexion, $filtro)
    {
        if (isset($conexion)) {
            try {
                $sql = 'SELECT count(id_usuario) as cantidad FROM usuarios WHERE nombre like :filtro and bloqueado = 0 ORDER BY fecha_registro';
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':filtro', $filtro, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado))
                    return $resultado[0]['cantidad'];
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return 0;
    }

    public static function obtenerFiltrados($conexion, $filtro)
    {
        $usuarios = [];
        if (isset($conexion)) {
            try {
                $sql = 'SELECT u.id_usuario, u.nombre, u.correo, u.password, u.fecha_registro, u.activo, u.moderador, u.administrador, COUNT(ue.id_entrada) AS "totalEntradas"'.
                ' FROM usuarios u LEFT JOIN usuario_entradas ue ON u.id_usuario = ue.id_usuario WHERE u.nombre like :filtro GROUP BY u.id_usuario ORDER BY u.fecha_registro DESC'; /*and u.activo = 1*/
                $sentencia1 = $conexion->prepare($sql);
                $sentencia1->bindParam(':filtro', $filtro, PDO::PARAM_STR);
                $sentencia1->execute();
                $resultado1 = $sentencia1->fetchAll();
                $sql = "SELECT COUNT(uc.id_comentario) AS 'totalComentarios' FROM usuarios u LEFT JOIN usuario_comentarios uc ON u.id_usuario = uc.id_usuario WHERE u.nombre like :filtro GROUP BY u.id_usuario ORDER BY u.fecha_registro DESC"; /*and u.activo = 1*/
                $sentencia2 = $conexion->prepare($sql);
                $sentencia2->bindParam(':filtro', $filtro, PDO::PARAM_STR);
                $sentencia2->execute();
                $resultado2 = $sentencia2->fetchAll();
                if (count($resultado1)) {
                    $cont = 0;
                    foreach ($resultado1 as $fila) {
                        $instance = new usuario($fila['id_usuario'], $fila['nombre'], $fila['correo'], $fila['password'], $fila['fecha_registro'], $fila['activo'], $fila['moderador'], $fila['administrador']);
                        $instance->setTotalEntradas($fila['totalEntradas']);
                        $instance->setTotalComentarios($resultado2[$cont]['totalComentarios']);
                        $usuarios[] = $instance->getArray();
                        $cont++;
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $usuarios;
    }
}