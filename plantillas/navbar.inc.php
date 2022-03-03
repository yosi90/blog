<header class="menu p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="<?php echo INDEX; ?>" class="d-flex align-items-center px-2  mb-lg-0 text-pink text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" fill="rgb(206, 143, 153)" class="bi bi-house-fill" viewBox="0 0 19 19">
                    <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                </svg>
                Troubles time
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="<?php echo RUTA_ENTRADAS ?>" class="nav-link px-2 text-white">Entradas</a></li>
                <li><a href="<?php echo RUTA_FAVORITOS ?>" class="nav-link px-2 text-white">Favoritos</a></li>
                <li><a href="<?php echo RUTA_AUTORES ?>" class="nav-link px-2 text-white">Autores</a></li>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input type="search" class="form-control form-control-dark" placeholder="Búsqueda..." aria-label="Search">
            </form>

            <div class="text-end">
                <a href="<?php echo RUTA_LOGIN ?>" class="btn btn-outline-light me-2">Login</a>
                <a href="<?php echo RUTA_REGISTRO; ?>.php" class="btn btn-outline-light rosa">Registro</a>
            </div>
        </div>
    </div>
</header>