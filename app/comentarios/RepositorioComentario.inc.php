<?php
require_once ROOT . 'config/Config.inc.php';
require_once ROOT . 'config/Conexion.inc.php';
require_once ROOT . 'app/comentarios/Comentario.inc.php';
require_once ROOT . 'app/purificador.inc.php';

class RepositorioComentario
{
    public static function insertar_comentario($conexion, $texto, $idAutor, $id_entrada)
    {
        $texto = purifier::purifier($texto, 'texto');
        $comentario_insertado = FALSE;
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO comentarios (texto, fecha) VALUES (:texto, NOW())";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':texto', $texto, PDO::PARAM_STR);
                $sentencia->execute();
                $sql = "SELECT id_comentario FROM comentarios WHERE texto = :texto";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':texto', $texto, PDO::PARAM_STR);
                $sentencia->execute();
                $id_comentario = $sentencia->fetch();
                $sql = "INSERT INTO usuario_comentarios VALUES (:id_usuario, :id_comentario)";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_usuario', $idAutor, PDO::PARAM_STR);
                $sentencia->bindParam(':id_comentario', $id_comentario['id_comentario'], PDO::PARAM_STR);
                $sentencia->execute();
                $sql = "select count(*) AS total from entrada_comentarios where id_entrada = :id_entrada";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_entrada', $id_entrada, PDO::PARAM_STR);
                $sentencia->execute();
                $indice = $sentencia->fetch();
                $sql = "INSERT INTO entrada_comentarios VALUES (:id_entrada, :id_comentario, :indice)";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_entrada', $id_entrada, PDO::PARAM_STR);
                $sentencia->bindParam(':id_comentario', $id_comentario['id_comentario'], PDO::PARAM_STR);
                $sentencia->bindParam(':indice', $indice['total'], PDO::PARAM_STR);
                $comentario_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $comentario_insertado;
    }

    public static function getComments($conexion, $id_entrada)
    {
        $comentarios = array();
        if (isset($conexion)) {
            try {
                require_once 'comentario.inc.php';
                $sql = 'SELECT c.id_comentario, u.nombre, uc.id_usuario, e.titulo, ec.id_entrada, e.url, c.texto, c.fecha, ec.indice'.
                ' FROM comentarios c inner join usuario_comentarios uc on c.id_comentario = uc.id_comentario inner join usuarios u on uc.id_usuario = u.id_usuario inner join entrada_comentarios ec on c.id_comentario = ec.id_comentario inner join entradas e on ec.id_entrada = e.id_entrada'.
                ' WHERE ec.id_entrada = :id_entrada';
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_entrada', $id_entrada, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $comentarios[] = new comentario($fila['id_comentario'], $fila['nombre'], $fila['id_usuario'], $fila['titulo'], $fila['id_entrada'], $fila['url'], $fila['texto'], $fila['fecha'], $fila['indice']);
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $comentarios;
    }

    public static function usr_comments($conexion, $id_usuario)
    {
        $total = 0;
        if (isset($conexion)) {
            try {
                $sql = "SELECT count(*) as total FROM comentarios c inner join usuario_comentarios uc on c.id_comentario = uc.id_comentario WHERE id_usuario = :id_usuario";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $total = $resultado['total'];
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $total;
    }

    public static function getCountFiltered($conexion, $filtro)
    {
        if (isset($conexion)) {
            try {
                $sql = 'SELECT count(id_comentario) as cantidad FROM comentarios WHERE texto like :filtro and bloqueado = 0 ORDER BY fecha';
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
        $comentarios = [];
        if (isset($conexion)) {
            try {
                $sql = 'SELECT c.id_comentario, u.nombre, uc.id_usuario, e.titulo, ec.id_entrada, e.url, c.texto, c.fecha, ec.indice'.
                ' FROM comentarios c inner join usuario_comentarios uc on c.id_comentario = uc.id_comentario inner join usuarios u on uc.id_usuario = u.id_usuario inner join entrada_comentarios ec on c.id_comentario = ec.id_comentario inner join entradas e on ec.id_entrada = e.id_entrada'.
                ' WHERE c.texto like :filtro ORDER BY fecha';
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':filtro', $filtro, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $instance = new comentario($fila['id_comentario'], $fila['nombre'], $fila['id_usuario'], html_entity_decode($fila['titulo'], ENT_QUOTES, 'UTF-8'), $fila['id_entrada'], $fila['url'], $fila['texto'], $fila['fecha'], $fila['indice']);
                        $comentarios[] = $instance->getArray();
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $comentarios;
    }
}
