<?php
include_once 'app/escritorentradas.inc.php';
?>

<div class="card rounded-1">
    <div class="card-header d-flex flex-fill bg-dark text-white p-3 fz-titulo">
        <h3>Y de
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-gift-fill z-subtitulo" viewBox="0 0 16 16">
                <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zm6 4v7.5a1.5 1.5 0 0 1-1.5 1.5H9V7h6zM2.5 16A1.5 1.5 0 0 1 1 14.5V7h6v9H2.5z" />
            </svg>
            tres entradas aleatorias <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
        </h3>
    </div>
    <div class="card-body d-flex justify-content-around p-2">
        <?php
        for ($i = 0; $i < count($entradas_azar); $i++) {
            $entrada_actual = $entradas_azar[$i];
        ?>
            <div class="card text-white d-flex flex-fill max-35 m-1">
                <div class="card-header bg-dark fz-subtitulo lt-1">
                    <i class="far fa-newspaper fa-lg"></i>
                    <span>
                        <?php
                        echo $entrada_actual->getTitulo();
                        ?>
                    </span>
                </div>
                <div class="card-body bg-dark-light">
                    <div class="row">
                        <p class="text-justify lt-10">
                            <?php echo Escritorentradas::resumirTexto(nl2br($entrada_actual->getTexto()), 0); ?>
                        </p>
                    </div>
                    <div class="row">
                        <a class="btn btn-outline-light rosa fz-sm-texto" role="button" href="<?php echo RUTA_ENTRADA . '/' . $entrada_actual->getUrl() ?>">
                            <b>Parece interesante..</b>
                        </a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>