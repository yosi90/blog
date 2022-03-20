<?php
header($_SERVER['SERVER_PROTOCOL'] . "404 Not Found", true, 404);
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'app/largate.inc.php';
?>
<div class="container pt-4">
    <div class="card bg-dark text-white">
        <div class="d-flex flex-wrap card-header fz-jumbo">
            <div class="flex-fill">
                Error catatrófeco
            </div>
            <div>
                <a href="<?php echo SERVIDOR ?>" class="btn btn-outline-light rosa fz-titulo">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="rgb(206, 143, 153)" class="bi bi-house-fill z-titulo" viewBox="0 0 19 19">
                        <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                    </svg>
                    Volvamo a casa..
                </a>
            </div>
        </div>
        <div class="card-body">
            <a href="<?php echo SERVIDOR ?>">
                <div style="background: <?php echo $imagen ?> no-repeat center center; -webkit-background-size: auto 100%; -moz-background-size: auto 100%; -o-background-size: auto 100%; background-size: auto 100%;height: 60vh;"></div>
            </a>
        </div>
    </div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
