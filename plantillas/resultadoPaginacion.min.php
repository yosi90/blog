<script>
    let paginActual; //utilizar esta variable para navegar con los botones de previa y siguiente.
    let lista = <?php echo $entradas ?>;
    let filas, tipo;

    function mostrarLista(rows, actual, type) {
        paginActual = actual;
        filas = rows;
        tipo = type;
        actual--;
        contenedor = document.getElementById("contPaginacion");
        contenedor.innerHTML = "";
        let start = rows * actual;
        let end = start + rows;
        let itemsPaginados = lista.slice(start, end);
        itemsPaginados.forEach(e => {
            switch (type) {
                case 'recientes':
                    contenedor.appendChild(crearEntradaBasica(e));
                    break;
                case 'filtradas':
                    break;
                default:
                    break;
            }
        });
        if (lista.length > 16)
            crearPaginador();
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
        });; //FECHA
        container.appendChild(parrafo);
        return carta;
    }

    function crearPaginador() {
        let paginador;
        let div = document.createElement("div");
        ['rounded', 'fz-texto', 'py-1', 'px-3'].forEach(className => {
            div.classList.add(className);
        });
        contenedor.appendChild(div);
        let strong = document.createElement("strong");
        div.appendChild(strong);
        paginador = document.createElement("span");
        paginador.classList.add("navigation");
        paginador.id = "navigation";
        strong.appendChild(paginador);
        cantPag = Math.ceil(lista.length / 16);
        if (cantPag > 8)
            paginador.appendChild(crearEnlace('<', paginActual != 1));
        paginador.appendChild(crearEnlace(1, paginActual != 1));
        var inicio, fin;
        if (paginActual < 5 && cantPag > 8) {
            inicio = 2;
            fin = 6;
        } else if (paginActual + 3 >= cantPag && cantPag > 8) {
            inicio = cantPag - 4;
            fin = cantPag;
        } else if (cantPag <= 8) {
            inicio = 2;
            fin = cantPag;
        } else {
            inicio = paginActual - 2;
            fin = paginActual + 3;
        }
        if (cantPag > 8 && paginActual >= 5)
            paginador.appendChild(crearEnlace('...', false));
        for (var i = inicio; i < fin; i++)
            paginador.appendChild(crearEnlace(i, paginActual != i));
        if (cantPag > 8 && paginActual < (cantPag - 3))
            paginador.appendChild(crearEnlace('...', false));
        paginador.appendChild(crearEnlace(cantPag, paginActual != cantPag));
        paginador.appendChild(crearEnlace('>', paginActual != cantPag));
    }

    function crearEnlace(texto, darPropiedades = true) {
        let enlace = document.createElement("a");
        ['rounded', 'btn', 'm-1', 'px-2', 'py-1'].forEach(className => {
            enlace.classList.add(className);
        });
        if (darPropiedades && texto != "<" && texto != ">") {
            enlace.setAttribute('href', '#');
            enlace.setAttribute('onclick', 'mostrarLista(' + filas + ', ' + texto + ', "' + tipo + '", "navigation")');
            ['rosa', 'text-white'].forEach(className => {
                enlace.classList.add(className);
            });
        } else if (darPropiedades){
            enlace.setAttribute('href', '#');
            enlace.setAttribute('onclick', 'mostrarLista(' + filas + ', ' + (texto == '<' ? (paginActual - 1) : (paginActual + 1)) + ', "' + tipo + '", "navigation")');
            ['rosa', 'text-white'].forEach(className => {
                enlace.classList.add(className);
            });
        } else if (texto != "<" && texto != ">" && texto != "...") {
            ['rosaFuerte', 'bs-s', 'bc-white', 'b-2', 'bw-2', 'text-white'].forEach(className => {
                enlace.classList.add(className);
            });
        } else {
            enlace.classList.add('deshabilitado'); //color gris
        }
        enlace.innerHTML = texto;
        return enlace;
    }
</script>