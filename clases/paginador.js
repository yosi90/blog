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
        if (cantPag > 8 && this.pagina != 1) {
            if (this.pagina > 3)
                paginador.appendChild(this.crearEnlace('<<'));
            paginador.appendChild(this.crearEnlace('<'));
        }
        var start = 1, end = cantPag;
        if (this.pagina < 4 && cantPag > 8)
            end = 4;
        else if (this.pagina + 2 >= cantPag && cantPag > 8)
            start = cantPag - 3;
        else if (cantPag > 8) {
            start = this.pagina - 2;
            end = this.pagina + 2;
        }
        for (var i = start; i <= end; i++)
            paginador.appendChild(this.crearEnlace(i, this.pagina != i));
        if (cantPag > 8 && this.pagina != cantPag) {
            paginador.appendChild(this.crearEnlace('>'));
            if (this.pagina < cantPag - 2)
                paginador.appendChild(this.crearEnlace('>>'));
        }
    }

    crearEnlace(pagina, darPropiedades = true) {
        let enlace = document.createElement("a");
        ['rounded', 'btn', 'm-1', 'px-2', 'py-1'].forEach(className => {
            enlace.classList.add(className);
        });
        if (pagina === "<<") {
            enlace = this.darAtributos(enlace, 1);
        } else if (pagina === ">>") {
            enlace = this.darAtributos(enlace, Math.ceil(this.lista.length / this.filas));
        } else if (darPropiedades && pagina != "<" && pagina != ">") {
            enlace = this.darAtributos(enlace, pagina);
        } else if (darPropiedades) {
            enlace = this.darAtributos(enlace);
            enlace.setAttribute('onclick', this.funcCambio + '(' + (pagina == '<' ? (this.pagina - 1) : (this.pagina + 1)) + ');');
        } else
            ['d-inline-flex', 'justify-content-center', 'align-items-center', 'bg-rosa-fuerte', 'border', 'border-white', 'text-white'].forEach(className => {
                enlace.classList.add(className);
            });
        enlace.innerHTML = pagina;
        return enlace;
    }

    darAtributos(enlace, pagina, click = true) {
        enlace.href = "#";
        if (click)
            enlace.setAttribute('onclick', this.funcCambio + '(' + pagina + ');');
        ['d-inline-flex', 'justify-content-center', 'align-items-center', 'bg-rosa', 'text-white', 'fw-bolder'].forEach(className => {
            enlace.classList.add(className);
        });
        return enlace;
    }
}
export default paginador;