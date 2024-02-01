<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="<?= base_url('assets/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css') ?>" rel="stylesheet">

  <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?= base_url('assets/css/sidebar-profile.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?= base_url('assets/css/' . $page . '.css') ?>" rel="stylesheet" type="text/css">
  <link rel="icon" href="<?= base_url('assets/icon/ic-logo-pt.svg') ?>">
  <link rel="preload" href="<?= base_url('assets/img/bg-hero.svg') ?>">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- icons -->

  <title><?= $title ?> | Rays Hotel</title>
</head>

<body>

  <!-- <div class="container container-utama">
  </div> -->

  <!-- navbar -->
  <?= $this->include('Layout/Navbar'); ?>

  <?= $this->include('Layout/sidebar_profile'); ?>

  <!-- content -->
  <?= $this->renderSection('content'); ?>

  <!-- Footer -->
  <?= $this->renderSection('Footer'); ?>

  <!-- Optional JavaScript; choose one of the two! -->
  <script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- icons -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>