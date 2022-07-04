<div class="container">
    <div class="d-flex">
        <button class="btn btn-secondary" data-target="<?= e(url_make('auth.siswa')) ?>">Kembali</button>
        <h5>Tambah Siswa</h5>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar Peserta Didik</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group mb-4">
                        <label for="exampleInputEmail1" class="form-label">Nomor Induk Siswa Nasional</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="exampleInputEmail1" class="form-label">Tempat Lahir</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="exampleInputEmail1" class="form-label">Provinsi</label>
                                <select class="form-select" id="provinsi">
                                    <option value="">Sedang Memuat...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="exampleInputEmail1" class="form-label">Kabupaten</label>
                                <select class="form-select" id="kota">
                                </select>
                            </div>
                        </div>
                        <div class="col ">
                            <div class="form-group mb-4">
                                <label for="exampleInputEmail1" class="form-label">Kecamatan</label>
                                <select class="form-select" id="kecamatan">
                                </select>
                            </div>
                        </div>
                        <div class="col ">
                            <div class="form-group mb-4">
                                <label for="exampleInputEmail1" class="form-label">Desa</label>
                                <select class="form-select" id="desa">
                                    <option value="">SILAHKAN PILIH...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col-1">
                            <div class="form-group mb-4">
                                <label for="exampleInputEmail1" class="form-label">Rt.</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group mb-4">
                                <label for="exampleInputEmail1" class="form-label">Rt.</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="exampleInputEmail1" class="form-label">Alamat Lengkap</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="exampleInputEmail1" class="form-label">Tahun Masuk</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="exampleInputEmail1" class="form-label">Kelas</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="exampleInputEmail1" class="form-label">Rombongan Belajar</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
</script>