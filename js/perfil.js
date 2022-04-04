jQuery(document).ready(function () {
    e = document.querySelector('.active');
    e.classList.remove('bg-gray');
    e.classList.add('bg-dark-light');
});

$('[id^="bPerfil"]').click(function () {
    if (!this.classList.contains('active')) {
        e = document.querySelector('.active');
        e.classList.remove('bg-dark-light', 'active');
        e.classList.add('bg-gray');
        this.classList.remove('bg-gray');
        this.classList.add('bg-dark-light', 'active');
    }
});