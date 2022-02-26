<div class="row">
    <div class="col-md-12">
        <button class="btn form-control" data-toggle="collapse" data-target="#comentarios">
            <i class="fas fa-comments fa-lg"></i>
            Comentarios 
        </button>
        <br>
        <br>
        <div id="comentarios" class="collapse">
            <?php
            for ($i = 0; $i < count($comentarios); $i++) 
            {
                $comentario = $comentarios[$i];
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php echo $comentario->getTitulo(); ?>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-2 columna_user">
                                    <?php echo $comentario->getId_autor(); ?>
                                </div>
                                <div class="col-md-10">
                                    <p class="text-right">
                                        <?php echo $comentario->getFecha() ?>
                                    </p>
                                    <br>
                                    <p class="text-justify">
                                        <?php echo nl2br($comentario->getTexto()); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                include 'plantillas/wysiwyg.inc.php';
            }
            ?>
        </div>
    </div>
</div>