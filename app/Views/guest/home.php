<?= $this->extend('layout/Tamplate'); ?>

<?= $this->section('content') ?>

<section id="hero-background">
    <div class="hero-con container blur">
        <div class="tagline-hero col-md-9 col-lg-7 my-auto">
            <div class="tagline">
                <h1 class="heading-hero" id="heading-hero"></h1>
                <p class="describe-hero">Feel the sensation of staying in <span class="text-block">Rays hotel</span><br>
                    beside being comfortable, Rays offer<br>
                    <span class="text-block">affordable price</span> and <span class="text-block">quality.</span>
                </p>
            </div>
            <div class="form-con-hero container align-items-start">
                <form class="form-check-hero row row-gap-2">
                    <div class="form-check-col-hero mx-auto my-2 col-12 col-lg-4 col-md-4 col-sm-6">
                        <label for="dp_checkIn" class="label-hero form-label">Check-In</label>
                        <input type="date" class="form-cek-in-out-hero form-control fs-6" id="dp_checkIn" name="dp_checkIn" value="<?= $checkInValue ?>" min="<?= $minCheckIn ?>" max="<?= $maxCheckIn ?>" onchange="setCheckOut_dp2()">
                    </div>
                    <div class="form-check-col-hero mx-auto my-2 col-12 col-lg-4 col-md-4 col-sm-6">
                        <label for="dp_checkOut" class="label-hero form-label">Check-Out</label>
                        <input type="date" class="form-cek-in-out-hero form-control fs-6" id="dp_checkOut" name="dp_checkOut" value="<?= $checkOutValue ?>" min="<?= $minCheckOut ?>" max="<?= $maxCheckOut ?>">
                    </div>
                    <div class="div-btn-hero col-lg-4 col-md-4 col-sm-12 col-12 p-0">
                        <button type="submit" class="btn-cari-hero btn h-100 w-100" formaction="<?= base_url('#list-card-rooms') ?>" formmethod="post">
                            <span class="btn-icons-cari-hero">
                                <ion-icon name="search"></ion-icon>
                                <span class="btn-text-cari-hero">Search</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>

<!-- Section Card Rooms -->
<section id="card-rooms">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-12">
                    <h3 class="heading-section-rooms">Rooms Available for You</h3>
                </div>
            </div>

            <div class="row" id="list-card-rooms">
                <?php
                for ($i = 0; $i < count($roomFacilities); $i++) {
                    echo '<div class="col-lg-4 col-md-12 mt-3 col-sm-12 mt-2" id="cards-rooms-langsung">
                        <div class="card card-rooms p-4">
                            <img class="img-card w-100" alt="">
                            <div class="card-body   position-relative">
                                <h3 class="card-heading">' . $roomFacilities[$i]->nama_tipe . ' Rooms</h3>
                                <div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="availRoom">
                                            <p class="card-text">Available : ';
                                                if ($roomFacilities[$i]->availRoom == 3) {
                                                    echo '<span class="badge text-bg-success rounded">' . $roomFacilities[$i]->availRoom . ' Rooms</span>';
                                                } elseif ($roomFacilities[$i]->availRoom == 2) {
                                                    echo '<span class="badge text-bg-warning rounded">' . $roomFacilities[$i]->availRoom . ' Rooms</span>';
                                                } elseif ($roomFacilities[$i]->availRoom == 1) {
                                                    echo '<span class="badge text-bg-danger rounded">' . $roomFacilities[$i]->availRoom . ' Room</span>';
                                                } else {
                                                    echo '<span class="badge text-bg-secondary rounded">' . $roomFacilities[$i]->availRoom . ' Room</span>';
                                                }
                                            echo '</p>
                                        </div>
                                        <div class="capacity d-flex">';
                                            if ($roomFacilities[$i]->nama_tipe == "Prajurit") {
                                                echo '<p class="card-text">Capacity : 1 </p>';
                                            } else {
                                                echo '<p class="card-text">Capacity : 2 </p>';
                                            }
                                            echo '<ion-icon class="fs-5 ms-1" name="people-outline"></ion-icon>
                                        </div>
                                    </div>
                                </div>
                                <div class="div-fasilitas">
                                    <div class="fasilitas">
                                        <span class="btn-icons-fas">
                                            <ion-icon name="bed-outline"></ion-icon>
                                        </span>
                                        <span class="btn-text-fas">' . $roomFacilities[$i]->tipe_kasur . '</span>
                                    </div>
                                    <div class="fasilitas">
                                        <span class="btn-icons-fas">
                                            <ion-icon name="tv-outline"></ion-icon>
                                        </span>';
                                            if ($roomFacilities[$i]->televisi == 1) {
                                                echo '<span class="btn-text-fas">Smart TV</span>';
                                            } else {
                                                echo '<span class="btn-text-fas text-decoration-line-through text-danger">Smart TV</span>';
                                            }
                                    echo '</div>
                                    <div class="fasilitas">';
                                        if ($roomFacilities[$i]->area_merokok == 1) {
                                            echo '<span class="btn-icons-fas">
                                                                <img class="smoking-ic" src="' . base_url('assets/icon/smoking.svg') . '" alt="">
                                                            </span>
                                                            <span class="btn-text-fas">Smooking Room</span>';
                                        } else {
                                            echo '<span class="btn-icons-fas">
                                                                <img class="smoking-ic" src="' . base_url('assets/icon/no-smoking.svg') . '" alt="">
                                                            </span>
                                                            <span class="btn-text-fas text-danger">No Smooking</span>';
                                        }
                                    echo '</div>
                                    <div class="fasilitas">';
                                        if ($roomFacilities[$i]->sarapan == 1) {
                                            echo '<span class="btn-icons-fas">
                                                                <ion-icon name="fast-food-outline"></ion-icon>
                                                            </span>
                                                            <span class="btn-text-fas">Breakfast</span>';
                                        } else {
                                            echo '<span class="btn-icons-fas">
                                                                <ion-icon name="fast-food-outline"></ion-icon>
                                                            </span>
                                                            <span class="btn-text-fas text-decoration-line-through text-danger">Breakfast</span>';
                                        }
                                    echo '</div>
                                </div>
                                <div class="dv-info-pesan position-absolute bottom-0 start-50 translate-middle-x input-group text-center">
                                    <span class="text-harga">
                                        <p class="rp">Rp</p>
                                        <p class="nilai-rp">';
                                        if ((($roomFacilities[$i]->harga) / 1000) >= 1000) {
                                            echo ($roomFacilities[$i]->harga) / 1000000 . 'jt</p>';
                                        } else {
                                            echo ($roomFacilities[$i]->harga) / 1000 . 'k</p>';
                                        }
                                        echo '<p class="per-night">/Night</p>
                                    </span>';
                                    if ($roomFacilities[$i]->availRoom == 0) {
                                        echo '
                                        <button type="button" class="btn-pesan btn d-flex align-items-center">
                                            <span class="btn-text-pesan">Booking</span>
                                            <span class="btn-icons-pesan">
                                                <ion-icon name="chevron-forward-outline"></ion-icon>
                                            </span>
                                        </button>
                                        ';
                                    } else {
                                        if (isset($_SESSION['user'])) {
                                            echo '
                                            <button type="button" class="btn-pesan btn d-flex align-items-center" data-bs-toggle="modal"   data-bs-target="#bookingModal" data-bs-roomname="' . $roomFacilities[$i]->nama_tipe . '" data-bs-roomtype="' . $roomFacilities[$i]->id_tipe_kamar . '" data-bs-roomavail="' . $roomFacilities[$i]->availRoom . '" data-bs-roomprice="' . $roomFacilities[$i]->harga . '">
                                                <span class="btn-text-pesan">Booking</span>
                                                <span class="btn-icons-pesan">
                                                    <ion-icon name="chevron-forward-outline"></ion-icon>
                                                </span>
                                            </button>
                                            ';
                                        } else {
                                            echo '
                                            <a type="button" class="btn-pesan btn d-flex align-items-center" href="'.base_url('/signin').'">
                                                <span class="btn-text-pesan">Booking</span>
                                                <span class="btn-icons-pesan">
                                                    <ion-icon name="chevron-forward-outline"></ion-icon>
                                                </span>
                                            </a>
                                            ';
                                        }
                                    }
                                    
                                    echo '
                                </div>

                            </div>
                        </div>
                    </div>';
                }
                ?>

            </div>
        </div>

        <div class="container">
            <form class="form-check-card-room row">
                <div class="label-and-form col-4">
                    <label for="dp_checkIn" class="label form-label col-2">CHECK IN</label>
                    <div class="check-in">
                        <input type="date" class="form-cek-in-out form-control dp_checkIn" id="dp_checkIn_2" name="dp_checkIn" value="<?= $checkInValue ?>" min="<?= $minCheckIn ?>" max="<?= $maxCheckIn ?>" onchange="setCheckOut_dp1()">
                    </div>
                </div>
                <div class="label-and-form col-4">
                    <label for="dp_checkOut" class="label form-label col-2">CHECK OUT</label>
                    <div class="check-out">
                        <input type="date" class="form-cek-in-out form-control p_checkOut" id="dp_checkOut_2" name="dp_checkOut" value="<?= $checkOutValue ?>" min="<?= $minCheckOut ?>" max="<?= $maxCheckOut ?>">
                    </div>
                </div>
                <div class="div-btn-card col-4">
                    <button type="submit" class="btn-cari btn" formaction="<?= base_url('#list-card-rooms') ?>" formmethod="post">
                        <span class="btn-icons-cari">
                            <ion-icon name="search"></ion-icon>
                            <span class="btn-text-cari">Search</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="bookingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formBookData">
                    <span class="visually-hidden span-roomType" id="span-roomType"></span>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="bookingModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="sendDataBtn" value="<?= base_url('payment') ?>">Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmModal" aria-hidden="true" aria-labelledby="confirmModalLabel" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            </div>
        </div>
    </div>


</section>

<script src="<?= base_url('assets/js/' . $page . '.js') ?>"></script>

<?= $this->endSection() ?>