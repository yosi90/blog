<?php
include_once 'config.inc.php';
include_once 'conexion.inc.php';
include_once 'entrada.inc.php';
include_once 'purificador.inc.php';

class repositorioEntrada
{

    public static function getEntrada($conexion, $idEntrada)
    {
        $entrada = null;
        if (isset($conexion)) {
            try {
                $sql = 'SELECT e.id_entrada, u.nombre, ue.id_usuario, e.url, e.titulo, e.texto, e.fecha, e.activa, e.archivada, e.bloqueada' .
                ' FROM entradas e INNER JOIN usuario_entradas ue on e.id_entrada = ue.id_entrada inner join usuarios u on ue.id_usuario = u.id_usuario'.
                ' WHERE e.id_entrada = :idEntrada ORDER BY fecha DESC';
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':idEntrada', $idEntrada, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $entrada = new entrada($resultado['id_entrada'], $resultado['nombre'], $resultado['id_usuario'], $resultado['url'], html_entity_decode($resultado['titulo'], ENT_QUOTES, 'UTF-8'), $resultado['texto'], $resultado['fecha'], $resultado['activa'], $resultado['archivada'], $resultado['bloqueada']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entrada;
    }

    public static function totalEntradas($conexion, $archivada = 0, $bloqueada = 0)
    {
        if (isset($conexion)) {
            try {
                $sql = 'SELECT id_entrada FROM entradas WHERE archivada = :archivada and bloqueada = :bloqueada';
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':archivada', $archivada, PDO::PARAM_STR);
                $sentencia->bindParam(':bloqueada', $bloqueada, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                return count($resultado);
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return 0;
    }

    public static function obtenerRecientes($conexion)
    {
        $entradas = [];
        if (isset($conexion)) {
            try {
                $sql = 'SELECT e.id_entrada, u.nombre, ue.id_usuario, e.url, e.titulo, e.texto, e.fecha, e.activa, e.archivada, e.bloqueada' .
                    ' FROM entradas e INNER JOIN usuario_entradas ue on e.id_entrada = ue.id_entrada inner join usuarios u on ue.id_usuario = u.id_usuario' .
                    ' WHERE e.activa = 1 and e.archivada = 0 and e.bloqueada = 0 ORDER BY fecha DESC';
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $instance = new entrada($fila['id_entrada'], $fila['nombre'], $fila['id_usuario'], $fila['url'], html_entity_decode($fila['titulo'], ENT_QUOTES, 'UTF-8'), $fila['texto'], $fila['fecha'], $fila['activa']);
                        $entradas[] = $instance->getArray();
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $entradas;
    }

    public static function obtenerFiltradas($conexion, $filtro)
    {
        $entradas = [];
        if (isset($conexion)) {
            try {
                $sql = 'SELECT e.id_entrada, u.nombre, ue.id_usuario, e.url, e.titulo, e.texto, e.fecha, e.activa, e.archivada, e.bloqueada' .
                    ' FROM entradas e INNER JOIN usuario_entradas ue on e.id_entrada = ue.id_entrada inner join usuarios u on ue.id_usuario = u.id_usuario' .
                    ' WHERE (texto like :filtro or titulo like :filtro) and (activa = 1 and archivada = 0 and bloqueada = 0) ORDER BY fecha';
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':filtro', $filtro, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas[] = new entrada($fila['id_entrada'], $fila['nombre'], $fila['id_usuario'], $fila['url'], html_entity_decode($fila['titulo'], ENT_QUOTES, 'UTF-8'), $fila['texto'], $fila['fecha'], $fila['activa']);
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
                $sql = "SELECT e.id_entrada, u.nombre, ue.id_usuario, e.url, e.titulo, e.texto, e.fecha, e.activa, e.archivada, e.bloqueada FROM entradas e inner join usuario_entradas ue on e.id_entrada = ue.id_entrada inner join usuarios u on ue.id_usuario = u.id_usuario WHERE e.url = :url";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $entrada = new entrada($resultado['id_entrada'], $resultado['nombre'], $resultado['id_usuario'], $resultado['url'], html_entity_decode($resultado['titulo'], ENT_QUOTES, 'UTF-8'), $resultado['texto'], $resultado['fecha'], $resultado['activa'], $resultado['archivada'], $resultado['bloqueada']);
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

    public static function entradasAleatorias($conexion, $limite)
    {
        $entradas = [];
        if (isset($conexion)) {
            try {
                $sql = 'SELECT e.id_entrada, u.nombre, ue.id_usuario, e.url, e.titulo, e.texto, e.fecha, e.activa, e.archivada, e.bloqueada' .
                    ' FROM entradas e INNER JOIN usuario_entradas ue on e.id_entrada = ue.id_entrada inner join usuarios u on ue.id_usuario = u.id_usuario' .
                    ' WHERE archivada = 0 and bloqueada = 0 ORDER BY RAND() LIMIT ' . $limite;
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas[] = new entrada($fila['id_entrada'], $fila['nombre'], $fila['id_usuario'], $fila['url'], html_entity_decode($fila['titulo'], ENT_QUOTES, 'UTF-8'), $fila['texto'], $fila['fecha'], $fila['activa']);
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entradas;
    }

    public static function entradas_usr($conexion, $id_usuario, $activa)
    {
        $total = 0;
        if (isset($conexion)) {
            try {
                $sql = 'SELECT count(*) AS total FROM entradas e inner join usuario_entradas ue on e.id_entrada = ue.id_entrada inner join usuarios u on ue.id_usuario = u.id_usuario WHERE u.id_usuario = :id_usuario and activa = :activa and archivada = 0 and bloqueada = 0';
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
                $sentencia->bindParam(':activa', $activa, PDO::PARAM_STR);
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

    public static function entradasUsuario($conexion, $id_usuario, $archivada = 0, $bloqueada = 0)
    {
        $entradas = [];
        $archivo = " and e.archivada = :archivada ";
        if ($archivada == 1)
            $archivo = "";
        $bloqueo = " and e.bloqueada = :bloqueada ";
        if ($bloqueada == 1)
            $bloqueo = "";
        if (isset($conexion)) {
            try {
                $sql = 'SELECT e.id_entrada, u.nombre, ue.id_usuario, e.url, e.titulo, e.texto, e.fecha, e.activa, e.archivada, e.bloqueada, COUNT(ec.id_comentario) AS "cantidad_comentarios"' .
                    ' FROM entradas e inner join usuario_entradas ue on e.id_entrada = ue.id_entrada inner join usuarios u on ue.id_usuario = u.id_usuario LEFT JOIN entrada_comentarios ec ON e.id_entrada = ec.id_entrada' .
                    ' WHERE ue.id_usuario = :id_usuario' . $archivo . $bloqueo . 'GROUP BY e.id_entrada ORDER BY e.fecha DESC';
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
                if ($archivo != "")
                    $sentencia->bindParam(':archivada', $archivada, PDO::PARAM_STR);
                if ($bloqueo != "")
                    $sentencia->bindParam(':bloqueada', $bloqueada, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $instance = new entrada($fila['id_entrada'], $fila['nombre'], $fila['id_usuario'], $fila['url'], html_entity_decode($fila['titulo'], ENT_QUOTES, 'UTF-8'), $fila['texto'], $fila['fecha'], $fila['activa'], $fila['archivada'], $fila['bloqueada'], $fila['cantidad_comentarios']);
                        $entradas[] = $instance->getArray();
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entradas;
    }

    public static function totalUsuario($conexion, $id_usuario, $archivada = 0, $bloqueada = 0)
    {
        if (isset($conexion)) {
            try {
                $sql = 'SELECT e.id_entrada FROM entradas e inner join usuario_entradas ue on e.id_entrada = ue.id_entrada WHERE ue.id_usuario = :id_usuario and e.archivada = :archivada and e.bloqueada = :bloqueada GROUP BY e.id_entrada';
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
                $sentencia->bindParam(':archivada', $archivada, PDO::PARAM_STR);
                $sentencia->bindParam(':bloqueada', $bloqueada, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                return count($resultado);
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return 0;
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

    public static function insertar_entrada($conexion, $url, $titulo, $texto, $activa = 1, $archivada = 0, $bloqueada = 0, $id_usuario = null)
    {
        $titulo = purifier::purifier($titulo, 'titulo');
        $texto = purifier::purifier($texto, 'texto');
        $entrada_insertada = false;
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO entradas (url, titulo, texto, fecha, activa, archivada, bloqueada) VALUES (:url, :titulo, :texto, NOW(), :activa, :archivada, :bloqueada)";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $sentencia->bindParam(':texto', $texto, PDO::PARAM_STR);
                $sentencia->bindParam(':activa', $activa, PDO::PARAM_STR);
                $sentencia->bindParam(':archivada', $archivada, PDO::PARAM_STR);
                $sentencia->bindParam(':bloqueada', $bloqueada, PDO::PARAM_STR);
                $entrada_insertada = $sentencia->execute();
                if ($id_usuario != null) {
                    $sql = "SELECT id_entrada FROM entradas WHERE url = :url";
                    $sentencia = $conexion->prepare($sql);
                    $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
                    $sentencia->execute();
                    $id_entrada = $sentencia->fetch();
                    $sql = "INSERT INTO usuario_entradas VALUES (:id_usuario, :id_entrada)";
                    $sentencia = $conexion->prepare($sql);
                    $sentencia->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
                    $sentencia->bindParam(':id_entrada', $id_entrada['id_entrada'], PDO::PARAM_STR);
                    $sentencia->execute();
                }
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
                $sql = "INSERT INTO entradas_ediciones (id_entrada, url, titulo, texto, fecha, activa) VALUES (:id_entrada, :url_, :titulo_previo, :texto_previo, NOW(), :activa_previo)";
                $sentencia = $conexion->prepare($sql);
                $idPrevia = $entradaPrevia->getId_entrada();
                $urlPrevia = $entradaPrevia->getUrl();
                $tituloPrevio = $entradaPrevia->getTitulo();
                $textoPrevio = $entradaPrevia->getTexto();
                $activaPrevia = $entradaPrevia->getActiva();
                $sentencia->bindParam(':id_entrada', $idPrevia, PDO::PARAM_STR);
                $sentencia->bindParam(':url_', $urlPrevia, PDO::PARAM_STR);
                $sentencia->bindParam(':titulo_previo', $tituloPrevio, PDO::PARAM_STR);
                $sentencia->bindParam(':texto_previo', $textoPrevio, PDO::PARAM_STR);
                $sentencia->bindParam(':activa_previo', $activaPrevia, PDO::PARAM_STR);
                $sentencia->execute();
                $sql = "UPDATE entradas SET url = :url, titulo = :titulo, texto = :texto, activa = :activa WHERE id_entrada = $idPrevia";
                $sentencia = $conexion->prepare($sql);
                $urlTemp = $entrada->getUrl();
                $activaTemp = $entrada->getActiva();
                $sentencia->bindParam(':url', $urlTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':titulo', purifier::purifier($entrada->getTitulo(), 'titulo'), PDO::PARAM_STR);
                $sentencia->bindParam(':texto', purifier::purifier($entrada->getTexto(), 'texto'), PDO::PARAM_STR);
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

    public static function bloquearEntrada($conexion, $idEntrada, $bloquear)
    {
        $bloqueada = false;
        if (isset($conexion)) {
            try {
                $conexion->beginTransaction();
                $sql = "UPDATE entradas SET bloqueada = :bloquear WHERE id_entrada = :idEntrada";
                $sentencia = $conexion->prepare($sql);
                $entradaTemp = $idEntrada;
                $bloquearTemp = $bloquear;
                $sentencia->bindParam(':idEntrada', $entradaTemp, PDO::PARAM_STR);
                $sentencia->bindParam(':bloquear', $bloquearTemp, PDO::PARAM_STR);
                $bloqueada = $sentencia->execute();
                $conexion->commit();
            } catch (PDOException $ex) {
                $conexion->rollBack();
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $bloqueada;
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

    public static function crearUrl($titulo)
    {
        if (isset($titulo) && !empty($titulo)) {
            $partes_url = explode(' ', $titulo);
            $url = "";
            if (count($partes_url) > 1) {
                for ($cont = 0; $cont < count($partes_url); $cont++) {
                    $url .= $partes_url[$cont];
                    $url = (($cont + 1) != count($partes_url) ? "{$url}-" : $url);
                }
            } else {
                $url = $partes_url[0];
            }
            return $url;
        }
        return '';
    }
}
