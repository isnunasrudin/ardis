<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title) ?> - Arsip Digital Siswa</title>
    <link href="https://bootswatch.com/5/vapor/bootstrap.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('style.css') ?>">
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
                    <a class="nav-link <?= url_active('nurul') ? 'active' : '' ?>" data-target="<?= url_make('nurul') ?>">Nurul</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= url_active('elly') ? 'active' : '' ?>" data-target="<?= url_make('elly') ?>">Elly</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= url_active('zhen') ? 'active' : '' ?>" data-target="<?= url_make('zhen') ?>">Zhen</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <?= $content ?>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
    <script src="<?= asset('script.js') ?>"></script>
</body>
</html>