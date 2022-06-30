<div class="d-flex w-100 h-100 pb-5">
    <section id="MASUK" class="my-auto mx-auto" style="width: 500px">
      <div class="card">
        <div class="card-header text-center">
          <h5 class="card-title">Silahkan Masuk!</h5>
        </div>
        <div class="card-body">
          <form method="POST">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Alamat Surel (GTK) / NISN (Siswa)</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Email/NISN">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Kata Sandi (GTK) / Tanggal Lahir (Siswa)</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Kata Sandi/Tgl. Lahir">
                <small class="form-text text-muted"><i class="fa-solid fa-circle-info"></i> Format Tgl. Lahir: <?= date('Y-m-d') ?></small>
              </div>
              <button type="submit" class="btn btn-primary mx-auto d-block">LOGIN</button>
          </form>
        </div>
      </div>
    </section>
</div>