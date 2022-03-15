<?php
include_once 'config.inc.php';
include_once 'conexion.inc.php';
include_once 'entrada.inc.php';

class Repositorioentrada
{
    public static function getEntrada($conexion, $idEntrada)
    {
        $entrada = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas WHERE id_entrada = :idEntrada";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':idEntrada', $idEntrada, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $entrada = new entrada($resultado['id_entrada'], $resultado['id_autor'], $resultado['url'], $resultado['titulo'], $resultado['texto'], $resultado['fecha'], $resultado['activa'], $resultado['archivada']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entrada;
    }

    public static function obtener_fecha_desc($conexion)
    {
        $entradas = [];
        if (isset($conexion)) {
            try {
                $sql = 'SELECT * FROM entradas WHERE activa = 1 and archivada = 0 ORDER BY fecha DESC LIMIT 16';
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas[] = new entrada($fila['id_entrada'], $fila['id_autor'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa'], $fila['archivada']);
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
                $sql = "SELECT * FROM entradas WHERE url LIKE :url";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $entrada = new entrada($resultado['id_entrada'], $resultado['id_autor'], $resultado['url'], $resultado['titulo'], $resultado['texto'], $resultado['fecha'], $resultado['activa'], $resultado['archivada']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entrada;
    }

    public static function urlCoincide($conexion, $url)
    {
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas WHERE url LIKE :url";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    return true;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return false;
    }

    public static function entrada_azar($conexion, $limite)
    {
        $entradas = [];
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas WHERE archivada = 0 ORDER BY RAND() LIMIT $limite";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $resultado) {
                        $entradas[] = new entrada($resultado['id_entrada'], $resultado['id_autor'], $resultado['url'], $resultado['titulo'], $resultado['texto'], $resultado['fecha'], $resultado['activa'], $resultado['archivada']);
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
                $sql = "SELECT count(*) as total FROM entradas WHERE id_autor = :id_autor and activa = :num and archivada = 0";
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
        } else {
            return 'fallo';
        }
        return $total;
    }

    public static function entradasArchivadas($conexion, $id_usuario)
    {
        $entradas_obtenidas = [];
        if (isset($conexion)) {
            try {
                $sql = "SELECT a.id_entrada, a.id_autor, a.url, a.titulo, a.texto, a.fecha, a.activa, a.archivada, COUNT(b.id_comentario) AS 'cantidad_comentarios' FROM entradas a LEFT JOIN comentarios b ON a.id_entrada = b.id_entrada WHERE a.id_autor = :num and archivada = 1 GROUP BY a.id_entrada ORDER BY a.fecha DESC";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':num', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas_obtenidas[] = array(new entrada($fila['id_entrada'], $fila['id_autor'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa'], $fila['archivada']), $fila['cantidad_comentarios']);
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entradas_obtenidas;
    }

    public static function entradas_usr_fecha($conexion, $id_usuario)
    {
        $entradas_obtenidas = [];
        if (isset($conexion)) {
            try {
                $sql = "SELECT a.id_entrada, a.id_autor, a.url, a.titulo, a.texto, a.fecha, a.activa, a.archivada, COUNT(b.id_comentario) AS 'cantidad_comentarios' FROM entradas a LEFT JOIN comentarios b ON a.id_entrada = b.id_entrada WHERE a.id_autor = :num and archivada = 0 GROUP BY a.id_entrada ORDER BY a.fecha DESC";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':num', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas_obtenidas[] = array(new entrada($fila['id_entrada'], $fila['id_autor'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa'], $fila['archivada']), $fila['cantidad_comentarios']);
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
                    $titulo_existe = false;
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $titulo_existe;
    }

    public static function insertar_entrada($conexion, $entrada)
    {
        $entrada_insertada = false;
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO entradas (id_autor, url, titulo, texto, fecha, activa) VALUES (:id_autor, :url, :titulo, :texto, NOW(), :activa)";
                $sentencia = $conexion->prepare($sql);
                $autorTemp = $entrada->getAutor();
                $urlTemp = $entrada->getUrl();
                $tituloTemp = $entrada->getTitulo();
                $textoTemp = $entrada->getTexto();
                $activaTemp = $entrada->getActiva();
                $sentencia->bindParam(':id_autor', $autorTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':url', $urlTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':titulo', $tituloTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':texto', $textoTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':activa', $activaTemp, PDO::PARAM_STR);
                $entrada_insertada = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entrada_insertada;
    }

    public static function actualizar_entrada($conexion, $entrada, $entradaPrevia)
    {
        $entradaInsertada = false;
        if (isset($conexion)) {
            try {
                $conexion->beginTransaction();
                $sql = "INSERT INTO entradasEditadas (id_entrada, id_autor, url, titulo, texto, fecha, activa) VALUES (:id_entrada, :id_autor_, :url_, :titulo_previo, :texto_previo, NOW(), :activa_previo)";
                $sentencia = $conexion->prepare($sql);
                $idPrevia = $entradaPrevia->getId_entrada();
                $autorPrevio = $entradaPrevia->getAutor();
                $urlPrevia = $entradaPrevia->getUrl();
                $tituloPrevio = $entradaPrevia->getTitulo();
                $textoPrevio = $entradaPrevia->getTexto();
                $activaPrevia = $entradaPrevia->getActiva();
                $sentencia->bindParam(':id_entrada', $idPrevia, PDO::PARAM_STR);
                $sentencia->bindParam(':id_autor_', $autorPrevio, PDO::PARAM_STR);
                $sentencia->bindParam(':url_', $urlPrevia, PDO::PARAM_STR);
                $sentencia->bindParam(':titulo_previo', $tituloPrevio, PDO::PARAM_STR);
                $sentencia->bindParam(':texto_previo', $textoPrevio, PDO::PARAM_STR);
                $sentencia->bindParam(':activa_previo', $activaPrevia, PDO::PARAM_STR);
                $sentencia->execute();
                $sql = "UPDATE entradas SET url = :url, titulo = :titulo, texto = :texto, activa = :activa WHERE id_entrada = $idPrevia";
                $sentencia = $conexion->prepare($sql);
                $urlTemp = $entrada->getUrl();
                $tituloTemp = $entrada->getTitulo();
                $textoTemp = $entrada->getTexto();
                $activaTemp = $entrada->getActiva();
                $sentencia->bindParam(':url', $urlTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':titulo', $tituloTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':texto', $textoTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':activa', $activaTemp, PDO::PARAM_STR);
                $entradaInsertada = $sentencia->execute();
                $conexion->commit();
            } catch (PDOException $ex) {
                $conexion->rollBack();
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entradaInsertada;
    }

    public static function activarEntrada($conexion, $idEntrada, $activa)
    {
        $activada = false;
        if (isset($conexion)) {
            try {
                $conexion->beginTransaction();
                $sql = "UPDATE entradas SET activa = :activa WHERE id_entrada = :idEntrada";
                $sentencia = $conexion->prepare($sql);
                $entradaTemp = $idEntrada;
                $archivarTemp = $activa;
                $sentencia->bindParam(':idEntrada', $entradaTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':activa', $archivarTemp, PDO::PARAM_STR);
                $activada = $sentencia->execute();
                $conexion->commit();
            } catch (PDOException $ex) {
                $conexion->rollBack();
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $activada;
    }

    public static function archivarEntrada($conexion, $idEntrada, $archivar)
    {
        $archivada = false;
        if (isset($conexion)) {
            try {
                $conexion->beginTransaction();
                $sql = "UPDATE entradas SET archivada = :archivar WHERE id_entrada = :idEntrada";
                $sentencia = $conexion->prepare($sql);
                $entradaTemp = $idEntrada;
                $archivarTemp = $archivar;
                $sentencia->bindParam(':idEntrada', $entradaTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':archivada', $archivarTemp, PDO::PARAM_STR);
                $archivada = $sentencia->execute();
                $conexion->commit();
            } catch (PDOException $ex) {
                $conexion->rollBack();
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $archivada;
    }

    public static function DeleteEntrada($conexion, $idEntrada)
    {
        if (isset($conexion)) {
            try {
                $conexion->beginTransaction();
                $sql = "DELETE FROM comentarios WHERE id_entrada = :id_entrada";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_entrada', $idEntrada, PDO::PARAM_STR);
                $sentencia->execute();
                $sql = "DELETE FROM entradas WHERE id_entrada = :id_entrada";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_entrada', $idEntrada, PDO::PARAM_STR);
                $sentencia->execute();
                $conexion->commit();
            } catch (PDOException $ex) {
                $conexion->rollBack();
                print 'ERROR' . $ex->getMessage();
            }
        }
    }
}
