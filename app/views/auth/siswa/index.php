<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar Peserta Didik</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col" class="d-none d-lg-table-cell">NISN</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col" class="d-none d-lg-table-cell">Ditambahkan Pada</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($peserta_didik->count() > 0) : foreach($peserta_didik as $k => $siswa) : ?>
                                <tr data-target="<?= e($siswa->id) ?>">
                                    <th scope="row"><?= e(++$k) ?></th>
                                    <td><?= e($siswa->akun->full_name) ?></td>
                                    <td class="d-none d-lg-table-cell"><?= e($siswa->nisn) ?></td>
                                    <td><?= e($siswa->kelas ?? '') . ' ' . e($siswa->rombel->name) ?></td>
                                    <td class="d-none d-lg-table-cell"><?= e($siswa->created_at) ?></td>
                                    <td class="d-flex gap-1">
                                        <a class="btn btn-sm btn-success" data-target="<?= e(url_make('auth.siswa.view', ['id' => $siswa->id])) ?>"><i class="fa-solid fa-eye"></i></a>
                                        <a class="btn btn-sm btn-warning" data-target="<?= e(url_make('auth.siswa.edit', ['id' => $siswa->id])) ?>"><i class="fa-solid fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger delete"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php endforeach; else : ?>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <span>Tidak Ada Data</span>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Aksi</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <?php if($add_enable) : ?>
                        <button class="btn btn-success" data-target="<?= e(url_make('auth.siswa.tambah')) ?>">Tambah</button>
                        <!-- <button class="btn btn-success" data-target="<?= e(url_make('/')) ?>">Tambah Massal</button>
                        <hr />
                        <button class="btn btn-danger" data-target="<?= e(url_make('/')) ?>">Hapus Semua</button> -->
                        <?php else : ?>
                        <button class="btn btn-success" disabled="false">Tambah</button>
                        <p>
                            <i class="fa-solid fa-circle-info"></i> Untuk menambah data peserta didik, silahkan tambahkan <a class="text-success" data-target="<?= url_make('auth.rombel') ?>">rombel</a> terlebih dahulu
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    

    function preConfirm(action, id = null, data = null)
    {
        if(data === null)
        {
            
            data = document.querySelector("form")
            data = new FormData(data)
            data.append('action', action)
            if(data.id !== null) data.append('id', id)
        }
        
        return fetch(".", {
            method: 'POST',
            body: data
        }).then(e => e.json()).then(e => {
            if(e.status == false) Alert.showValidationMessage(e.message);
            else location.href = '.';
        }).catch(() => {
            Alert.fire('Oh Tidak!', 'Terjadi kesalahan pada server!', 'error')
                .then(() => location.href = '.')
        })
    }

    document.querySelectorAll('tr[data-target] .delete').forEach( obj => obj.addEventListener('click', e => {

        const parent = obj.parentElement.parentElement;
        console.log(parent)

        const id = parent.getAttribute('data-target')
        const name = parent.querySelectorAll('td')[0].innerHTML
        const display_name = parent.querySelectorAll('td')[1].innerHTML

        const data = new FormData();
        data.append('id', id)
        data.append('action', 'delete')

        Alert.fire({
            title: 'Yakin Hapus?',
            text: 'Anda yakin ingin menghapus ' + name + ' ?',
            icon: 'question',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            preConfirm: () => preConfirm('delete', null, data)
        });

    }))
</script>