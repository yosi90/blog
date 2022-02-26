<!DOCTYPE html>
<?php
$titulo = 'Troubles time';
include_once 'plantillas/documento-declaracion.inc.php';
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div /*class="jumbotron" */ class="my-5 d-flex justify-content-center p-5 rounded bg-dark bg-opacity-75 text-white jumbo">Troubles time</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 mb-5">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-file-post-fill" viewBox="0 0 18 18">
                            <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM4.5 3h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zm0 2h7a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        Historietas</h3>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="card-body">
                            <h5 class="card-title">Como conocí a vuestra perra</h5>
                            <p class="card-text">Un perro le narra a sus cachorros como conoció a la perra de su madre.
                            </p>
                            <a href="#" class="btn btn-primary bg-dark text-white">Ver completa</a>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="card-body">
                            <h5 class="card-title">Breaking good</h5>
                            <p class="card-text">Unos tios venden tremendas clenchas y tienen cancer.
                            </p>
                            <a href="#" class="btn btn-primary bg-dark text-white">Ver completa</a>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="card-body">
                            <h5 class="card-title">Unfriends</h5>
                            <p class="card-text">Un grupo de idiotas hacen como que no se odian.
                            </p>
                            <a href="#" class="btn btn-primary bg-dark text-white">Ver completa</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z" />
                            </svg>
                            Filtrar entradas
                        </div>
                        <div class="card-body">Aquí un motor de filtrado aun por crear</div>
                    </div>
                </div>
            </div>
            <div class="row my-1">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
                                <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z" />
                            </svg>
                            Archivo
                        </div>
                        <div class="card-body">Aquí un calendario aun por crear</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>