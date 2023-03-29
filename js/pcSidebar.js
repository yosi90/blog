let contenedor = document.getElementById("contenedorSidebar");
let btn = document.getElementById("btnSidebar");
cerrar();

function cerrar() {
    contenedor.style.left = contenedor.style.left === "" || contenedor.style.left === "0px" ? "-59px" : "0px";
    if (btn.childNodes.length)
        btn.removeChild(btn.childNodes[0]);
    let img = document.createElement('i');
    if (contenedor.style.left === "0px")
        ['fa-solid', 'fa-caret-left', 'ms-1'].forEach(className => {
            img.classList.add(className);
        });
    else
        ['fa-solid', 'fa-caret-right', 'me-1'].forEach(className => {
            img.classList.add(className);
        });
    btn.appendChild(img);
}