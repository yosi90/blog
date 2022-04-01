<?php
$titulo = 'Troubles time - Buscador';
$filtro = "";
$entradas = "0";
$comentarios = $autores = [];
include_once 'plantillas/documento-declaracion.inc.php';
if (isset($_POST['texto']) && !empty($_POST['texto'])) {
    $filtro = $_POST['texto'];
    conexion::abrir_conexion();
    $entradas = RepositorioEntrada::getCountFiltered(Conexion::obtener_conexion(), "%" . $filtro . "%");
    $comentarios = RepositorioComentario::getCountFiltered(Conexion::obtener_conexion(), "%" . $filtro . "%");
    $autores = RepositorioUsuario::getCountFiltered(Conexion::obtener_conexion(), "%" . $filtro . "%");
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
                                <input type="checkbox" id="chbEntradas" name="entradas" onclick="toggle('chbEntradas', 'entradas')" <?php echo ($entradas !== 0  || ($comentarios === 0 && $autores === 0)) ? 'checked' : '' ?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="switch d-flex align-items-center me-2 my-1">
                                Comentarios
                                <input type="checkbox" id="chbComentarios" name="comentarios" onclick="toggle('chbComentarios', 'comentarios')" <?php echo $comentarios !== 0 ? 'checked' : '' ?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="switch d-flex align-items-center me-auto my-1">
                                Autores
                                <input type="checkbox" id="chbAutores" name="autores" onclick="toggle('chbAutores', 'autores')" <?php echo $autores !== 0 ? 'checked' : '' ?>>
                                <span class="slider round"></span>
                            </label>
                            <input type="submit" name="buscar" class="btn btn-outline-light rosa buscar my-1" value="Buscar">
                        </div>
                    </form>
                </div>
                <div class="card-body d-flex flex-wrap bg-dark-light text-white">
                    <div class="card flex-fill m-1" id="entradas" style="display: <?php echo ($comentarios !== 0 || $autores !== 0) ? 'none' : 'flex' ?>;">
                        <div class="card-header bg-dark text-white text-center">
                            <h3><strong><?php echo $entradas != 1 ? ' ' . $entradas . ' entradas coinciden' : '1 entrada coincide'; ?></strong></h3>
                        </div>
                        <div id="contPaginacionE" class="card-body bg-dark-light text-white bs-s border-1 border-dark">
                            <?php
                                if ($entradas === 0)
                                    include 'plantillas/busquedaVacia.inc.php';
                            ?>
                        </div>
                    </div>
                    <div class="card flex-fill m-1" id="comentarios" style="display: none;">
                        <div class="card-header bg-dark text-white text-center">
                            <h3><strong><?php echo $comentarios !== 1 ? ' ' . $comentarios . ' comentarios coinciden' : '1 comentario coincide'; ?></strong></h3>
                        </div>
                        <div id="contPaginacionC" class="card-body bg-dark-light text-white bs-s border-1 border-dark">
                            <?php
                                if ($comentarios === 0)
                                    include 'plantillas/busquedaVacia.inc.php';
                            ?>
                        </div>
                    </div>
                    <div class="card flex-fill m-1" id="autores" style="display: none;">
                        <div class="card-header bg-dark text-white text-center">
                            <h3><strong><?php echo $autores !== 1 ? ' ' . $autores . ' autores coinciden' : '1 autor coincide'; ?></strong></h3>
                        </div>
                        <div id="contPaginacionU" class="card-body bg-dark-light text-white bs-s border-1 border-dark">
                            <?php
                                if ($autores === 0)
                                    include 'plantillas/busquedaVacia.inc.php';
                            ?>
                            <!-- ordenar según insignias, reputación o demás cosas que los diferencien entre ellos -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ($entradas !== 0)
    echo '<script type="text/javascript">toggle("chbEntradas", "entradas");</script>';
if ($comentarios !== 0)
    echo '<script type="text/javascript">toggle("chbComentarios", "comentarios");</script>';
if ($autores !== 0)
    echo '<script type="text/javascript">toggle("chbAutores", "autores");</script>';
include_once 'plantillas/documento-cierre.inc.php';
?>
<input id="tipoE" type="hidden" value="busqueda">
<input id="tipoC" type="hidden" value="busquedaC">
<input id="tipoU" type="hidden" value="busquedaU">
<input id="filtro" type="hidden" value="<?php echo $filtro ?>">
<script type="module" src="<?php echo CLASES; ?>paginadorEntradas.js"></script>
<script type="module" src="<?php echo CLASES; ?>paginadorComentarios.js"></script>
<script type="module" src="<?php echo CLASES; ?>paginadorUsuarios.js"></script>