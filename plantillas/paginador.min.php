<script>
    let paginActual; //utilizar esta variable para navegar con los botones de previa y siguiente.
    let lista = <?php echo $entradas ?>;
    let filas, tipo;
    let nomcontenedor, nomPaginador;
    let contenedor, contenedorPaginacion;

    function mostrarLista(rows, actual, type, contenedorelementos = "contPaginacion", contenedorPaginador = "contPaginacion") {
        paginActual = actual;
        filas = rows;
        tipo = type;
        nomcontenedor = contenedorelementos;
        nomPaginador = contenedorPaginador;
        actual--;
        contenedor = document.getElementById(nomcontenedor);
        contenedor.innerHTML = "";
        let start = rows * actual;
        let end = start + rows;
        let itemsPaginados = lista.slice(start, end);
        itemsPaginados.forEach(e => {
            switch (type) {
                case 'recientesEntrada':
                    contenedor.appendChild(crearEntradaBasica(e));
                    break;
                case 'tablaEntrada':
                    contenedor.appendChild(crearEntradaTabla(e));
                    break;
                default:
                    break;
            }
        });
        if (lista.length > rows) {
            contenedorPaginacion = document.getElementById(nomPaginador);
            if (contenedor != contenedorPaginacion)
                contenedorPaginacion.innerHTML = "";
            crearPaginador();
        }
    }

    function crearEntradaBasica(element) {
        let mw = document.getElementById("vistas");
        let carta = document.createElement("div");
        ['card', 'flex-fill', 'sizeControl', 'm-1', mw.value == '1' ? 'mw-100' : (mw.value == '2' ? 'mw-50' : 'mw-25')].forEach(className => {
            carta.classList.add(className);
        });
        let cabeceraCarta = document.createElement("div");
        ['card-header', 'd-flex', 'bg-secondary', 'text-white', 'h-100'].forEach(className => {
            cabeceraCarta.classList.add(className);
        });
        carta.appendChild(cabeceraCarta);
        let enlace = document.createElement("a");
        ['btn', 'btn-outline-light', 'fz-sm-texto', 'flex-fill'].forEach(className => {
            enlace.classList.add(className);
        });
        enlace.setAttribute("role", "button");
        enlace.setAttribute("href", '/blog/entrada/' + element.url); //URL
        cabeceraCarta.appendChild(enlace);
        let container = document.createElement("div");
        ['d-flex', 'flex-wrap'].forEach(className => {
            container.classList.add(className);
        });
        enlace.appendChild(container);
        let negrita = document.createElement("strong");
        ['flex-fill', 'text-start', 'fz-subtitulo', 'lt-2'].forEach(className => {
            negrita.classList.add(className);
        });
        negrita.innerText = element.titulo; //TITULO
        container.appendChild(negrita);
        let parrafo = document.createElement("p");
        ['flex-fill', 'align-self-end', 'text-end', 'fz-texto', 'm-0', 'pt-1'].forEach(className => {
            parrafo.classList.add(className);
        });
        parrafo.innerText = (new Date(element.fecha)).toLocaleDateString('es-es', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        }); //FECHA
        container.appendChild(parrafo);
        return carta;
    }

    function crearEntradaTabla(element) {
        let tr = document.createElement("tr");
        let titulo = document.createElement("td");
        titulo.title = element.titulo;
        let enlaceTitulo = document.createElement("a");
        ['text-decoration-none', 'text-white'].forEach(className => {
            enlaceTitulo.classList.add(className);
        });
        enlaceTitulo.href = "<?php echo RUTA_ENTRADA; ?>/" + element.url;
        titulo.appendChild(enlaceTitulo);
        let parrafoTitulo = document.createElement("p");
        ['lt-linea-200', 'mb-0', 'text-start'].forEach(className => {
            parrafoTitulo.classList.add(className);
        });
        parrafoTitulo.innerText = element.titulo;
        enlaceTitulo.appendChild(parrafoTitulo);
        tr.appendChild(titulo);
        let fecha = document.createElement("td");
        fecha.innerText = (new Date(element.fecha)).toLocaleDateString('es-es', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });
        tr.appendChild(fecha);
        let activa = document.createElement("td");
        tr.appendChild(activa);
        let formActivar = document.createElement("form");
        formActivar.method = "POST";
        formActivar.action = "<?php echo RUTA_ACTIVAR_ENTRADA; ?>";
        activa.appendChild(formActivar);
        let submitActiva = document.createElement("input");
        submitActiva.type = "submit";
        submitActiva.name = "toggle";
        ['btnmimic', 'mx-1'].forEach(className => {
            submitActiva.classList.add(className);
        });
        let activo = document.createElement("input");
        activo.type = "hidden";
        activo.name = "activo";
        if (element.activa) {
            submitActiva.value = "Publicada";
            submitActiva.classList.add("green");
            activo.value = "0";
        } else {
            submitActiva.value = "Borrador";
            submitActiva.classList.add("red");
            activo.value = "1";
        }
        let idEntrada = document.createElement("input");
        idEntrada.type = "hidden";
        idEntrada.name = "IdEntrada";
        idEntrada.value = element.id_entrada;
        let idAutor = document.createElement("input");
        idAutor.type = "hidden";
        idAutor.name = "IdAutor";
        idAutor.value = element.id_autor;
        formActivar.appendChild(submitActiva);
        formActivar.appendChild(activo);
        formActivar.appendChild(idEntrada);
        formActivar.appendChild(idAutor);
        let cantComent = document.createElement("td");
        cantComent.innerText = element.cantComentarios;
        tr.appendChild(cantComent);
        let botonera = document.createElement("td");
        botonera.classList.add("d-flex");
        botonera.classList.add("justify-content-center");
        tr.appendChild(botonera);
        let formEditar = document.createElement("form");
        formEditar.method = "POST";
        formEditar.action = "<?php echo RUTA_EDITAR_ENTRADA; ?>";
        botonera.appendChild(formEditar);
        let submitEditar = document.createElement("button");
        ['btn', 'btn-outline-light', 'mx-1'].forEach(className => {
            submitEditar.classList.add(className);
        });
        submitEditar.type = "submit";
        submitEditar.name = "edit";
        submitEditar.value = "edit";
        submitEditar.innerText = "Editar";
        let idEntrada2 = document.createElement("input");
        idEntrada2.type = "hidden";
        idEntrada2.name = "IdEntrada";
        idEntrada2.value = element.id_entrada;
        formEditar.appendChild(submitEditar);
        formEditar.appendChild(idEntrada2);
        let formArchivar = document.createElement("form");
        formArchivar.method = "POST";
        formArchivar.action = "<?php echo RUTA_ARCHIVAR_ENTRADA; ?>";
        botonera.appendChild(formArchivar);
        let submitArchivar = document.createElement("button");
        ['btn', 'btn-outline-light', 'mx-1'].forEach(className => {
            submitArchivar.classList.add(className);
        });
        submitArchivar.type = "submit";
        submitArchivar.name = "archive";
        submitArchivar.value = "archive";
        submitArchivar.innerText = "Archivar";
        let idEntrada3 = document.createElement("input");
        idEntrada3.type = "hidden";
        idEntrada3.name = "IdEntrada";
        idEntrada3.value = element.id_entrada;
        let idAutor3 = document.createElement("input");
        idAutor3.type = "hidden";
        idAutor3.name = "IdAutor";
        idAutor3.value = element.id_autor;
        formArchivar.appendChild(submitArchivar);
        formArchivar.appendChild(idEntrada3);
        formArchivar.appendChild(idAutor3);
        let archivo = document.createElement("input");
        archivo.type = "hidden";
        archivo.name = "archivo";
        archivo.value = "1";
        formArchivar.appendChild(archivo);
        <?php
        if (controlSesion::sesion_iniciada()) {
        ?>
            let mod = "<?php echo $_SESSION['moderador'] ?>";
            let adm = "<?php echo $_SESSION['administrador'] ?>";
        <?php
        }
        ?>
        let formBloquear = document.createElement("form");
        formBloquear.method = "POST";
        if (mod == 1 || adm == 1)
            formBloquear.action = "<?php echo RUTA_BLOQUEAR_ENTRADA; ?>";
        botonera.appendChild(formBloquear);
        let submitBloquear = document.createElement("input");
        submitBloquear.type = "submit";
        submitBloquear.name = "bloquear";
        ['btnmimic', 'mx-1'].forEach(className => {
            submitBloquear.classList.add(className);
        });
        let bloqueo = document.createElement("input");
        bloqueo.type = "hidden";
        bloqueo.name = "bloqueo";
        if (element.bloqueada) {
            submitBloquear.value = "Bloqueada";
            submitBloquear.classList.add("red");
            bloqueo.value = "0";
        } else {
            submitBloquear.value = "Activa";
            submitBloquear.classList.add("green");
            bloqueo.value = "1";
        }
        let idEntrada4 = document.createElement("input");
        idEntrada4.type = "hidden";
        idEntrada4.name = "IdEntrada";
        idEntrada4.value = element.id_entrada;
        let idAutor4 = document.createElement("input");
        idAutor4.type = "hidden";
        idAutor4.name = "IdAutor";
        idAutor4.value = element.id_autor;
        formBloquear.appendChild(submitBloquear);
        formBloquear.appendChild(bloqueo);
        formBloquear.appendChild(idEntrada4);
        formBloquear.appendChild(idAutor4);
        if (adm == 1) {
            let formBorrar = document.createElement("form");
            formBorrar.method = "POST";
            formBorrar.action = "<?php echo RUTA_BORRAR_ENTRADA; ?>";
            formBorrar.onsubmit = "return confirm('Confirma que deseas borrar esta entrada');";
            botonera.appendChild(formBorrar);
            let submitBorrar = document.createElement("button");
            submitBorrar.type = "submit";
            submitBorrar.name = "delete";
            submitBorrar.innerText = "Borrar";
            ['btn', 'btn-outline-light', 'mx-1'].forEach(className => {
                submitBorrar.classList.add(className);
            });
            let idEntrada5 = document.createElement("input");
            idEntrada5.type = "hidden";
            idEntrada5.name = "IdEntrada";
            idEntrada5.value = element.id_entrada;
            let idAutor5 = document.createElement("input");
            idAutor5.type = "hidden";
            idAutor5.name = "IdAutor";
            idAutor5.value = element.id_autor;
            formBorrar.appendChild(submitBorrar);
            formBorrar.appendChild(idEntrada5);
            formBorrar.appendChild(idAutor5);
        }
        return tr;
    }

    function crearPaginador() {
        let paginador;
        let div = document.createElement("div");
        ['rounded', 'fz-texto', 'py-1', 'px-3'].forEach(className => {
            div.classList.add(className);
        });
        contenedorPaginacion.appendChild(div);
        let strong = document.createElement("strong");
        div.appendChild(strong);
        paginador = document.createElement("span");
        paginador.classList.add("navigation");
        paginador.id = "navigation";
        strong.appendChild(paginador);
        cantPag = Math.ceil(lista.length / filas);
        if (cantPag > 8)
            paginador.appendChild(crearEnlace('<', paginActual != 1));
        paginador.appendChild(crearEnlace(1, paginActual != 1));
        var start, end;
        if (paginActual < 5 && cantPag > 8) {
            start = 2;
            end = 6;
        } else if (paginActual + 3 >= cantPag && cantPag > 8) {
            start = cantPag - 4;
            end = cantPag;
        } else if (cantPag <= 8) {
            start = 2;
            end = cantPag;
        } else {
            start = paginActual - 2;
            end = paginActual + 3;
        }
        if (cantPag > 8 && paginActual >= 5)
            paginador.appendChild(crearEnlace('...', false));
        for (var i = start; i < end; i++)
            paginador.appendChild(crearEnlace(i, paginActual != i));
        if (cantPag > 8 && paginActual < (cantPag - 3))
            paginador.appendChild(crearEnlace('...', false));
        paginador.appendChild(crearEnlace(cantPag, paginActual != cantPag));
        if (cantPag > 8)
            paginador.appendChild(crearEnlace('>', paginActual != cantPag));
    }

    function crearEnlace(texto, darPropiedades = true) {
        let enlace = document.createElement("a");
        ['rounded', 'btn', 'm-1', 'px-2', 'py-1'].forEach(className => {
            enlace.classList.add(className);
        });
        if (darPropiedades && texto != "<" && texto != ">") {
            enlace.href = "#";
            enlace.setAttribute('onclick', 'mostrarLista(' + filas + ', ' + texto + ', "' + tipo + '", "' + nomcontenedor + '", "' + nomPaginador + '")');
            ['rosa', 'text-white'].forEach(className => {
                enlace.classList.add(className);
            });
        } else if (darPropiedades) {
            enlace.href = "#";
            enlace.setAttribute('onclick', 'mostrarLista(' + filas + ', ' + (texto == '<' ? (paginActual - 1) : (paginActual + 1)) + '", "' + tipo + '", "' + nomcontenedor + '", "' + nomPaginador + '")');
            ['rosa', 'text-white'].forEach(className => {
                enlace.classList.add(className);
            });
        } else if (texto != "<" && texto != ">" && texto != "...")
            ['rosaFuerte', 'bs-s', 'bc-white', 'b-2', 'bw-2', 'text-white'].forEach(className => {
                enlace.classList.add(className);
            });
        else
            enlace.classList.add('deshabilitado');
        enlace.innerHTML = texto;
        return enlace;
    }
</script>