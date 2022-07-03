const Alert = Swal.mixin({
    heightAuto: false,
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
});

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    },
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
})

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
            Alert.fire({
                allowOutsideClick: false,
                allowEscapeKey: false,
                title: "Mohon Tunggu...",
                text: "Kami sedang menyiapkan data",
                didOpen: () => {
                    Alert.showLoading();
                    setTimeout(() => fetch('.', {
                        method: 'POST',
                        body: (new FormData(document.querySelector('form')))
                    }).then((r) => r.json()).then(result => {
                        if(result.status === true) Alert.fire('Tersedia!', result.message, 'success').then( () => gasken(result.data.link) );
                        else Alert.fire('Tidak Ditemukan!', result.message, 'warning');
                    }).catch( () => {
                        Alert.fire('Kesalahan Sistem!', 'Gagal mengambil data dari server.', 'error');
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
            const data = new FormData(document.querySelector('form'));

            const button = document.querySelector('form button');
            const inputs = document.querySelectorAll('form input');
            const font   = button.querySelector('i');

            button.disabled = true;
            inputs.forEach(obj => obj.disabled = true)
            font.className = "fa-solid fa-spinner fa-spin me-1"
            Toast.close();

            setTimeout(() => fetch('.', {
                method: 'POST',
                body: data
            }).then((r) => r.json()).then(result => {
                if(result.status === true) location.href = "."
                else
                {
                    Toast.fire({
                        title: result.message,
                        icon: 'warning'
                    });
                    button.disabled = false;
                    inputs.forEach(obj => obj.disabled = false)
                    font.className = "fa-solid fa-sign-in me-1"
                }
            }).catch( () => {
                Alert.fire('Kesalahan Sistem!', 'Gagal mengambil data dari server.', 'error').then(() => location.href = ".");
            }), 700)
        })
    }

});