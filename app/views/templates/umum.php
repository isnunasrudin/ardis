<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title) ?> - ARDIS <?= config('sekolah.name') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://bootswatch.com/5/pulse/bootstrap.min.css">
    <link rel="stylesheet" href="<?= asset('style.css?v=1') ?>">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= asset('script.js?v=1') ?>"></script>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg <?= auth()::check() ? 'py-lg-2' : '' ?> navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" data-target="<?= url_active('auth.home') ? url_make('auth.home') : url_make('/') ?>">ARDIS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                
                <?php if(auth()::check()) : ?>
                <li class="nav-item">
                    <a class="nav-link <?= url_active('auth.home') ? 'active' : '' ?>" data-target="<?= url_make('auth.home') ?>">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= url_active('auth.siswa') ? 'active' : '' ?>" data-target="<?= url_make('auth.siswa') ?>">Peserta Didik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= url_active('auth.rombel') ? 'active' : '' ?>" data-target="<?= url_make('auth.rombel') ?>">Rombongan Belajar</a>
                </li>
                <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link <?= url_active('/') ? 'active' : '' ?>" data-target="<?= url_make('/') ?>">Beranda</a>
                </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link <?= url_active('about_us') ? 'active' : '' ?>" data-target="<?= url_make('about_us') ?>">Tentang Kami</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if(auth()::check()) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= url_active('logout') ? 'active' : '' ?> " role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= e(auth()::user()->avatar_link) ?>" width="46" height="46" class="rounded-circle bg-white me-2">
                        <?= e(auth()::user()->full_name) ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" data-target="<?= url_make('logout') ?>">Keluar</a></li>
                    </ul>
                </li>
                <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link <?= url_active('login') ? 'active' : '' ?>" data-target="<?= url_make('login') ?>">Masuk</a>
                </li>
                <?php endif; ?>
            </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <?= $content ?>
    </div>
        
    <footer class="d-block text-center">
        <a data-target="<?= url_make('nurul') ?>" class="fs-6">2022 - Dikembangkan Oleh Kelompok 1</a>
    </footer>

</body>
</html>