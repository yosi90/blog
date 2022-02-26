<?php
include_once '../plantillas/base_apps.inc.php';

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
                $sql = "INSERT INTO usuarios (nombre, email, password, fecha_registro, activo) VALUES (:nombre, :email, :password, NOW(), 0)";
                $sentencia = $conexion->prepare($sql);
                $nombreTemp = $usuario->getNombre();
                $emailTemp = $usuario->getEmail();
                $passwordTemp = $usuario->getPassword();
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':nombre', $nombreTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':email', $emailTemp, PDO::PARAM_STR);
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

    public static function email_existe($conexion, $email)
    {
        $email_existe = true;
        if (isset($conexion)) {
            try {
                $sql = "SELECT email FROM usuarios WHERE email = :email";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':email', $email, PDO::PARAM_STR);
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

    public static function obtener_usuario_email($conexion, $email)
    {
        $usuario = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuarios WHERE email = :email";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':email', $email, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $usuario = new usuario($resultado['id'], $resultado['nombre'], $resultado['email'], $resultado['password'], $resultado['fecha_registro'], $resultado['activo']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $usuario;
    }

    public static function obtener_usuario_id($conexion, $id)
    {
        $usuario = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuarios WHERE id = :id";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $usuario = new usuario($resultado['id'], $resultado['nombre'], $resultado['email'], $resultado['password'], $resultado['fecha_registro'], $resultado['activo']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $usuario;
    }

    public static function icon_rand()
    {
        $icon = null;
        $fondo = rand(1, 8);
        switch ($fondo) {
            case 1:
                return '<i class="fas fa-user-ninja fa-lg"></i>';
                break;
            case 2:
                return '<i class="fas fa-user fa-lg"></i>';
                break;
            case 3:
                return '<i class="fas fa-user-astronaut fa-lg"></i>';
                break;
            case 4:
                return '<i class="fas fa-user-graduate fa-lg"></i>';
                break;
            case 5:
                return '<i class="fas fa-user-lock fa-lg"></i>';
                break;
            case 6:
                return '<i class="fas fa-user-md fa-lg"></i>';
                break;
            case 7:
                return '<i class="fas fa-user-secret fa-lg"></i>';
                break;
            case 8:
                return '<i class="fas fa-user-tie fa-lg"></i>';
                break;
        }
    }
}
