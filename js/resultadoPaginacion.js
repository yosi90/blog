function mostrarLista(idContenedor, lista, rows, actual, tipo, idContenedorPaginador = null) {
    actual--;
    let contenedor = document.getElementById(idContenedor);
    contenedor.innerHTML = "";
    let start = rows * actual;
    let end = start + rows;
    let itemsPaginados = lista.slice(start, end);
    debugger;
    itemsPaginados.forEach(e => {
        switch (tipo) {
            case 'recientes':
                contenedor.appendChild(crearEntradaBasica(e));
                break;
            case 'filtradas':
                break;
            default:
                break;
        }
    });
    crearPaginador(idContenedorPaginador, actual);
}

function crearEntradaBasica(element) {
    let carta = document.createElement("div");
    ['card', 'flex-fill', 'sizeControl', 'm-1', 'mw-100'].forEach(className => {
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
    enlace.setAttribute("href", '/blog/entrada/' + element.url); //URL URL URL URL URL URL URL URL URL URL URL URL URL URL URL
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
    negrita.innerText = element.titulo; //TITULO TITULO TITULO TITULO TITULO TITULO TITULO TITULO TITULO TITULO
    container.appendChild(negrita);
    let parrafo = document.createElement("p");
    ['flex-fill', 'align-self-end', 'text-end', 'fz-texto', 'm-0', 'pt-1'].forEach(className => {
        parrafo.classList.add(className);
    });
    parrafo.innerText = (new Date(element.fecha)).toLocaleDateString('es-es', { day: '2-digit', month: 'long', year: 'numeric' });; //FECHA FECHA FECHA FECHA FECHA FECHA FECHA FECHA FECHA FECHA FECHA
    container.appendChild(parrafo);
    return carta;
}

function crearPaginador(idContenedor, actual) {
    if (idContenedor == null) {
        let contenedor = document.getElementById(idContenedor);
        contenedor.innerHTML = "";
        let div = document.createElement("div");
        ['rounded', 'fz-texto', 'm-3', 'p-3'].forEach(className => {
            div.classList.add(className);
        });
        contenedor.appendChild
    }
}

<
? php

$actual = 1;
if ($total > 8) {
    ?
    >
    <
    div class = "rounded p-3 m-3 fz-texto" >
        <
        strong >
        <
        span class = "navigation" >
        <
        !--llamar a paginador-- >
        <
        /span> <
        /strong> <
        /div> <
        ? php
} ?
>