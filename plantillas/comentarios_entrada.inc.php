<button class="btn btn-outline-light rosa my-3" type="button" data-bs-toggle="collapse" data-bs-target="#comentarios" aria-expanded="false" aria-controls="comentarios">
    <i class="fas fa-comments fa-lg"></i>&nbsp;Comentarios&nbsp;(<?php echo count($comentarios) ?>)
</button>
<div class="collapse" id="comentarios">
    <?php
    for ($i = 0; $i < count($comentarios); $i++) {
        $comentario = $comentarios[$i];
    ?>
        <div class="row">
            <div class="card">
                <div class="card-header d-flex flex-fill flex-wrap bg-dark-light text-white p-3">
                    <div class="d-flex flex-fill">
                        <strong>
                            #<?php echo $i . " " . $comentario->getTitulo(); ?>
                        </strong>
                    </div>
                    <p class="d-flex m-0">
                        <?php echo $comentario->getFecha() ?>
                    </p>
                </div>
                <div class="card-body d-flex flex-fill flex-wrap">
                    <div class="col-md-2 columna_user">
                        <?php echo $comentario->getAutor(); ?>
                    </div>
                    <div class="col-md-10">
                        <p class="text-justify m-0 p-2">
                            <?php echo nl2br($comentario->getTexto()); ?>
                        </p>
                    </div>
                </div>
                <?php
                    include 'plantillas/wysiwyg.inc.php';
                ?>
            </div>
        </div>
    <?php
        }
    ?>
</div>