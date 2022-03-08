<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center p-1 bg-dark translucido text-white jumbo fz-jumbo my-1">General</div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-4 gg-elemento" id="g-e">
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
        <div class="col-md-4 gg-elemento" id="g-c">
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
        <div class="col-md-4 gg-elemento" id="g-f">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h2><i class="fas fa-star"></i></h2>
                    <h3>Favoritos</h3>
                </div>
                <div class="card-body bg-dark-light text-white">
                </div>
            </div>
        </div>
    </div>
</div>