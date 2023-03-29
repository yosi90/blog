<?php
if (isset($entrada)) {
    $titulo = 'Troubles time - ' . $entrada->getTitulo();
}
require_once 'plantillas/documento-declaracion.inc.php';
require_once 'app/entrada.inc.php';
require_once 'app/comentario.inc.php';
require_once 'app/usuario.inc.php';
require_once 'app/RepositorioEntrada.inc.php';
require_once 'app/RepositorioComentario.inc.php';
?>
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card rounded">
                <div class="card-header d-flex flex-fill bg-dark text-white p-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h1 class="d-flex flex-fill"><i class="far fa-newspaper fa-2x">&nbsp;</i><?php echo '    <u>' . $entrada->getTitulo() . '</u>'; ?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-12"></div>
                            <div class="col-sm-8 col-12 d-flex justify-content-end align-content-end">
                                <p class="mb-0">
                                    <i class="fa-solid fa-user"></i>
                                    <a href="<?php echo RUTA_AUTORES . '/' . $entrada->getAutor(); ?>">
                                        <?php echo $entrada->getAutor(); ?>
                                    </a>
                                </p>
                                <P class="d-flex align-items-center fz-sm-texto mb-0">
                                    <?php
                                    echo iconv('ISO-8859-2', 'UTF-8', strftime("&nbsp; %d / %B / %Y a las %H:%M:%S", strtotime($entrada->getFecha())));
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-dark-light text-white p-3">
                    <div class="col-md-12 text-justify">
                        <article class="fz-texto">
                            <?php
                            echo nl2br($entrada->getTexto());
                            ?>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row translucido">
        <div class="col-12">
            <div class="bg-dark-light pt-5 pb-3 px-4">
                <?php
                if (count($comentarios) > 0) {
                    include_once 'plantillas/comentarios_entrada.inc.php';
                } else {
                ?>
                    <button class="btn btn-outline-light w-100 bg-rosa" type="button" data-bs-toggle="collapse" data-bs-target="#comentarios" aria-expanded="false" aria-controls="comentarios">
                        <i class="fas fa-comments fa-lg"></i>&nbsp;Se el primero en comentar&nbsp;<i class="fas fa-comments fa-lg"></i>
                    </button>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <?php
            include_once 'plantillas/entradas_azar.inc.php';
            ?>
        </div>
    </div>
</div>
<?php
if (isset($_POST['busqueda'])) {
    echo '<script type="text/javascript" src="' . JS . 'scroll.js"></script>';
    echo '<script type="text/javascript">
        document.getElementById("desplegarComentarios").click();
        </script>';
    echo '<script type="text/javascript">
        scroll("' . $_POST['posicion'] . '");
        </script>';
}
include_once 'plantillas/documento-cierre.inc.php';
?>