<header id="navegador" class="navbar navbar-expand-lg p-3 navbar-dark bg-dark">
    <div class="container">
        <a href="<?php echo SERVIDOR; ?>" class="navbar-brand d-flex align-items-center px-2 mb-lg-0 text-pink text-decoration-none fw-bold">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" fill="rgb(206, 143, 153)" class="bi bi-house-fill" viewBox="0 0 19 19">
                <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
            </svg>
            Troubles time
        </a>
        <button class="navbar-toggler mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarContent" class="collapse navbar-collapse">
            <?php
            if (controlSesion::sesion_iniciada()) {
            ?>
                <ul class="navbar-nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li class="nav-item"><a href="<?php echo RUTA_GESTOR_ENTRADAS ?>" class="nav-link px-2 text-white">Entradas</a></li>
                    <li class="nav-item"><a href="<?php echo RUTA_GESTOR_FAVORITOS ?>" class="nav-link px-2 text-white">Favoritos</a></li>
                    <li class="nav-item"><a href="<?php echo RUTA_AUTORES ?>" class="nav-link px-2 text-white">Autores</a></li>
                </ul>
            <?php
            } else {
            ?>
                <div class="navbar-nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"></div>
            <?php
            }
            ?>
            <div class="navbar-nav d-flex flex-row align-items-center justify-content-end text-end">
                <form class="d-flex me-3" method="POST" action="<?php echo RUTA_BUSQUEDA ?>">
                    <div class="d-flex flex-fill flex-nowrap bg-dark-light rounded p-1">
                        <input type="search" name="texto" class="form-control form-control-dark me-1" placeholder="Búsqueda..." aria-label="Search">
                        <button type="submit" class="nobutton">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search m-2" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
                <?php
                if (controlSesion::sesion_iniciada()) {
                ?>
                        <a href="<?php echo RUTA_PERFIL ?>" class=" rounded-circle bg-gradient mx-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-bounding-box m-2" viewBox="0 0 16 16">
                                <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            </svg>
                        </a>
                        <div class="dropdown text-end">
                            <a href="#" class="btn link-pink text-decoration-none dropdown-toggle" id="ddu" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo ' ' . $_SESSION['nombre_usuario'] ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small mt-3" aria-labelledby="ddu">
                                <li><a class="dropdown-item" href="<?php echo RUTA_PERFIL ?>">Perfil</a></li>
                                <li><a class="dropdown-item" href="#">Opciones</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?php echo RUTA_GESTOR ?>">Panel de control</a></li>
                                <?php
                                if ($_SESSION['moderador'] == 1 || $_SESSION['administrador'] == 1) {
                                ?>
                                    <li><a class="dropdown-item" href="<?php echo RUTA_GESTOR_ADM ?>">Panel de Administración</a></li>
                                <?php
                                }
                                ?>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?php echo RUTA_LOGOUT ?>">Cerrar sesión</a></li>
                            </ul>
                        </div>
                <?php
                } else {
                ?>
                    <a href="<?php echo RUTA_LOGIN ?>" class="btn btn-outline-light me-2">Login</a>
                    <a href="<?php echo RUTA_REGISTRO ?>" class="btn btn-outline-light bg-rosa">Registro</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</header>