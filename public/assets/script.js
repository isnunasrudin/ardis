const popup = Swal.mixin({
    heightAuto: false
});

function gasken(link)
{
    document.cookie = link
    location.href = "."
}

document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll('a[data-target]').forEach(
        obj => obj.addEventListener('click', () => gasken(obj.getAttribute('data-target')))
    );

    // Laman Beranda
    if(document.getElementById('SELAMAT_DATANG') !== null)
    {
        document.querySelector('form').addEventListener('submit', e => {
            e.preventDefault();
            popup.fire({
                allowOutsideClick: false,
                allowEscapeKey: false,
                title: "Mohon Tunggu...",
                text: "Kami sedang menyiapkan data",
                didOpen: () => {
                    popup.showLoading();
                    setTimeout(() => fetch('.', {
                        method: 'POST',
                        body: (new FormData(document.querySelector('form')))
                    }).then((r) => r.json()).then(result => {
                        if(result.status === true) popup.fire('Tersedia!', result.message, 'success').then( () => gasken(result.data.link) );
                        else popup.fire('Tidak Ditemukan!', result.message, 'warning');
                    }).catch( () => {
                        popup.fire('Kesalahan Sistem!', 'Gagal mengambil data dari server.', 'error');
                    }), 700);
                }
            })
        })
    }

    // Laman Beranda
    if(document.getElementById('MASUK') !== null)
    {
        document.querySelector('form').addEventListener('submit', e => {
            e.preventDefault();
            popup.fire({
                allowOutsideClick: false,
                allowEscapeKey: false,
                title: "Mohon Tunggu...",
                text: "Kami sedang menyiapkan data",
                didOpen: () => {
                    popup.showLoading();
                    fetch('.', {
                        method: 'POST',
                        body: (new FormData(document.querySelector('form')))
                    }).then((r) => r.json()).then(result => {
                        if(result.status === true) popup.fire('Tersedia!', result.message, 'success').then( () => gasken(result.data.link) );
                        else popup.fire('Oh tidak!', result.message, 'warning');
                    }).catch( () => {
                        popup.fire('Kesalahan Sistem!', 'Gagal mengambil data dari server.', 'error');
                    })
                }
            })
        })
    }

});