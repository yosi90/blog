<header class="menu p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="<?php echo SERVIDOR; ?>" class="d-flex align-items-center px-2 mb-lg-0 text-pink text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" fill="rgb(206, 143, 153)" class="bi bi-house-fill" viewBox="0 0 19 19">
                    <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                </svg>
                Troubles time
            </a>
            <?php
            if (controlSesion::sesion_iniciada()) {
            ?>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="<?php echo RUTA_GESTOR_ENTRADAS ?>" class="nav-link px-2 text-white">Entradas</a></li>
                    <li><a href="<?php echo RUTA_GESTOR_FAVORITOS ?>" class="nav-link px-2 text-white">Favoritos</a></li>
                    <li><a href="<?php echo RUTA_AUTORES ?>" class="nav-link px-2 text-white">Autores</a></li>
                </ul>
            <?php
            } else {
            ?>
                <div class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"></div>
            <?php
            }
            ?>
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input type="search" class="form-control form-control-dark" placeholder="Búsqueda..." aria-label="Search">
            </form>

            <div class="text-end">
                <?php
                if (controlSesion::sesion_iniciada()) {
                ?>
                    <div class="d-flex align-items-center col-12 col-lg-auto me-lg-auto">
                        <div class="dropdown text-end">
                            <a href="#" class="btn link-pink text-decoration-none dropdown-toggle" id="ddu" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                </svg>
                                <?php echo ' ' . $_SESSION['nombre_usuario'] ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small mt-3" aria-labelledby="ddu">
                                <li><a class="dropdown-item" href="#">Perfil</a></li>
                                <li><a class="dropdown-item" href="#">Opciones</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?php echo RUTA_GESTOR ?>">Panel de control</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?php echo RUTA_LOGOUT ?>">Cerrar sesión</a></li>
                            </ul>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <a href="<?php echo RUTA_LOGIN ?>" class="btn btn-outline-light me-2">Login</a>
                    <a href="<?php echo RUTA_REGISTRO; ?>" class="btn btn-outline-light rosa">Registro</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</header>