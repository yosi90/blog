<?php
include_once 'config.inc.php';
include_once 'conexion.inc.php';
include_once 'entrada.inc.php';

class Repositorioentrada
{
    public static function insertar_entrada($conexion, $entrada)
    {
        $entrada_insertada = FALSE;
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO entradas (id_autor, url, titulo, texto, fecha, activa) VALUES (:id_autor, :url, :titulo, :texto, NOW(), 0)";
                $sentencia = $conexion->prepare($sql);
                $autorTemp = $entrada->getAutor();
                $urlTemp = $entrada->getUrl();
                $tituloTemp = $entrada->getTitulo();
                $textoTemp = $entrada->getTexto();
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_autor', $autorTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':url', $urlTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':titulo', $tituloTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':texto', $textoTemp, PDO::PARAM_STR);
                $entrada_insertada = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entrada_insertada;
    }

    public static function obtener_fecha_desc($conexion)
    {
        $entradas = [];
        if (isset($conexion)) {
            try {
                $sql = 'SELECT * FROM entradas ORDER BY fecha DESC LIMIT 8';
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas[] = new entrada($fila['id_entrada'], $fila['id_autor'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']);
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $entradas;
    }

    public static function entrada_existe($conexion, $url)
    {
        $entrada = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas WHERE url LIKE :url and activa = 0";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $entrada = new entrada($resultado['id_entrada'], $resultado['id_autor'], $resultado['url'], $resultado['titulo'], $resultado['texto'], $resultado['fecha'], $resultado['activa']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entrada;
    }

    public static function entrada_azar($conexion, $limite)
    {
        $entradas = [];
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas ORDER BY RAND() LIMIT $limite";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $resultado) {
                        $entradas[] = new entrada(
                            $resultado['id_entrada'],
                            $resultado['id_autor'],
                            $resultado['url'],
                            $resultado['titulo'],
                            $resultado['texto'],
                            $resultado['fecha'],
                            $resultado['activa']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entradas;
    }

    public static function entradas_usr($conexion, $id_usr, $num)
    {
        $total = 0;
        if (isset($conexion)) {
            try {
                $sql = "SELECT count(*) as total FROM entradas WHERE id_autor = :id_autor and activa = :num";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_autor', $id_usr, PDO::PARAM_STR);
                $sentencia->bindParam(':num', $num, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $total = $resultado['total'];
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }else{
            return 'fallo';
        }
        return $total;
    }

    public static function entradas_usr_fecha($conexion, $id_usuario)
    {
        $entradas_obtenidas = [];
        if (isset($conexion)) {
            try {
                $sql = "SELECT a.id_entrada, a.id_autor, a.url, a.titulo, a.texto, a.fecha, a.activa, COUNT(b.id_comentario) AS 'cantidad_comentarios' FROM entradas a LEFT JOIN comentarios b ON a.id_entrada = b.id_entrada WHERE a.id_autor = :num GROUP BY a.id_entrada ORDER BY a.fecha DESC";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':num', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas_obtenidas[] = array(new entrada($fila['id_entrada'], $fila['id_autor'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']), $fila['cantidad_comentarios']);
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entradas_obtenidas;
    }

    public static function titulo_existe($conexion, $titulo)
    {
        $titulo_existe = true;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas WHERE titulo = :titulo";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (!count($resultado))
                    $titulo_existe = FALSE;
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $titulo_existe;
    }
}
