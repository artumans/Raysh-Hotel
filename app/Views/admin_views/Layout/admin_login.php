<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css') ?>" rel="stylesheet">

    <link href="<?= base_url('assets/css/admin_styles/admin_login.css') ?>" rel="stylesheet" type="text/css">
    <link rel="icon" href="<?= base_url('assets/icon/ic-logo-pt.svg') ?>">
    <link rel="preload" href="<?= base_url('assets/img/bg-hero.svg') ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    <title>Admin | Login</title>

    <script src="<?= base_url('assets/js/jquery.js') ?>" type="text/javascript"></script>

</head>

<body class="position-relative">
    <div class="bg-image"></div>
    <main class="position-absolute top-50 start-50 translate-middle">
        <div class="form-card rounded p-0">
            <div class="px-3 pt-3 mb-5 text-center d-flex justify-content-center align-items-center">
                <img style="width:5.5rem;" class="nav-brand me-2" src="<?= base_url('assets/img/logo-hotel.svg') ?>" alt="">
                <h2 class="fw-bolder">Admin</h2>
            </div>
            <form id="form-layout" class="px-3 px-md-5 pb-3 pb-md-5">
                <?php echo session()->getFlashdata('failed'); ?>
                <div class="row mb-3">
                    <label for="adminEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="adminEmail" id="adminEmail" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="adminPass" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="adminPass" id="adminPass" required>
                    </div>
                </div>
                <button type="submit" class="btn w-100 mt-5" formaction="<?=site_url('admin/signin')?>" formmethod="post">Sign in</button>
            </form>
        </div>
    </main>
    <script src="<?=base_url('assets/js/signUp_In.js')?>"></script>
</body>
</html>