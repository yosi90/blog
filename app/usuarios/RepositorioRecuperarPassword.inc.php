<?php
require_once ROOT . 'recuperarPassword.inc.php';
class RepositorioRecuperarPassword
{

    public static function generarPeticion($conexion, $id_usuario, $url)
    {
        $peticionGenerada = false;
        try {
            $sql = "INSERT INTO usuariosurlactualizar (id_usuario, url, fecha) VALUES (:id_usuario, :url, now())";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
            $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
            $peticionGenerada = $sentencia->execute();
        } catch (PDOException $ex) {
            print 'ERROR' . $ex->getMessage();
        }
        return $peticionGenerada;
    }

    public static function existePeticion($conexion, $id_usuario)
    {
        $peticion = false;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuariosurlactualizar WHERE id_usuario = :id_usuario and fecha > now() - interval 1 hour";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (!empty($resultado)) {
                    foreach ($resultado as $fila)
                        $peticion = new recuperarPassword($fila['id_url'], $fila['id_usuario'], $fila['url'], $fila['fecha'], $fila['intentos']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        if ($peticion != false) {
            if ($peticion->getIntentos() == 3) {
                return 'bloqueado';
            } else {
                RepositorioRecuperarPassword::añadirIntento($conexion, $peticion->getIdUrl(), ($peticion->getIntentos() + 1));
            }
        } else {
            try {
                $sql = "SELECT * FROM usuariosurlactualizar WHERE id_usuario = :id_usuario and fecha > now() - interval 1 day";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (!empty($resultado)) {
                    foreach ($resultado as $fila)
                        $peticion = new recuperarPassword($fila['id_url'], $fila['id_usuario'], $fila['url'], $fila['fecha'], $fila['intentos']);
                }
                if ($peticion != false)
                    return 'bloqueado';
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $peticion;
    }

    public static function añadirIntento($conexion, $id_url, $intentos)
    {
        $conexion->beginTransaction();
        $sql = "UPDATE usuariosurlactualizar SET intentos = $intentos WHERE id_url = :id_url";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':id_url', $id_url, PDO::PARAM_STR);
        $sentencia->execute();
        $conexion->commit();
    }

    public static function peticionPorUrl($conexion, $url)
    {
        $peticion = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuariosurlactualizar WHERE url = :url";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (!empty($resultado)) {
                    foreach ($resultado as $fila)
                        $peticion = new recuperarPassword($fila['id_url'], $fila['id_usuario'], $fila['url'], $fila['fecha'], $fila['intentos']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $peticion;
    }

    public static function ActualizarContraseña($conexion, $password, $idUsuario, $idPeticion)
    {
        if (isset($conexion)) {
            try {
                $conexion->beginTransaction();
                $sql = "UPDATE usuarios SET password = :password WHERE id_usuario = :idUsuario";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':password', $password, PDO::PARAM_STR);
                $sentencia->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
                $sentencia->execute();
                $conexion->commit();
                RepositorioRecuperarPassword::añadirIntento($conexion, $idPeticion, 5);
                return true;
            } catch (PDOException $ex) {
                $conexion->rollBack();
                print 'ERROR' . $ex->getMessage();
            }
        }
        return false;
    }
}
