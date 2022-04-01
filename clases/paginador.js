export class paginador {

    constructor(lista, filas, objetoContenedor, funcCambio) {
        this.pagina = 1;
        this.lista = lista;
        this.filas = filas;
        this.funcCambio = funcCambio;
        this.objetoContenedor = objetoContenedor;
    }

    crearPaginador() {
        let div = document.createElement("div");
        ['d-flex', 'justify-content-center', 'rounded', 'fz-texto', 'py-1', 'px-3'].forEach(className => {
            div.classList.add(className);
        });
        this.objetoContenedor.appendChild(div);
        let strong = document.createElement("strong");
        div.appendChild(strong);
        let paginador;
        paginador = document.createElement("span");
        paginador.classList.add("navigation");
        paginador.id = "navigation";
        strong.appendChild(paginador);
        let cantPag = Math.ceil(this.lista.length / this.filas);
        if (cantPag > 8)
            paginador.appendChild(this.crearEnlace('<', this.pagina != 1));
        paginador.appendChild(this.crearEnlace(1, this.pagina != 1));
        var start, end;
        if (this.pagina < 5 && cantPag > 8) {
            start = 2;
            end = 6;
        } else if (this.pagina + 3 >= cantPag && cantPag > 8) {
            start = cantPag - 4;
            end = cantPag;
        } else if (cantPag <= 8) {
            start = 2;
            end = cantPag;
        } else {
            start = this.pagina - 2;
            end = this.pagina + 3;
        }
        if (cantPag > 8 && this.pagina >= 5)
            paginador.appendChild(this.crearEnlace('...', false));
        for (var i = start; i < end; i++)
            paginador.appendChild(this.crearEnlace(i, this.pagina != i));
        if (cantPag > 8 && this.pagina < (cantPag - 3))
            paginador.appendChild(this.crearEnlace('...', false));
        paginador.appendChild(this.crearEnlace(cantPag, this.pagina != cantPag));
        if (cantPag > 8)
            paginador.appendChild(this.crearEnlace('>', this.pagina != cantPag));
    }

    crearEnlace(pagina, darPropiedades = true) {
        let enlace = document.createElement("a");
        ['rounded', 'btn', 'm-1', 'px-2', 'py-1'].forEach(className => {
            enlace.classList.add(className);
        });
        if (darPropiedades && pagina != "<" && pagina != ">") {
            enlace.href = "#";
            enlace.setAttribute('onclick', this.funcCambio + '(' + pagina + ');');
            ['rosa', 'text-white'].forEach(className => {
                enlace.classList.add(className);
            });
        } else if (darPropiedades) {
            enlace.href = "#";
            enlace.setAttribute('onclick', this.funcCambio + '(' + (pagina == '<' ? (this.pagina - 1) : (this.pagina + 1)) + ');');
            ['rosa', 'text-white'].forEach(className => {
                enlace.classList.add(className);
            });
        } else if (pagina != "<" && pagina != ">" && pagina != "...")
            ['rosaFuerte', 'bs-s', 'bc-white', 'b-2', 'bw-2', 'text-white'].forEach(className => {
                enlace.classList.add(className);
            });
        else
            enlace.classList.add('deshabilitado');
        enlace.innerHTML = pagina;
        return enlace;
    }
}
export default paginador;