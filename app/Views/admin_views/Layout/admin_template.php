<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css') ?>" rel="stylesheet">

    <link href="<?= base_url('assets/css/admin_styles/style.css') ?>" rel="stylesheet" type="text/css">
    <link rel="icon" href="<?= base_url('assets/icon/ic-logo-pt.svg') ?>">
    <link rel="preload" href="<?= base_url('assets/img/bg-hero.svg') ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    <title>Admin | Dashboard</title>
</head>

<body>
    <div id="admin-nav" class="admin-nav row row-cols-2 g-0">
        <div class="sidebar col-12 col-md-3 col-lg-2 px-3 d-flex flex-column justify-content-between">
            <div class="upper-nav d-flex flex-column">
                <div class="brand mt-2 mb-4 text-center d-flex justify-content-center align-items-end">
                    <img style="width:4rem;" class="nav-brand me-2" src="<?= base_url('assets/img/logo-hotel.svg') ?>" alt="">
                    <h4 class="fw-bolder">Admin</h4>
                </div>
                <a id="menuDashboard" data-bs-value="<?= base_url('admin/dashboard') ?>" class="menu-nav d-flex align-items-center active-menu" onclick="setActive(this.id)">
                    <ion-icon class="menu-nav-ic" name="apps-outline"></ion-icon>
                    <span>Dashboard</span>
                </a>
                <a id="menuReservation" data-bs-value="<?= base_url('admin/reservation') ?>" class="menu-nav d-flex align-items-center" onclick="setActive(this.id)">
                    <ion-icon class="menu-nav-ic" name="time-outline"></ion-icon>
                    <span>Reservation</span>
                </a>
                <a id="menuRoom" data-bs-value="<?= base_url('admin/room') ?>" class="menu-nav d-flex align-items-center" onclick="setActive(this.id)">
                    <ion-icon class="menu-nav-ic" name="bed-outline"></ion-icon>
                    <span>Rooms</span>
                </a>
            </div>
            <!-- <div class="dropdown dropup pb-3">
                <button class="btn-profile w-100 d-flex align-items-center justify-content-around dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<? //=base_url('assets/img/admin-avatar.png')
                                ?>" alt="mdo" width="24" height="24" class="rounded-circle">
                    <strong>Bayu</strong>
                </button>
                <ul class="dropdown-menu text-small shadow">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item d-inline-flex align-items-center" href="#"><ion-icon class="menu-nav-ic" name="power-outline"></ion-icon> Sign out</a></li>
                </ul>
            </div> -->
            <a href="<?= base_url('admin/logout') ?>" class="menu-nav d-flex align-items-center">
                <ion-icon class="menu-nav-ic" name="power-outline"></ion-icon>
                <span class="me-3">Logout</span>
            </a>
        </div>
        <div class="main-content col-12 col-md-9 col-lg-10">
            <div id="scrollspace" class="px-5">
                <?= $preset ?>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/jquery.js') ?>" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/admin.js') ?>" type="text/javascript"></script>
</body>

</html>