<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title) ?> - ARDIS <?= config('sekolah.name') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet"> 
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://bootswatch.com/5/pulse/bootstrap.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('style.css?v=1') ?>">

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= asset('script.js') ?>"></script>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" data-target="<?= url_make('/') ?>">ARDIS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?= url_active('/') ? 'active' : '' ?>" data-target="<?= url_make('/') ?>">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= url_active('sample') ? 'active' : '' ?>" data-target="<?= url_make('sample') ?>">Buat Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= url_active('about') ? 'active' : '' ?>" data-target="<?= url_make('about') ?>">Tentang Kami</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?= url_active('elly') ? 'active' : '' ?>" data-target="<?= url_make('elly') ?>">Masuk</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <?= $content ?>
    </div>
        
    <footer class="d-block text-center">
        <a data-target="<?= url_make('nurul') ?>" class="fs-6">Hak Cipta &copy; 2022 Kelompok 1</a>
    </footer>

</body>
</html>