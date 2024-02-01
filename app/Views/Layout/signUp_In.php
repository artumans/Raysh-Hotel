<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css') ?>" rel="stylesheet">

    <link href="<?= base_url('assets/css/signUp_In.css') ?>" rel="stylesheet" type="text/css">
    <link rel="icon" href="<?= base_url('assets/icon/ic-logo-pt.svg') ?>">
    <link rel="preload" href="<?= base_url('assets/img/bg-hero.svg') ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    <title>RAYS HOTEL | <?= $title ?></title>

    <script src="<?= base_url('assets/js/jquery.js') ?>" type="text/javascript"></script>

</head>

<body class="position-relative">
    <div class="bg-image"></div>
    <main class="position-absolute top-50 start-50 translate-middle">
        <div class="form-card rounded p-0">
            <div id="form-item" class="form-item d-flex flex-row mb-3 mb-md-5 mx-0 mt-0">
                <button id="sign-in" type="button" data-bs-value="<?=base_url('/signin-form')?>" class="form-menu <?= ($active == 'signin')?'form-active':'' ?> text-center col-6 py-3" onclick="show(this.id)">Sign In</button>
                <button id="sign-up" type="button" data-bs-value="<?=base_url('/signup')?>" class="form-menu <?= ($active == 'signup')?'form-active':'' ?> text-center col-6 py-3" onclick="show(this.id)">Sign Up</button>
            </div>
            <form id="form-layout" class="px-3 px-md-5 pb-3 pb-md-5">
                <?=$preset?>
            </form>
        </div>
    </main>
    <script src="<?=base_url('assets/js/signUp_In.js')?>"></script>
</body>
</html>