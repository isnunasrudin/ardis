<div class="d-flex w-100 h-100 pb-5">
    <section id="SELAMAT_DATANG" class="my-auto mx-auto" style="width: 650px">
        <div class="d-block text-center mb-4 mt-4 mt-sm-0">
            <h1 class="text-primary fw-bold display-5">Arsip Digital Siswa</h1>
            <p class="text-secondary fw-bold">Selamat datang di layanan Arsip Digital Siswa. Layanan ini diperuntukkan sebagai sistem pendataan bagi siswa-siswi <?= e(config('sekolah.name')) ?>.</p>
        </div>
        <div class="card">
            <div class="card-body">
                <form class="form-group text-center text-sm-start" method="POST">
                    <label for="nisn-search" class="form-label">Cari dengan NISN!</label>
                    <div class="row g-2">
                        <div class="col">
                            <input type="text" class="form-control" id="nisn-search" placeholder="Masukkan NISN (Nomor Induk Siswa Nasional)" required pattern="\w{10}" name="nisn">
                        </div>
                        <div class="col-sm-auto">
                            <button class="btn btn-primary px-5"><i class="fa-solid fa-magnifying-glass"></i> CARI!</button>
                        </div>
                    </div>
                    <small class="form-text text-muted"><i class="fa-solid fa-circle-info"></i> NISN adalah nomor unik yang dimiliki tiap peserta didik</small>
                </form>
            </div>
        </div>
    </section>
</div>