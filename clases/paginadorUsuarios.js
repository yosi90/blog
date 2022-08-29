import paginador from './paginador.js';

let tipo = $('#tipoU').val();
let filtro = $('#filtro').val() ?? '';
let paginator;

jQuery(document).ready(function () {
    $.post("http://localhost:8080/blog/actions/getRecords.php", {
            type: tipo,
            filter: filtro
        },
        function (res, status) {
            var data = JSON.parse(res);
            if (status === 'success' && filtro !== "" && data.length !== 0) {
                let url = window.location.href.split('/');
                url = url.filter(n => n);
                switch (tipo) {
                    case 'busquedaU':
                        if ((url[3] === 'buscar' || url[3] === 'buscar#') && url[4] == null) {
                            paginator = new paginadorUsuarios(data, 8);
                            paginator.mostrarUsuarios();
                        }
                        break;
                    default:
                        break;
                }
            }
        }
    );
});

function cambioU(actual) {
    paginator.pagina = actual;
    paginator.mostrarUsuarios();
}
window.cambioU = cambioU; //las funciones dentro de modulos solo son visibles en el modulo. por eso esta línea es requerida.

class paginadorUsuarios extends paginador {

    constructor(lista, filas, nomContenedor = 'contPaginacionU', nomContenedorPaginador = 'contPaginacionU') {
        super(lista, filas, document.getElementById(nomContenedorPaginador), 'cambioU');
        this.tipo = tipo;
        this.nomContenedor = nomContenedor;
        this.nomContenedorPaginador = nomContenedorPaginador;
    }

    mostrarUsuarios() {
        let contenedor = document.getElementById(this.nomContenedor);
        contenedor.innerHTML = "";
        let start = this.filas * (this.pagina - 1);
        let end = start + this.filas;
        let itemsPaginados = this.lista.slice(start, end);
        itemsPaginados.forEach(e => {
            switch (this.tipo) {
                case 'busquedaU':
                    contenedor.appendChild(this.Busqueda(e));
                    break;
                default:
                    break;
            }
        });
        let contenedorPaginacion = document.getElementById(this.nomContenedorPaginador);
        if (this.nomContenedor != this.nomContenedorPaginador)
            contenedorPaginacion.innerHTML = "";
        if (this.lista.length > this.filas)
            this.crearPaginador();
    }

    Busqueda(element) {
        let card = document.createElement("div");
        ['card', 'flex-fill', 'controlTamaño', 'm-1', 'mw-100'].forEach(className => {
            card.classList.add(className);
        });
        let cHeader = document.createElement("div");
        ['card-header', 'd-flex', 'bg-secondary', 'text-white', 'h-100'].forEach(className => {
            cHeader.classList.add(className);
        });
        card.appendChild(cHeader);
        let enlace = document.createElement("a");
        ['btn', 'btn-outline-light', 'fz-sm-texto', 'flex-fill'].forEach(className => {
            enlace.classList.add(className);
        });
        enlace.role = "button";
        paths('autores', function (data) {
            enlace.href = data + '/' + element.nombre;
        });
        cHeader.appendChild(enlace);
        let divInterno = document.createElement("div");
        ['d-flex', 'flex-wrap'].forEach(className => {
            divInterno.classList.add(className);
        });
        enlace.appendChild(divInterno);
        let negrita = document.createElement("strong");
        ['flex-fill', 'text-start', 'fz-subtitulo', 'lt-2'].forEach(className => {
            negrita.classList.add(className);
        });
        negrita.innerText = element.nombre;
        divInterno.appendChild(negrita);
        let parrafo = document.createElement("p");
        ['flex-fill', 'align-self-end', 'text-end', 'fz-text', 'm-0', 'pt-1'].forEach(className => {
            parrafo.classList.add(className);
        });
        parrafo.innerHTML = element.entradas + "&nbsp;";
        let clipboard = document.createElement("i");
        ['far', 'fa-clipboard'].forEach(className => {
            clipboard.classList.add(className);
        });
        parrafo.appendChild(clipboard);
        parrafo.innerHTML += "&nbsp;&nbsp;&nbsp;" + element.comentarios + "&nbsp;";
        let comments = document.createElement("i");
        ['fas', 'fa-comments'].forEach(className => {
            comments.classList.add(className);
        });
        parrafo.appendChild(comments);
        divInterno.appendChild(parrafo);
        return card;
    }
}

function paths(ruta, callback) {
    $.post("http://localhost:8080/blog/actions/getPaths.php", {
        type: ruta
    }, function (data, status) {
        if (status === 'success')
            callback(data);
    });
}