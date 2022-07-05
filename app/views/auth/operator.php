<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar Operator</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($operator->count() > 0) : foreach($operator as $k => $op) : ?>
                                <tr data-target="<?= e($op->id) ?>">
                                    <th scope="row"><?= e(++$k) ?></th>
                                    <td><?= e($op->full_name) ?></td>
                                    <td><?= e($op->email) ?></td>
                                    <td class="d-flex gap-1">
                                        <button class="btn btn-warning btn-sm edit"><i class="fa-solid fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm delete"><i class="fa-solid fa-trash"></i></button>
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
    let helper = "";
    const formFormat = `
            <form class="text-start">
                <div class="form-group mb-4">
                    <label class="form-label">Nama Lengkap</label>
                    <input class="form-control" name="name" />
                </div>
                <div class="form-group mb-4">
                    <label class="form-label">Email</label>
                    <input class="form-control" name="email" />
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input class="form-control" name="password" />`+helper+`</div>
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

    function fillValue(name, email)
    {
        let data = document.querySelector("form")
        data.querySelector('input[name="name"]').value = name
        data.querySelector('input[name="email"]').value = email
    }

    document.getElementById('tambah').addEventListener('click', e => {
        helper = ""
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

        helper = `
                    <small class="form-text text-muted"><i class="fa-solid fa-circle-info"></i> Kosongi jika tidak ingin mengubah sandi</small>
                `;

        const parent = obj.parentElement.parentElement;

        const id = parent.getAttribute('data-target')
        const name = parent.querySelectorAll('td')[0].innerHTML
        const email = parent.querySelectorAll('td')[1].innerHTML

        Alert.fire({
            title: 'Edit Rombel',
            showLoaderOnConfirm: true,
            didOpen: () => document.querySelector('form').addEventListener('submit', e => {
                e.preventDefault()
            }),
            html: formFormat,
            didOpen: () => fillValue(name, email),
            preConfirm: () => preConfirm('edit', id)
        });
        
    }))

    document.querySelectorAll('tr[data-target] .delete').forEach( obj => obj.addEventListener('click', e => {

        const parent = obj.parentElement.parentElement;
        
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