<div class="container">
    <?php if(auth()::user()->isRole('admin', 'kepsek')) : ?>
    <div class="d-flex">
        <button class="btn btn-secondary" data-target="<?= e(url_make('auth.siswa')) ?>">Kembali</button>
        <h5>Lihat Siswa</h5>
    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-9">
            <form class="card" method="POST">
                <div class="card-header">
                    <h5 class="card-title">Data Peserta Didik</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label for="input-nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="input-nama" name="nama" required value="<?= e($siswa->akun->full_name) ?>">
                    </div>
                    <div class="form-group mb-4">
                        <label for="input-nisn" class="form-label">Nomor Induk Siswa Nasional</label>
                        <input type="text" class="form-control" id="input-nisn" name="nisn" required value="<?= e($siswa->nisn) ?>">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-tempat-lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="input-tempat-lahir" name="tempat-lahir" required value="<?= e($siswa->born_place) ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-tgl-lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="input-tgl-lahir" name="tgl-lahir" required value="<?= e($siswa->born_date) ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="input-email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="input-email" name="email" required value="<?= e($siswa->akun->email) ?>">
                    </div>
                    <div class="form-group mb-4">
                        <label for="input-asal-sekolah" class="form-label">Asal Sekolah</label>
                        <input type="text" class="form-control" id="input-asal-sekolah" name="asal-sekolah" required value="<?= e($siswa->asal_sekolah) ?>">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <select class="form-select" id="provinsi" name="provinsi" required>
                                    <option value="">Sedang Memuat...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="kota" class="form-label">Kabupaten</label>
                                <select class="form-select" id="kota" name="kota" required>
                                </select>
                            </div>
                        </div>
                        <div class="col ">
                            <div class="form-group mb-4">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <select class="form-select" id="kecamatan" name="kecamatan" required>
                                </select>
                            </div>
                        </div>
                        <div class="col ">
                            <div class="form-group mb-4">
                                <label for="desa" class="form-label">Desa</label>
                                <select class="form-select" id="desa" name="desa" required>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col-1">
                            <div class="form-group mb-4">
                                <label for="input-rt" class="form-label">Rt.</label>
                                <input type="number" class="form-control" id="input-rt" name="rt" value="<?= e($siswa->rt) ?>">
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group mb-4">
                                <label for="input-rw" class="form-label">Rw.</label>
                                <input type="number" class="form-control" id="input-rw" name="rw" value="<?= e($siswa->rw) ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-alamat" class="form-label">Alamat Lengkap</label>
                                <input type="text" class="form-control" id="input-alamat" name="alamat" value="<?= e($siswa->address_street) ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-tahun-masuk" class="form-label">Tahun Masuk</label>
                                <input type="number" class="form-control" id="input-tahun-masuk" name="tahun-masuk" required value="<?= e($siswa->tahun_masuk) ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-kelas" class="form-label">Kelas</label>
                                <select class="form-select" id="input-kelas" name="kelas" required>
                                    <option value="10" <?= $siswa->kelas == "10" ? 'selected' : '' ?>>X (Sepuluh)</option>
                                    <option value="10" <?= $siswa->kelas == "11" ? 'selected' : '' ?>>XI (Sebelas)</option>
                                    <option value="10" <?= $siswa->kelas == "12" ? 'selected' : '' ?>>XII (Dua Belas)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-rombel" class="form-label">Rombongan Belajar</label>
                                <select class="form-select" id="input-rombel" name="rombel" required>
                                    <?php foreach($rombel as $r) : ?>
                                    <option value="<?= e($r->id) ?>" <?= $r->id === $siswa->rombel_id ? 'selected' : '' ?>><?= e($r->name) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Simpan Data</button>
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

    let init = true;
    
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
        }).then(() => {
            if(init) {
                kota.value = "<?= $siswa->kota ?>"
                kota.dispatchEvent(new Event('change'))
            }
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
        }).then(() => {
            if(init) {
                kecamatan.value = "<?= $siswa->kecamatan ?>"
                kecamatan.dispatchEvent(new Event('change'))
            }
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
        }).then(() => {
            if(init) {
                init = false
                desa.value = "<?= $siswa->desa ?>"
                desa.dispatchEvent(new Event('change'))
            }
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
        }).then(() => {
            provinsi.value = "<?= $siswa->provinsi ?>"
            provinsi.dispatchEvent(new Event('change'))
        })

</script>   