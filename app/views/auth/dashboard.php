<div class="container-fluid container-middle">
    <div class="d-flex w-100 h-100">
        <div class="container my-auto">
            <div class="row justify-content-center w-100">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="card bg-success text-light mb-3">
                                <h5 class="card-header">Total Siswa</h5>
                                <div class="card-body">
                                    <div class="display-4 d-inline"><?= e($total_siswa) ?></div>
                                    <span>siswa</span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-info text-light mb-3">
                                <h5 class="card-header">Data Berkas</h5>
                                <div class="card-body">
                                    <div class="display-4 d-inline"> <?= e($total_berkas) ?></div>
                                    <span>berkas</span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-primary text-light mb-3">
                                <h5 class="card-header">Versi PHP</h5>
                                <div class="card-body">
                                    <div class="display-4 d-inline"><?= phpversion() ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="card">
                        <div class="card-header">
                            <h5>Aktivitas Terakhir</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>