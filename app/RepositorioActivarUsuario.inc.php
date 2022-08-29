<?php

require_once 'app/activarUsuario.inc.php';

class RepositorioActivarUsuario
{
    public static function generarPeticion($conexion, $id_usuario, $url)
    {
        $peticionGenerada = false;
        try {
            $sql = "INSERT INTO usuariosurlactivar (id_usuario, url, fecha) VALUES (:id_usuario, :url, now())";
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
                $sql = "SELECT * FROM usuariosurlactivar WHERE id_usuario = :id_usuario";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (!empty($resultado)) {
                    foreach ($resultado as $fila)
                        $peticion = new activarUsuario($fila['id_url'], $fila['id_usuario'], $fila['url'], $fila['fecha']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $peticion;
    }

    public static function peticionPorUrl($conexion, $url)
    {
        $peticion = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuariosurlactivar WHERE url = :url";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (!empty($resultado)) {
                    foreach ($resultado as $fila)
                        $peticion = new activarUsuario($fila['id_url'], $fila['id_usuario'], $fila['url'], $fila['fecha']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $peticion;
    }

    public static function peticionPorUsr($conexion, $id_usuario)
    {
        $peticion = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuariosurlactivar WHERE id_usuario = :id_usuario";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (!empty($resultado)) {
                    foreach ($resultado as $fila)
                        $peticion = new activarUsuario($fila['id_url'], $fila['id_usuario'], $fila['url'], $fila['fecha']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $peticion;
    }

    public static function activarCuenta($conexion, $id_usuario)
    {
        if (isset($conexion)) {
            try {
                $sql = "UPDATE usuarios SET activo = 1 WHERE id_usuario = :id_usuario";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                return true;
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return false;
    }
}
