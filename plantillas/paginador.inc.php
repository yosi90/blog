<script>
    function crearPaginador() {
        let paginador;
        let div = document.createElement("div");
        ['d-flex', 'justify-content-center', 'rounded', 'fz-texto', 'py-1', 'px-3'].forEach(className => {
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
            enlace.setAttribute('onclick', 'mostrarLista(' + filas + ', ' + (texto == '<' ? (paginActual - 1) : (paginActual + 1)) + ', "' + tipo + '", "' + nomcontenedor + '", "' + nomPaginador + '")');
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