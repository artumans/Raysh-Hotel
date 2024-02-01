<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link href="<?=base_url('assets/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css')?>" rel="stylesheet">
</head>
<body class="bg-dark px-4">
    <nav class="mx-2 mb-5 mt-2 navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <img style="width: 15%;" src="<?=base_url('assets/img/logo_dark_v2.png')?>" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11" aria-controls="navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse d-lg-flex" id="navbarsExample11">
                <ul class="navbar-nav col-lg-10 justify-content-lg-center fs-5">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url('/') ?>">Reservation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Rooms</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">More</a>
                        <ul class="dropdown-menu">
                            <li class="mx-2 mb-2"><a class="dropdown-item rounded active" href="#">About Us</a></li>
                            <li class="mx-2"><a class="dropdown-item rounded" href="#">Contact Us</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-lg-flex col-lg-2 col-sm-2 justify-content-lg-end">
                    <button class="btn btn-outline-secondary">Login</button>
                    <button class="btn btn-dark ms-2 text-nowrap">Sign Up</button>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="content">
            <?= $this->renderSection('content'); ?>
        </div>
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <span class="mb-3 mb-md-0 text-muted">
                    <p class="text-light">&copy; 2023 | K7 - Pengembangan Back-End G</p>
                </span>
            </div>
        </footer>
    </div>
    <script src="<?=base_url('assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js')?>"></script>
</body>
</html>