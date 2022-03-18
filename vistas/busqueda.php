<?php
$titulo = 'Troubles time - Buscador';
$filtro = "";
$entradas = $comentarios = $autores = [];
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'app/escritorEntradas.inc.php';
include_once 'app/escritorUsuarios.inc.php';
include_once 'app/escritorComentarios.inc.php';
if (isset($_POST['texto']) && !empty($_POST['texto'])) {
    $filtro = $_POST['texto'];
    conexion::abrir_conexion();
    $entradas = RepositorioEntrada::obtenerFiltradas(Conexion::obtener_conexion(), "%" . $filtro . "%");
    $comentarios = RepositorioComentarios::obtenerFiltrados(Conexion::obtener_conexion(), "%" . $filtro . "%");
    $autores = RepositorioUsuario::obtenerFiltrados(Conexion::obtener_conexion(), "%" . $filtro . "%");
    conexion::cerrar_conexion();
}
?>
<link href="<?php echo CSS; ?>/buscador.css" rel="stylesheet">
<script>
    function toggle(boton, elemento) {
        var boton = document.getElementById(boton);
        var card = document.getElementById(elemento);
        card.style.display = boton.checked ? 'flex' : 'none';
    }
</script>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center p-3 mt-5 mb-1 bg-dark translucido text-white jumbo fz-jumbo">Buscador</div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <form class="mt-3" method="POST" action="<?php echo RUTA_BUSQUEDA ?>">
                        <input type="text" name="texto" class="textbox form-control" placeholder="Búsqueda.." minlength="4" maxlength="20" required value="<?php echo $filtro ?>">
                        <div class="sliders d-flex flex-row flex-wrap align-items-center justify-content-end mt-2 py-2">
                            <label class="switch d-flex align-items-center me-2 my-1">
                                Entradas
                                <input type="checkbox" id="chbEntradas" name="entradas" onclick="toggle('chbEntradas', 'entradas')" <?php echo (count($comentarios) || count($autores)) ? '' : 'checked' ?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="switch d-flex align-items-center me-2 my-1">
                                Comentarios
                                <input type="checkbox" id="chbComentarios" name="comentarios" onclick="toggle('chbComentarios', 'comentarios')" <?php echo count($comentarios) ? 'checked' : '' ?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="switch d-flex align-items-center me-auto my-1">
                                Autores
                                <input type="checkbox" id="chbAutores" name="autores" onclick="toggle('chbAutores', 'autores')" <?php echo count($autores) ? 'checked' : '' ?>>
                                <span class="slider round"></span>
                            </label>
                            <input type="submit" name="buscar" class="btn btn-outline-light rosa buscar my-1" value="Buscar">
                        </div>
                    </form>
                </div>
                <div class="card-body d-flex flex-wrap bg-dark-light text-white">
                    <div class="card flex-fill m-1" id="entradas" style="display: <?php echo (count($comentarios) || count($autores)) ? 'none' : 'flex' ?>;">
                        <div class="card-header bg-dark text-white text-center">
                            <h3><strong><?php echo count($entradas) != 1 ? ' ' . count($entradas) . ' entradas coinciden' : '1 entrada coincide'; ?></strong></h3>
                        </div>
                        <div class="card-body bg-dark-light text-white bs-s border-1 border-dark">
                            <?php
                            if ($entradas == "" || empty($entradas) || !isset($entradas)) {
                                include 'plantillas/busquedaVacia.inc.php';
                            } else {
                                conexion::abrir_conexion();
                                escritorEntradas::entradasFiltradas($entradas);
                                conexion::cerrar_conexion();
                            }
                            ?>
                        </div>
                    </div>
                    <div class="card flex-fill m-1" id="comentarios" style="display: none;">
                        <div class="card-header bg-dark text-white text-center">
                            <h3><strong><?php echo count($comentarios) != 1 ? ' ' . count($comentarios) . ' comentarios coinciden' : '1 comentario coincide'; ?></strong></h3>
                        </div>
                        <div class="card-body bg-dark-light text-white bs-s border-1 border-dark">
                            <?php
                            if ($comentarios == "" || empty($comentarios) || !isset($comentarios)) {
                                include 'plantillas/busquedaVacia.inc.php';
                            } else {
                                conexion::abrir_conexion();
                                escritorComentarios::comentariosFiltrados($comentarios);
                                conexion::cerrar_conexion();
                            }
                            ?>
                        </div>
                    </div>
                    <div class="card flex-fill m-1" id="autores" style="display: none;">
                        <div class="card-header bg-dark text-white text-center">
                            <h3><strong><?php echo count($autores) != 1 ? ' ' . count($autores) . ' autores coinciden' : '1 autor coincide'; ?></strong></h3>
                        </div>
                        <div class="card-body bg-dark-light text-white bs-s border-1 border-dark">
                            <?php
                            if ($autores == "" || empty($autores) || !isset($autores)) {
                                include 'plantillas/busquedaVacia.inc.php';
                            } else {
                                conexion::abrir_conexion();
                                escritorUsuarios::usuariosFiltrados($autores);
                                conexion::cerrar_conexion();
                                /*Añadir insignias, reputación o demás cosas que los diferencien entre ellos si las creo*/
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (count($comentarios))
    echo '<script type="text/javascript">toggle("chbComentarios", "comentarios");</script>';
if (count($autores))
    echo '<script type="text/javascript">toggle("chbAutores", "autores");</script>';
include_once 'plantillas/documento-cierre.inc.php';
?>