jQuery(document).ready(function () {
    $('#private').toggleClass('d-flex');
    $('#private').hide();
    $('#mds').toggleClass('d-flex');
    $('#mds').hide();
    $('#privacity').toggleClass('d-flex');
    $('#privacity').hide();
});

$('[id^="bPerfil"]').click(function () {
    if (!this.classList.contains('active')) {
        e = document.querySelector('.active');
        e.classList.remove('active');
        switch (e.id) {
            case 'bPerfil1':
                $('#public').toggleClass('d-flex');
                $('#public').hide();
                break;
            case 'bPerfil2':
                $('#private').toggleClass('d-flex');
                $('#private').hide();
                break;
            case 'bPerfil3':
                $('#mds').toggleClass('d-flex');
                $('#mds').hide();
                break;
            case 'bPerfil4':
                $('#privacity').toggleClass('d-flex');
                $('#privacity').hide();
                break;
            default:
                break;
        }
        this.classList.add('active');
        switch (this.id) {
            case 'bPerfil1':
                $('#public').toggleClass('d-flex');
                $('#public').show();
                break;
            case 'bPerfil2':
                $('#private').toggleClass('d-flex');
                $('#private').show();
                break;
            case 'bPerfil3':
                $('#mds').toggleClass('d-flex');
                $('#mds').show();
                break;
            case 'bPerfil4':
                $('#privacity').toggleClass('d-flex');
                $('#privacity').show();
                break;
            default:
                break;
        }
    }
});