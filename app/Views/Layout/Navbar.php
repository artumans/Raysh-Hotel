<nav class="nvbr navbar navbar-expand-md">
    <div class="nav-con container-fluid px-4 my-2">
        <!-- <a class="navbar-brand" href=" <?= base_url('home'); ?>">RAYS HOTEL</a> -->
        <img style="height: 100%;" class="nav-brand" src="<?= base_url('assets/img/logo-hotel.svg') ?>" alt="">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="nav-konten collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item mx-4">
                    <a class="nav-link" aria-current="page" href=" <?= base_url('/'); ?>">Home</a>
                </li>
                <li class="nav-item mx-4">
                    <a class="nav-link" href=" <?= base_url('home'); ?>">Rooms</a>
                </li>
                <li class="nav-item mx-4">
                    <a class="nav-link" href=" <?= base_url('home'); ?> ">Contact</a>
                </li>
                <li class="nav-item mx-4">
                    <?php if (isset($_SESSION['user'])) : ?>
                        <div class="div-btn-login rounded-circle">
                            <a type="button" class="btn" href="<?= base_url('/profile'); ?>">
                                <img src="<?=base_url('assets/img/user-avatar.png')?>" class="rounded-circle" alt="" width="35px" height="35px">
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="div-btn-login">
                            <a type="button" class="btn-login btn" href="<?= base_url('/signin'); ?>">
                                <span class="btn-text-login">Login</span>
                                <span class="btn-icons-login">
                                    <ion-icon name="chevron-forward-outline"></ion-icon>
                                </span>
                            </a>
                        </div>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>