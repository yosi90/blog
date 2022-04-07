import paginador from './paginador.js';

let tipo = $('#tipoC').val();
let filtro = $('#filtro').val() ?? '';
let paginator;

jQuery(document).ready(function () {
    $.post("http://localhost:8080/blog/actions/getRecords.php", {
            type: tipo,
            filter: filtro
        },
        function (res, status) {
            var data = JSON.parse(res);
            debugger;
            if (status === 'success' && filtro !== "" && data.length !== 0) {
                let url = window.location.href.split('/');
                url = url.filter(n => n);
                switch (tipo) {
                    case 'busquedaC':
                        if ((url[3] === 'buscar' || url[3] === 'buscar#') && url[4] == null) {
                            paginator = new paginadorComentarios(data, 8);
                            paginator.mostrarComentarios();
                        }
                        break;
                    default:
                        break;
                }
            }
        }
    );
});

function cambioC(actual) {
    paginator.pagina = actual;
    paginator.mostrarEntradas();
}
window.cambioC = cambioC; //las funciones dentro de modulos solo son visibles en el modulo. por eso esta línea es requerida.

class paginadorComentarios extends paginador {

    constructor(lista, filas, nomContenedor = 'contPaginacionC', nomContenedorPaginador = 'contPaginacionC') {
        super(lista, filas, document.getElementById(nomContenedorPaginador), 'cambioC');
        this.tipo = tipo;
        this.nomContenedor = nomContenedor;
        this.nomContenedorPaginador = nomContenedorPaginador;
    }

    mostrarComentarios() {
        let contenedor = document.getElementById(this.nomContenedor);
        contenedor.innerHTML = "";
        let start = this.filas * (this.pagina - 1);
        let end = start + this.filas;
        let itemsPaginados = this.lista.slice(start, end);
        itemsPaginados.forEach(e => {
            switch (this.tipo) {
                case 'busquedaC':
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
        let formulario = document.createElement("form");
        ['d-flex', 'flex-fill'].forEach(className => {
            formulario.classList.add(className);
        });
        formulario.method = "POST";
        paths('entrada', function (data) {
            formulario.action = data + '/' + element.urlEntrada;
        });
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
}

function paths(ruta, callback) {
    $.post("http://localhost:8080/blog/actions/getPaths.php", {
        type: ruta
    }, function (data, status) {
        if (status === 'success')
            callback(data);
    });
}