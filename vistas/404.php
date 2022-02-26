<?php
header($_SERVER['SERVER_PROTOCOL'] . "404 Not Found", true, 404);
include_once 'plantillas/base.inc.php';
include_once 'app/fondo_dinamico.inc.php';
include_once 'app/largate.inc.php';
?>
<div class="container-fluid" >
    <div class="jumbotron"style=" color: <?php echo $color ?>; background: <?php echo $fondo ?>) no-repeat center center fixed;-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <h1>
                        Error catastrófico
                    </h1>
                    <p>
                    <h3>
                        <a href="<?php echo SERVIDOR ?>" style="color: <?php echo $color ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>  Volvamos a casa..</a>
                    </h3>
                    <br>
                    <br>
                    </p>
                </div>
                <div class="col-md-9">
                    <div class="jumbotron" style=" background: <?php echo $imagen ?>) no-repeat center center; -webkit-background-size: 100% 100%; -moz-background-size: 100% 100%; -o-background-size: 100% 100%; background-size: 100% 100%;">
                        <div class="container push-spaces">
                            <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include_once 'plantillas/footer.inc.php';