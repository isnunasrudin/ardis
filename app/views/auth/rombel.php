<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar Peserta Didik</h5>
                </div>
                <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Rombel</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($rombel->count() > 0) : foreach($rombel as $k => $rb) : ?>
                        <tr data-target="<?= e($rb->id) ?>">
                            <th scope="row"><?= e(++$k) ?></th>
                            <td><?= e($rb->name) ?></td>
                            <td><?= e($rb->display_name) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm edit"><i class="fa-solid fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm delete" <?= $rb->siswa->count() > 0 ? 'disabled' : '' ?>><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; else : ?>
                        <tr>
                            <td colspan="4" class="text-center">
                                <span>Tidak Ada Data</span>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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
                        <button class="btn btn-success" id="tambah">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const formFormat = `
            <form class="text-start">
                <div class="form-group mb-4">
                    <label class="form-label">Nama Rombel Ringkas</label>
                    <input class="form-control" name="name" placeholder="Contoh: TKJ 1" />
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Rombel Lengkap</label>
                    <input class="form-control" name="display_name" placeholder="Contoh: Teknik Komputer & Jaringan 1" />
                </div>
            </form>
            `;

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

    function fillValue(name, display_name)
    {
        let data = document.querySelector("form")
        data.querySelector('input[name="name"]').value = name
        data.querySelector('input[name="display_name"]').value = display_name
    }

    document.getElementById('tambah').addEventListener('click', e => {
        Alert.fire({
            title: 'Tambah Rombel',
            showLoaderOnConfirm: true,
            showCancelButton: true,
            didOpen: () => document.querySelector('form').addEventListener('submit', e => {
                e.preventDefault()
            }),
            html: formFormat,
            preConfirm: () => preConfirm('tambah')
        });
    })

    document.querySelectorAll('tr[data-target] .edit').forEach( obj => obj.addEventListener('click', e => {

        const parent = obj.parentElement.parentElement;

        const id = parent.getAttribute('data-target')
        const name = parent.querySelectorAll('td')[0].innerHTML
        const display_name = parent.querySelectorAll('td')[1].innerHTML

        Alert.fire({
            title: 'Edit Rombel',
            showLoaderOnConfirm: true,
            didOpen: () => document.querySelector('form').addEventListener('submit', e => {
                e.preventDefault()
            }),
            html: formFormat,
            didOpen: () => fillValue(name, display_name),
            preConfirm: () => preConfirm('edit', id)
        });
        
    }))

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