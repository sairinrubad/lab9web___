// Konfirmasi sebelum menghapus data (form dengan atribut data-confirm)
document.addEventListener('submit', function (ev) {
    var pesan = ev.target.getAttribute('data-confirm');
    if (pesan && !window.confirm(pesan)) {
        ev.preventDefault();
    }
});
