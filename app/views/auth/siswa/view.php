<div class="container">
    <div class="d-flex">
        <button class="btn btn-secondary" data-target="<?= e(url_make('auth.siswa')) ?>">Kembali</button>
        <h5>Lihat Siswa</h5>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <form class="card" method="POST">
                <div class="card-header">
                    <h5 class="card-title">Data Peserta Didik</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label for="input-nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="input-nama" name="nama" disabled value="<?= e($siswa->akun->full_name) ?>">
                    </div>
                    <div class="form-group mb-4">
                        <label for="input-nisn" class="form-label">Nomor Induk Siswa Nasional</label>
                        <input type="text" class="form-control" id="input-nisn" name="nisn" disabled value="<?= e($siswa->nisn) ?>">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-tempat-lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="input-tempat-lahir" name="tempat-lahir" disabled value="<?= e($siswa->born_place) ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-tgl-lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="input-tgl-lahir" name="tgl-lahir" disabled value="<?= e($siswa->born_date) ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="input-email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="input-email" name="email" disabled value="<?= e($siswa->akun->email) ?>">
                    </div>
                    <div class="form-group mb-4">
                        <label for="input-asal-sekolah" class="form-label">Asal Sekolah</label>
                        <input type="text" class="form-control" id="input-asal-sekolah" name="asal-sekolah" disabled value="<?= e($siswa->asal_sekolah) ?>">
                    </div>
                    <div class="row g-1">
                        <div class="col-2">
                            <div class="form-group mb-4">
                                <label for="input-rt" class="form-label">Rt.</label>
                                <input type="number" class="form-control" id="input-rt" name="rt" value="<?= e($siswa->rt) ?>" disabled>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group mb-4">
                                <label for="input-rw" class="form-label">Rw.</label>
                                <input type="number" class="form-control" id="input-rw" name="rw" value="<?= e($siswa->rw) ?>" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-alamat" class="form-label">Alamat Lengkap</label>
                                <input type="text" class="form-control" id="input-alamat" name="alamat" value="<?= e($siswa->address_street) ?>" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="desa" class="form-label">Kode Alamat</label>
                                <input type="text" class="form-control" id="input-alamat" name="alamat" value="<?= e($siswa->address_code) ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-tahun-masuk" class="form-label">Tahun Masuk</label>
                                <input type="number" class="form-control" id="input-tahun-masuk" name="tahun-masuk" disabled value="<?= e($siswa->tahun_masuk) ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="input-kelas" name="kelas" value="<?= e($siswa->kelas) ?>" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="input-rombel" class="form-label">Rombongan Belajar</label>
                                <input type="text" class="form-control" id="input-rombel" name="rombel" value="<?= e($siswa->rombel->name) ?>" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-primary" data-target="<?= e(url_make('auth.siswa.edit', ['id' => $siswa->id])) ?>">Tambahkan Data</a>
                </div>
            </form>
        </div>
    </div>
</div>