<?php
    $titulo = "Yosilando";
    include_once 'plantillas/base.inc.php';
    include_once 'app/escritorEntradas.inc.php';
    include_once 'app/fondo_dinamico.inc.php';
?>

<div class="container-fluid" >
    <div class="jumbotron"style=" color: <?php echo $color ?>; background: <?php echo $fondo ?>) no-repeat center center fixed;-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
        <h1>
            Yosilando
        </h1>
        <p>
            <h3>
                Demostración de conocimientos
            </h3>
            <br>
            <br>
        </p>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>
                                        <i class="fas fa-search fa-lg"></i> Búsqueda
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input type="search" class="form-control" placeholder="Busqueda">
                                    </div>
                                    <button class="form-control">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Filtraso
                                </div>
                                <div class="panel-body">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="far fa-calendar-alt fa-2x"></i>  Entradas antiguas
                                </div>
                                <div class="panel-body">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 pd">
                    <?php
                        escritorEntradas::escribir_entradas();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>    
<?php
include_once 'plantillas/footer.inc.php';