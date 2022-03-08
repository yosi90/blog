var boton;

window.onload = function () {
    if (document.URL == "http://localhost:8080/blog/") {
        boton = document.getElementById('vistas');
        crearSVG();
    }
}

function alternarVistaEntradas() {
    boton.removeChild(boton.childNodes[0]);
    crearSVG();
}

function crearSVG() {
    const iconSvg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    const iconPath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    iconSvg.setAttribute('aria-hidden', 'true');
    iconSvg.setAttribute('focusable', 'false');
    iconSvg.setAttribute('data-prefix', 'fas');
    iconSvg.setAttribute('role', 'img');
    iconSvg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
    iconSvg.setAttribute('viewBox', '0 0 512 512');
    iconSvg.classList.add('svg-inline--fa');
    iconSvg.classList.add('fa-list-ul');
    iconSvg.classList.add('fa-lg');
    iconSvg.classList.add('z-subtitulo');
    iconPath.setAttribute('fill', 'currentColor');
    switch (boton.value) {
        case '0':
            tamaño(document.getElementsByClassName('controlTamaño'), 'mw-100', 'mw-25');
            boton.setAttribute('value', '1');
            iconSvg.setAttribute('data-icon', 'list-ul');
            iconPath.setAttribute('d', 'M16 96C16 69.49 37.49 48 64 48C90.51 48 112 69.49 112 96C112 122.5 90.51 144 64 144C37.49 144 16 122.5 16 96zM480 64C497.7 64 512 78.33 512 96C512 113.7 497.7 128 480 128H192C174.3 128 160 113.7 160 96C160 78.33 174.3 64 192 64H480zM480 224C497.7 224 512 238.3 512 256C512 273.7 497.7 288 480 288H192C174.3 288 160 273.7 160 256C160 238.3 174.3 224 192 224H480zM480 384C497.7 384 512 398.3 512 416C512 433.7 497.7 448 480 448H192C174.3 448 160 433.7 160 416C160 398.3 174.3 384 192 384H480zM16 416C16 389.5 37.49 368 64 368C90.51 368 112 389.5 112 416C112 442.5 90.51 464 64 464C37.49 464 16 442.5 16 416zM112 256C112 282.5 90.51 304 64 304C37.49 304 16 282.5 16 256C16 229.5 37.49 208 64 208C90.51 208 112 229.5 112 256z');
            break;
        case '1':
            tamaño(document.getElementsByClassName('controlTamaño'), 'mw-50', 'mw-100');
            boton.setAttribute('value', '2');
            iconSvg.setAttribute('data-icon', 'grid-2');
            iconPath.setAttribute('d', 'M192 176C192 202.5 170.5 224 144 224H48C21.49 224 0 202.5 0 176V80C0 53.49 21.49 32 48 32H144C170.5 32 192 53.49 192 80V176zM192 432C192 458.5 170.5 480 144 480H48C21.49 480 0 458.5 0 432V336C0 309.5 21.49 288 48 288H144C170.5 288 192 309.5 192 336V432zM256 80C256 53.49 277.5 32 304 32H400C426.5 32 448 53.49 448 80V176C448 202.5 426.5 224 400 224H304C277.5 224 256 202.5 256 176V80zM448 432C448 458.5 426.5 480 400 480H304C277.5 480 256 458.5 256 432V336C256 309.5 277.5 288 304 288H400C426.5 288 448 309.5 448 336V432z');
            break;
        case '2':
            tamaño(document.getElementsByClassName('controlTamaño'), 'mw-25', 'mw-50');
            boton.setAttribute('value', '0');
            iconSvg.setAttribute('data-icon', 'grid');
            iconPath.setAttribute('d', 'M0 72C0 49.91 17.91 32 40 32H88C110.1 32 128 49.91 128 72V120C128 142.1 110.1 160 88 160H40C17.91 160 0 142.1 0 120V72zM0 232C0 209.9 17.91 192 40 192H88C110.1 192 128 209.9 128 232V280C128 302.1 110.1 320 88 320H40C17.91 320 0 302.1 0 280V232zM128 440C128 462.1 110.1 480 88 480H40C17.91 480 0 462.1 0 440V392C0 369.9 17.91 352 40 352H88C110.1 352 128 369.9 128 392V440zM160 72C160 49.91 177.9 32 200 32H248C270.1 32 288 49.91 288 72V120C288 142.1 270.1 160 248 160H200C177.9 160 160 142.1 160 120V72zM288 280C288 302.1 270.1 320 248 320H200C177.9 320 160 302.1 160 280V232C160 209.9 177.9 192 200 192H248C270.1 192 288 209.9 288 232V280zM160 392C160 369.9 177.9 352 200 352H248C270.1 352 288 369.9 288 392V440C288 462.1 270.1 480 248 480H200C177.9 480 160 462.1 160 440V392zM448 120C448 142.1 430.1 160 408 160H360C337.9 160 320 142.1 320 120V72C320 49.91 337.9 32 360 32H408C430.1 32 448 49.91 448 72V120zM320 232C320 209.9 337.9 192 360 192H408C430.1 192 448 209.9 448 232V280C448 302.1 430.1 320 408 320H360C337.9 320 320 302.1 320 280V232zM448 440C448 462.1 430.1 480 408 480H360C337.9 480 320 462.1 320 440V392C320 369.9 337.9 352 360 352H408C430.1 352 448 369.9 448 392V440z');
            break;
    }
    iconSvg.appendChild(iconPath);
    return boton.appendChild(iconSvg);
}

/**
 * @param {string} añadir 
 * @param {string} quitar 
 */
function tamaño(entradas, añadir, quitar) {
    for (let index = 0; index < entradas.length; index++) {
        const e = entradas[index];
        e.classList.add(añadir);
        e.classList.remove(quitar);
    }
}