import paginador from './paginador.js';

let tipo = $('#tipo').val();
let filtro = $('#filtro').val() ?? '';
let paginator;

jQuery(document).ready(function () {
    $.post("http://localhost:8080/blog/actions/getRecords.php", {
            type: tipo,
            filter: filtro
        },
        function (res, status) {
            var data = JSON.parse(res);
            if (status === 'success') {
                let url = window.location.href.split('/');
                url = url.filter(n => n);
                switch (tipo) {
                    case 'reciente':
                        if (url[2] === 'blog' && (url[3] == null || url[3] === '#')) {
                            paginator = new paginadorEntradas(data, 16);
                            paginator.mostrarEntradas();
                        }
                        break;
                    case 'tabla':
                        if ((url[4] === 'entradas' || url[4] === 'entradas#') && url[5] == null) {
                            paginator = new paginadorEntradas(data, 8, 'contPaginacion', 'paginador');
                            paginator.mostrarEntradas();
                        }
                        break;
                    case 'busqueda':
                        if ((url[3] === 'buscar' || url[3] === 'buscar#') && url[4] == null) {
                            paginator = new paginadorEntradas(data, 8);
                            paginator.mostrarEntradas();
                        }
                        break;
                    case 'archivo':
                        if ((url[4] === 'archivo' || url[4] === 'archivo#') && url[5] == null) {
                            paginator = new paginadorEntradas(data, 8, 'contPaginacion', 'paginador');
                            paginator.mostrarEntradas();
                        }
                        break;
                    default:
                        break;
                }
            }
        }
    );
});

function cambio(actual) {
    paginator.pagina = actual;
    paginator.mostrarEntradas();
}
window.cambio = cambio; //las funciones dentro de modulos solo son visibles en el modulo. por eso esta línea es requerida.

class paginadorEntradas extends paginador {

    constructor(lista, filas, nomContenedor = 'contPaginacion', nomContenedorPaginador = 'contPaginacion') {
        super(lista, filas, document.getElementById(nomContenedorPaginador));
        this.tipo = tipo;
        this.nomContenedor = nomContenedor;
        this.nomContenedorPaginador = nomContenedorPaginador;
    }

    mostrarEntradas() {
        let contenedor = document.getElementById(this.nomContenedor);
        contenedor.innerHTML = "";
        let start = this.filas * (this.pagina - 1);
        let end = start + this.filas;
        let itemsPaginados = this.lista.slice(start, end);
        itemsPaginados.forEach(e => {
            switch (this.tipo) {
                case 'reciente':
                    contenedor.appendChild(this.Basica(e));
                    break;
                case 'tabla':
                case 'archivo':
                    contenedor.appendChild(this.Tabla(e, this.tipo === 'tabla' ? 0 : 1));
                    break;
                case 'busqueda':
                    contenedor.appendChild(this.Busqueda(e));
                    break;
                default:
                    break;
            }
        });
        if (this.lista.length > this.filas) {
            let contenedorPaginacion = document.getElementById(this.nomContenedorPaginador);
            if (this.nomContenedor != this.nomContenedorPaginador)
                contenedorPaginacion.innerHTML = "";
            this.crearPaginador();
        }
    }

    Basica(element) {
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

    Tabla(element, arch) {
        let tr = document.createElement("tr");
        let titulo = document.createElement("td");
        titulo.title = element.titulo;
        let enlaceTitulo = document.createElement("a");
        ['text-decoration-none', 'text-white'].forEach(className => {
            enlaceTitulo.classList.add(className);
        });
        paths('entrada', function (data) {
            enlaceTitulo.href = data + "/" + element.url;
        });
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
        paths('activar', function (data) {
            formActivar.action = data;
        });
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
        paths('editar', function (data) {
            formEditar.action = data;
        });
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
        paths('archivar', function (data) {
            formArchivar.action = data;
        });
        botonera.appendChild(formArchivar);
        let submitArchivar = document.createElement("button");
        ['btn', 'btn-outline-light', 'mx-1'].forEach(className => {
            submitArchivar.classList.add(className);
        });
        submitArchivar.type = "submit";
        submitArchivar.name = "archive";
        submitArchivar.value = "archive";
        submitArchivar.innerText = arch == 0 ? 'Archivar' : 'Restaurar';
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
        $.post("http://localhost:8080/blog/actions/getSesion.php", {
                type: 'priv'
            },
            function (res, status) {
                var data = JSON.parse(res);
                if (status === 'success' && (data.mod == 1 || data.adm == 1)) {
                    let formBloquear = document.createElement("form");
                    formBloquear.method = "POST";
                    paths('bloquear', function (data) {
                        formBloquear.action = data;
                    });
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
                        submitBloquear.title = "Esta entrada incumple las normas de la comunidad.";
                        /*Rellenar aquí cuales fueron las faltas.*/
                        submitBloquear.classList.add("red");
                        bloqueo.value = "0";
                    } else {
                        submitBloquear.value = "Activa";
                        submitBloquear.title = "Esta entrada cumple con las normas de la comunidad.";
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
                    if (data.adm == 1) {
                        let formBorrar = document.createElement("form");
                        formBorrar.method = "POST";
                        paths('borrar', function (data) {
                            formBorrar.action = data;
                        });
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
                }
            }
        );
        return tr;
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
        paths('entrada', function (data) {
            enlace.href = data + '/' + element.url;
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
        negrita.innerText = element.titulo;
        divInterno.appendChild(negrita);
        let parrafo = document.createElement("p");
        ['flex-fill', 'align-self-end', 'text-end', 'fz-text', 'm-0', 'pt-1'].forEach(className => {
            parrafo.classList.add(className);
        });
        parrafo.innerText = (new Date(element.fecha)).toLocaleDateString('es-es', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });
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