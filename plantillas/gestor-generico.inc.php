<div class="container">
    <div id="jumbotron" class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center p-1 bg-dark translucido text-white jumbo fz-jumbo my-1">General</div>
        </div>
    </div>
    <div class="row text-center">
        <div id="g-e" class="col-lg-4 gg-elemento">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h2><i class="far fa-clipboard"></i></h2>
                    <h3>Entradas</h3>
                </div>
                <div class="card-body bg-dark-light text-white">
                    <h4><?php echo $entradas_activas; ?></h4>
                    <h5>Entradas publicadas</h5>
                    <br>
                    <h4><?php echo $entradas_inactivas; ?></h4>
                    <h5>Borradores</h5>
                </div>
            </div>
        </div>
        <div id="g-c" class="col-lg-4 mt-lg-0 mt-3 gg-elemento">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h2><i class="fas fa-comments"></i></h2>
                    <h3>Comentarios</h3>
                </div>
                <div class="card-body bg-dark-light text-white">
                    <h4><?php echo $comentarios; ?></h4>
                    <h5>Comentarios escritos</h5>
                </div>
            </div>
        </div>
        <div id="g-f" class="col-lg-4 my-lg-0 my-3 gg-elemento">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h2><i class="fas fa-star"></i></h2>
                    <h3>Favoritos</h3>
                </div>
                <div class="card-body bg-dark-light text-white">
                    <h4>-</h4>
                    <h5>Entradas favoritas</h5>
                    <br>
                    <h4>-</h4>
                    <h5>Autores favoritos</h5>
                </div>
            </div>
        </div>
    </div>
</div>