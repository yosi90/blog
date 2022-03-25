<?php
require_once 'paginador.inc.php';
?>
<script>
    let paginActual; //utilizar esta variable para navegar con los botones de previa y siguiente.
    let lista = <?php echo $comentarios ?>;
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
                case 'entrada':
                    // contenedor.appendChild(crearComentarioBasico(e));
                    break;
                case 'busqueda':
                    contenedor.appendChild(crearComentarioBusqueda(e));
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

    function crearComentarioBusqueda(element) {
        debugger;
        let card = document.createElement("div");
        ['card', 'flex-fill', 'controlTamaño', 'm-1', 'mw-100'].forEach(className => {
            card.classList.add(className);
        });
        let cHeader = document.createElement("div");
        ['card-header', 'd-flex', 'bg-secondary', 'text-white', 'h-100'].forEach(className => {
            cHeader.classList.add(className);
        });
        card.appendChild(cHeader);
        let formulario = document.createElement("form");
        ['d-flex', 'flex-fill'].forEach(className => {
            formulario.classList.add(className);
        });
        formulario.method = "POST";
        formulario.action = "<?php echo RUTA_ENTRADA . '/'?>" + element.urlEntrada;
        cHeader.appendChild(formulario);
        let negrita = document.createElement("strong");
        ['d-flex', 'flex-fill'].forEach(className => {
            negrita.classList.add(className);
        });
        formulario.appendChild(negrita);
        let boton = document.createElement("input");
        ['btn', 'btn-outline-light', 'form-control', 'fz-sm-texto', 'd-flex', 'flex-fill', 'align-items-center', 'justify-content-center'].forEach(className => {
            boton.classList.add(className);
        });
        boton.type = "submit";
        boton.name = "busqueda";
        boton.role = "button";
        debugger;
        boton.value = "#" + (element.indice + 1) + " en la entrada " + element.tituloEntrada;
        negrita.appendChild(boton);
        let parrafo = document.createElement("p");
        ['flex-fill', 'align-self-end', 'text-end', 'fz-text', 'm-0', 'pt-1'].forEach(className => {
            parrafo.classList.add(className);
        });
        parrafo.innerText = (new Date(element.fecha)).toLocaleDateString('es-es', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });
        formulario.appendChild(parrafo);
        let oculto = document.createElement("input");
        oculto.type = "hidden";
        oculto.name = "posicion";
        oculto.value = "comentario" + (element.indice + 1);
        formulario.appendChild(oculto);
        return card;
    }
</script>