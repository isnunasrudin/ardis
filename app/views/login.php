<div class="container-fluid container-middle">
  <div class="d-flex w-100 h-100 pb-5">
      <section id="MASUK" class="my-auto mx-auto" style="width: 500px">
        <div class="card">
          <div class="card-header text-center">
            <h5 class="card-title">Silahkan Masuk!</h5>
          </div>
          <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                  <label for="input_1" class="form-label">Alamat Surel (GTK) / NISN (Siswa)</label>
                  <input type="text" class="form-control" id="input_1" placeholder="Masukkan Email/NISN" name="input_1" required>
                </div>
                <div class="mb-3">
                  <label for="input_2" class="form-label">Kata Sandi (GTK) / Tanggal Lahir (Siswa)</label>
                  <input type="password" class="form-control" id="input_2" placeholder="Masukkan Kata Sandi/Tgl. Lahir" name="input_2" required>
                  <small class="form-text text-muted"><i class="fa-solid fa-circle-info"></i> Format Tgl. Lahir: <?= e(date('Y-m-d')) ?></small>
                </div>
                <button type="submit" class="btn btn-primary mx-auto d-block px-4"><i class="fas fa-sign-in"></i> LOGIN</button>
            </form>
          </div>
        </div>
      </section>
  </div>
</div>