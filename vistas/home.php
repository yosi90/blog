<?php

$titulo = 'Troubles time';
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'app/escritorEntradas.inc.php';
?>
<img class="logo" src="img/logoSF.png">
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center p-3 mt-5 mb-1 bg-dark translucido text-white jumbo fz-jumbo">Troubles time</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 mb-5">
            <div class="card op-90">
                <div class="card-header d-flex align-items-center bg-dark text-white py-2 ps-3 pe-4 fz-titulo">
                    <p class="flex-fill mb-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-post-fill z-titulo" viewBox="0 0 18 18">
                            <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM4.5 3h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zm0 2h7a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        Historietas
                    </p>
                    <button id="vistas" value="0" class="btn btn-no-shadow text-white p-1" title="Alternar vistas" onclick="alternarVistaEntradas()"></button>
                </div>
                <div id="contPaginacion" class="card-body bg-dark-light d-flex flex-wrap justify-content-around pt-0 pe-0 ps-0 pb-1">
                    <?php 
                        conexion::abrir_conexion(); 
                        $entradas = EscritorEntradas::entradasRecientes();
                        require_once 'plantillas/paginador.min.php'; 
                    ?>
                    <script>mostrarLista(16, 1, 'recientesEntrada');</script>
                    <?php conexion::cerrar_conexion(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-5">
            <?php
            if (controlSesion::sesion_iniciada()) {
            ?>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex bg-dark text-white rounded mb-1">
                            <a href="<?php echo RUTA_NUEVA_ENTRADA; ?>" class="btn btn-outline-light rosa flex-fill">Nueva entrada</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z" />
                            </svg>
                            Filtrar entradas
                        </div>
                        <div class="card-body bg-dark-light text-white">Aquí un motor de filtrado aun por crear</div>
                    </div>
                </div>
            </div>
            <div class="row my-1">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar2-week-fill" viewBox="0 0 16 16">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zm9.954 3H2.545c-.3 0-.545.224-.545.5v1c0 .276.244.5.545.5h10.91c.3 0 .545-.224.545-.5v-1c0-.276-.244-.5-.546-.5zM8.5 7a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM3 10.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z" />
                            </svg>
                            Entradas antiguas
                        </div>
                        <div class="card-body bg-dark-light text-white">Aquí un calendario aun por crear</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>