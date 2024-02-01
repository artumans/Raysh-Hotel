<nav id="sidebarMenu" class="sidebar collapse d-lg-block collapse">
    <div class="position-sticky">

        <div class="list-item mx-3 mt-4">

            <a href=" <?= base_url('/historybooking'); ?>" class="list-group-item list-group-item-action py-2 ripple">
                <i class="fas fa-chart-area fa-fw me-3"></i>
                <span class="me-3">History Booking</span>
            </a>

            <a href=" <?= base_url('/jadwal'); ?>" class="list-group-item list-group-item-action py-2 ripple">
                <i class="fas fa-chart-area fa-fw me-3"></i>
                <span class="me-3">Profile</span>
            </a>

            <a href=" <?= base_url('/laporan'); ?>" class="list-group-item list-group-item-action py-2 ripple">
                <i class="fas fa-lock fa-fw me-3"></i>
                <span class="me-3">Setting</span>
            </a>


            <div class="login-logout">
                <?php if (auth()->loggedIn()) : ?>

                    <a href="<?= site_url('/logout'); ?>" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fa-solid fa-arrow-right-from-bracket me-3"></i>
                        <span class="me-3">Logout</span>
                    </a>
                <?php else : ?>

                    <a href="<?= site_url('/login'); ?>" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fa-solid fa-arrow-right-to-bracket me-3"></i>
                        <span class="me-3">Login</span>
                    </a>

                <?php endif; ?>
            </div>

        </div>
    </div>
</nav>