<div class="container-fluid container-middle">
    <div class="d-flex w-100 h-100">
        <div class="container my-auto">
        <div class="d-block text-center mb-4 mt-4 mt-sm-0">
                <h1 class="text-primary fw-bold display-5">Selayang Pandang</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card bg-success text-light mb-3">
                                <h5 class="card-header">Total Siswa</h5>
                                <div class="card-body">
                                    <div class="display-4 d-inline"><?= e($total_siswa) ?></div>
                                    <span>siswa</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card bg-info text-light mb-3">
                                <h5 class="card-header">Data Rombel</h5>
                                <div class="card-body">
                                    <div class="display-4 d-inline"> <?= e($total_rombel) ?></div>
                                    <span>rombel</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card bg-primary text-light mb-3">
                                <h5 class="card-header">Versi PHP</h5>
                                <div class="card-body">
                                    <div class="display-4 d-inline"><?= phpversion() ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>