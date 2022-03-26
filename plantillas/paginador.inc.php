<script>
    let funcion, pagina, lista, filas, tipo, contenedor, nomContenedorPaginador;
    function crearPaginador(funcionInvocada, paginActual, listaActual, filasTotales, tipoActual, container, nomContainerPaginador, contenedorPaginacion) {
        debugger;
        funcion = funcionInvocada;
        pagina = paginActual;
        lista = listaActual;
        filas = filasTotales;
        tipo = tipoActual;
        contenedor = container;
        nomContenedorPaginador = nomContainerPaginador;

        let div = document.createElement("div");
        ['d-flex', 'justify-content-center', 'rounded', 'fz-texto', 'py-1', 'px-3'].forEach(className => {
            div.classList.add(className);
        });
        contenedorPaginacion.appendChild(div);
        let strong = document.createElement("strong");
        div.appendChild(strong);
        let paginador;
        paginador = document.createElement("span");
        paginador.classList.add("navigation");
        paginador.id = "navigation";
        strong.appendChild(paginador);
        cantPag = Math.ceil(lista.length / filas);
        if (cantPag > 8)
            paginador.appendChild(crearEnlace('<', pagina != 1));
        paginador.appendChild(crearEnlace(1, pagina != 1));
        var start, end;
        if (pagina < 5 && cantPag > 8) {
            start = 2;
            end = 6;
        } else if (pagina + 3 >= cantPag && cantPag > 8) {
            start = cantPag - 4;
            end = cantPag;
        } else if (cantPag <= 8) {
            start = 2;
            end = cantPag;
        } else {
            start = pagina - 2;
            end = pagina + 3;
        }
        if (cantPag > 8 && pagina >= 5)
            paginador.appendChild(crearEnlace('...', false));
        for (var i = start; i < end; i++)
            paginador.appendChild(crearEnlace(i, pagina != i));
        if (cantPag > 8 && pagina < (cantPag - 3))
            paginador.appendChild(crearEnlace('...', false));
        paginador.appendChild(crearEnlace(cantPag, pagina != cantPag));
        if (cantPag > 8)
            paginador.appendChild(crearEnlace('>', pagina != cantPag));
    }

    function crearEnlace(texto, darPropiedades = true) {
        let enlace = document.createElement("a");
        ['rounded', 'btn', 'm-1', 'px-2', 'py-1'].forEach(className => {
            enlace.classList.add(className);
        });
        if (darPropiedades && texto != "<" && texto != ">") {
            enlace.href = "#";
            enlace.setAttribute('onclick', funcion + '(' + filas + ', ' + texto + ', "' + tipo + '", "' + contenedor + '", "' + nomContenedorPaginador + '")');
            ['rosa', 'text-white'].forEach(className => {
                enlace.classList.add(className);
            });
        } else if (darPropiedades) {
            enlace.href = "#";
            enlace.setAttribute('onclick', funcion + '(' + filas + ', ' + (texto == '<' ? (pagina - 1) : (pagina + 1)) + ', "' + tipo + '", "' + contenedor + '", "' + nomContenedorPaginador + '")');
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