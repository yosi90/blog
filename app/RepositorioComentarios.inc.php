<?php
include_once 'config.inc.php';
include_once 'conexion.inc.php';
class RepositorioComentarios
{
    public static function insertar_comentario($conexion, $comentario)
    {
        $comentario_insertado = FALSE;
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO comentarios (id_autor, id_entrada, titulo, texto, fecha) VALUES (:id_autor, :id_entrada, :titulo, :texto, NOW())";
                $sentencia = $conexion->prepare($sql);
                $autorTemp = $comentario->getAutor();
                $entradaTemp = $comentario->getId_entrada();
                $tituloTemp = $comentario->getTitulo();
                $textoTemp = $comentario->getTexto();
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_autor', $autorTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':id_entrada', $entradaTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':titulo', $tituloTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':texto', $textoTemp, PDO::PARAM_STR);
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
                include_once 'comentario.inc.php';
                $sql = "SELECT * FROM comentarios WHERE id_entrada = :id_entrada";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_entrada', $id_entrada, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $comentarios[] = new comentario($fila['id_comentario'], $fila['id_autor'], $fila['id_entrada'], $fila['titulo'], $fila['texto'], $fila['fecha']);
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $comentarios;
    }

    public static function usr_comments($conexion, $id_usr)
    {
        $total = 0;
        if (isset($conexion)) {
            try {
                $sql = "SELECT count(*) as total FROM comentarios WHERE id_autor = :id_autor";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_autor', $id_usr, PDO::PARAM_STR);
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
}
