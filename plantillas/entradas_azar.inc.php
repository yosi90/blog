<?php
include_once 'app/escritorentradas.inc.php';
?>

<div class="row panel-dos">
    <hr>
    <div class="col-md-11" style="background-color: rgba(0.01, 35, 0, 0.03); margin-left: 3.5em; margin-bottom: 1em;">
        <h3>Y de <span class="glyphicon glyphicon-gift" aria-hidden="true"></span> tres entradas aleatorias <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></h3>
    </div>
    <hr style="margin-top: 8em;">
<?php
for ($i = 0; $i < count($entradas_azar); $i++)
{
    $entrada_actual = $entradas_azar[$i];
?>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>
                    <b>
                        <i class="far fa-newspaper fa-lg"></i>
                        <span class="izq">
                            <?php
                                echo $entrada_actual -> getTitulo();
                            ?> 
                            <br/>
                        </span>
                        <span class="der">
                            <?php
                                echo $entrada_actual -> getId();
                            ?>
                            <i class="fab fa-slack-hash"></i>
                        </span>
                    </b>
                </h5>
            </div>
            <div class="panel-body">
                <p class="text-justify">
                    <?php echo Escritorentradas::resumir_texto(nl2br($entrada_actual -> getTexto())); ?>
                </p>
                <br>
                <div class="text-right back">
                    <a class="btn btn-primary" role="button" href="<?php echo RUTA_ENTRADA . '/' . $entrada_actual -> getUrl() ?>">
                        <b>Parece interesante..</b>
                    </a>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
    <div class="col-md-12">
        <hr>
    </div>
</div>