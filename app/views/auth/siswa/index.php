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
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Berkas</th>
                            <th scope="col">Ditambahkan Pada</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($peserta_didik->count() > 0) : foreach($peserta_didik as $k => $siswa) : ?>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
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
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Aksi</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-success" data-target="<?= e(url_make('auth.siswa.tambah')) ?>">Tambah</button>
                        <button class="btn btn-success" data-target="<?= e(url_make('/')) ?>">Tambah Massal</button>
                        <hr />
                        <button class="btn btn-danger" data-target="<?= e(url_make('/')) ?>">Hapus Semua</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>