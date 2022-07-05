<div class="container">
    <div class="d-flex justify-content-center mb-3">
        <button class="btn btn-secondary" data-target="<?= e(url_make('auth.siswa')) ?>">Kembali</button>
        <h5 class="ms-2 my-auto">Tambah Siswa</h5>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <form class="card" method="POST">
                <div class="card-header">
                    <h5 class="card-title">Daftar Peserta Didik</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label for="input-nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="input-nama" name="nama" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="input-nisn" class="form-label">Nomor Induk Siswa Nasional</label>
                        <input type="text" class="form-control" id="input-nisn" name="nisn" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-tempat-lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="input-tempat-lahir" name="tempat-lahir" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-tgl-lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="input-tgl-lahir" name="tgl-lahir" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="input-email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="input-email" name="email" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="input-asal-sekolah" class="form-label">Asal Sekolah</label>
                        <input type="text" class="form-control" id="input-asal-sekolah" name="asal-sekolah" required>
                    </div>
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <div class="form-group mb-4">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <select class="form-select" id="provinsi" name="provinsi" required>
                                    <option value="">Sedang Memuat...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="form-group mb-4">
                                <label for="kota" class="form-label">Kabupaten</label>
                                <select class="form-select" id="kota" name="kota" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 ">
                            <div class="form-group mb-4">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <select class="form-select" id="kecamatan" name="kecamatan" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 ">
                            <div class="form-group mb-4">
                                <label for="desa" class="form-label">Desa</label>
                                <select class="form-select" id="desa" name="desa" required>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col-2">
                            <div class="form-group mb-4">
                                <label for="input-rt" class="form-label">Rt.</label>
                                <input type="number" class="form-control" id="input-rt" name="rt">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group mb-4">
                                <label for="input-rw" class="form-label">Rw.</label>
                                <input type="number" class="form-control" id="input-rw" name="rw">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-alamat" class="form-label">Alamat Lengkap</label>
                                <input type="text" class="form-control" id="input-alamat" name="alamat">
                            </div>
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-tahun-masuk" class="form-label">Tahun Masuk</label>
                                <input type="number" class="form-control" id="input-tahun-masuk" name="tahun-masuk" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-kelas" class="form-label">Kelas</label>
                                <select class="form-select" id="input-kelas" name="kelas" required>
                                    <option value="10">X (Sepuluh)</option>
                                    <option value="11">XI (Sebelas)</option>
                                    <option value="12">XII (Duabelas)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-rombel" class="form-label">Rombel</label>
                                <select class="form-select" id="input-rombel" name="rombel" required>
                                    <?php foreach($rombel as $r) : ?>
                                    <option value="<?= e($r->id) ?>"><?= e($r->name) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    

                <button class="btn btn-primary" type="submit">Tambahkan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const provinsi = document.getElementById('provinsi')
    const kota = document.getElementById('kota')
    const kecamatan = document.getElementById('kecamatan')
    const desa = document.getElementById('desa')

    fetch('https://dev.farizdotid.com/api/daerahindonesia/provinsi').then(e => e.json())
        .then(e => {
            provinsi.querySelector('option').remove()
            e.provinsi.forEach( prov => {
                const node = document.createElement("option");
                const textNode = document.createTextNode(prov.nama);
                node.appendChild(textNode)
                node.value = prov.id
                provinsi.appendChild(node)
            })
        })
    
    provinsi.addEventListener('change', e => {
        
        kota.querySelectorAll('option').forEach(obj => obj.remove())
        kecamatan.querySelectorAll('option').forEach(obj => obj.remove())
        desa.querySelectorAll('option').forEach(obj => obj.remove())

        const node = document.createElement("option");
        const textNode = document.createTextNode("Sedang Memuat...");
        node.appendChild(textNode)
        kota.appendChild(node)

        fetch('https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' + provinsi.value).then(e => e.json())
        .then(e => {
            kota.querySelector('option').remove()
            e.kota_kabupaten.forEach( kab => {
                const node = document.createElement("option");
                const textNode = document.createTextNode(kab.nama);
                node.appendChild(textNode)
                node.value = kab.id
                kota.appendChild(node)
            })
        })
    })

    kota.addEventListener('change', e => {

        kecamatan.querySelectorAll('option').forEach(obj => obj.remove())
        desa.querySelectorAll('option').forEach(obj => obj.remove())
        
        const node = document.createElement("option");
        const textNode = document.createTextNode("Sedang Memuat...");
        node.appendChild(textNode)
        kecamatan.appendChild(node)

        fetch('https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=' + kota.value).then(e => e.json())
        .then(e => {
            kecamatan.querySelector('option').remove()
            e.kecamatan.forEach( kec => {
                const node = document.createElement("option");
                const textNode = document.createTextNode(kec.nama);
                node.appendChild(textNode)
                node.value = kec.id
                kecamatan.appendChild(node)
            })
        })
    })

    kecamatan.addEventListener('change', e => {

        desa.querySelectorAll('option').forEach(obj => obj.remove())
        const node = document.createElement("option");
        const textNode = document.createTextNode("Sedang Memuat...");
        node.appendChild(textNode)
        desa.appendChild(node)

        fetch('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=' + kecamatan.value).then(e => e.json())
        .then(e => {
            desa.querySelector('option').remove()
            e.kelurahan.forEach( kel => {
                const node = document.createElement("option");
                const textNode = document.createTextNode(kel.nama);
                node.appendChild(textNode)
                node.value = kel.id
                desa.appendChild(node)
            })
        })
    })

    document.querySelector('form').addEventListener('submit', function(e){
        e.preventDefault();

        const button = e.target.querySelector('button');
        button.disabled = true;

        const data = new FormData(e.target);

        fetch('.', {
            method: 'POST',
            body: data
        }).then(r => r.json()).then(result => {
            if(result.status === true) gasken(result.link)
            else
            {
                Toast.fire({
                    title: result.message,
                    icon: 'info'
                });
                button.disabled = false;
            }
        }).catch( () => {
            Alert.fire('Kesalahan Sistem!', 'Gagal mengambil data dari server.', 'error').then(() => location.href = '.');
        })
    })
</script>