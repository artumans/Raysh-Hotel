<?= $this->extend('layout/Tamplate'); ?>

<?= $this->section('content') ?>

<main class="main container">
    <?php echo session()->getFlashdata('updateInfo'); ?>
    <div class="row border rounded mt-md-4">
        <div class="col-12 col-md-3 menu-container pt-4 px-3 pb-4">
            <nav id="user-menu" class="h-100 d-flex flex-column justify-content-between">
                <div class="d-flex flex-column">
                    <div class="simple-profile text-center mb-4">
                        <img src="<?=base_url('assets/img/user-avatar.png')?>" class="rounded-circle mb-2" alt="" width="100px" height="100px">
                        <h5 class="fw-bolder"><?=$_SESSION['user']['nama']?></h5>
                    </div>
                    <a id="menu-history" data-bs-value="<?=base_url('/profile/history')?>" class="menu-item d-flex align-items-center active-menu" onclick="setActive(this.id)">
                        <ion-icon class="menu-item-ic" name="time-outline"></ion-icon>
                        <span>Booking History</span>
                    </a>
                    <a id="menu-profile" data-bs-value="<?=base_url('/profile/userprofile')?>" class="menu-item d-flex align-items-center" onclick="setActive(this.id)">
                        <ion-icon class="menu-item-ic" name="person-outline"></ion-icon>
                        <span>Profile</span>
                    </a>
                    <!-- <a id="menu-settings" data-bs-value="<?//=base_url('/profile/settings')?>" class="menu-item d-flex align-items-center" onclick="setActive(this.id)">
                        <ion-icon class="menu-item-ic" name="cog-outline"></ion-icon>
                        <span>Settings</span>
                    </a> -->
                </div>
                <a href="<?=base_url('/signout')?>" class="menu-item d-flex align-items-center">
                    <ion-icon class="menu-item-ic" name="power-outline"></ion-icon>
                    <span class="me-3">Logout</span>
                </a>
            </nav>
        </div>
        <div class="col-12 col-md-9 main-container">
            <div data-bs-spy="scroll" data-bs-smooth-scroll="true" id="content-container" class="scrollspy-example" tabindex="0">
                <?=$preset?>
            </div>
        </div>
    </div>
</main>

<script src="<?= base_url('assets/js/' . $page . '.js') ?>"></script>


<?= $this->endSection() ?>