<?php if (count($data) > 0) : ?>
    <div id="main-content">
        <h3 class="mb-4">Booking History :</h3>
        <?php for ($i=0; $i < count($data); $i++) : ?>
            <?php if($data[$i]['status_payment'] == "PAID") : ?>
                <div class="card mb-4 pt-3 px-3 bg-light border-success">
            <?php elseif($data[$i]['status_payment'] == "PENDING") : ?>
                <div class="card mb-4 pt-3 px-3 bg-light border-warning">
            <?php else : ?>
                <div class="card mb-4 pt-3 px-3 bg-light border-danger">
            <?php endif; ?>
                <div class="booking-header row row-cols-auto g-0">
                    <p class="text-success text-end rCode col-12">Reservation Code : #<?php echo $data[$i]['kode_reservasi']; ?></p>

                    <div class="col-12 col-md-6 row row-cols-auto g-0">
                        <p class="col-5 col-lg-6 fw-bolder">Room Type</p>
                        <p class="col-1 col-lg-2 fw-bolder">:</p>
                        <p class="col-6 col-lg-4">
                            <?php if ($data[$i][0]['id_tipe_kamar'] == "3") {
                                    echo "Prajurit";
                                } elseif ($data[$i][0]['id_tipe_kamar'] == "2") {
                                    echo "Panglima";
                                } else {
                                    echo "Baginda";
                                }
                            ; ?>
                        </p>
                    </div>



                    <div class="col-12 col-md-6 row row-cols-auto g-0 text-md-end">
                        <p class="col-5 col-md-9 col-lg-9 fw-bolder">Number of room</p>
                        <p class="col-1 fw-bolder">:</p>
                        <p class="col-6 col-md-2 col-lg-1">
                            <?php echo $data[$i]['total_kamar']; ?>
                        </p>
                    </div>



                    <div class="col-12 row row-cols-auto g-0">
                        <p class="col-5 col-md-4 col-lg-3 fw-bolder">Check In &amp; Out</p>
                        <p class="col-7 col-md-8 col-lg-1 fw-bolder">:</p>
                        <p class="col-9 col-lg-4">
                            <?php echo $data[$i]['tgl_checkin']; ?><ion-icon class="mx-2" name="arrow-forward-outline"></ion-icon><?php echo $data[$i]['tgl_checkout']; ?>
                        </p>
                        <p class="col-3 col-lg-3 text-md-center text-lg-start text-body-tertiary">
                            ( <?php echo $data[$i]['durasi_inap']; ?> malam)
                        </p>
                    </div>



                    <div class="col-12 mt-4 mt-md-0 row row-cols-auto g-0">
                        <p class="col-5 col-md-4 col-lg-3 fw-bolder">Total Price</p>
                        <p class="col-1 fw-bolder">:</p>
                        <p class="col-6 col-md-7 col-lg-8">
                            <sup>Rp</sup> <?php echo number_format($data[$i]['total_harga']); ?>
                        </p>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-light rounded mt-4">
                        <thead class="t-head">
                            <?php if ($data[$i][0]['id_tipe_kamar'] == "3"): ?>
                            <tr class="align-middle">
                                <th scope="col" class="col-2 text-center" rowspan="2">Room #</th>
                                <th scope="col" colspan="2" class="text-center">Guest</th>
                            </tr>
                            <tr>
                                <th scope="col" class="text-center">NIK</th>
                                <th scope="col" class="text-center">Name</th>
                            </tr>
                            <?php elseif ($data[$i][0]['id_tipe_kamar'] == "2" || $data[$i][0]['id_tipe_kamar'] == "1"): ?>
                            <tr class="align-middle">
                                <th scope="col" class="col-2 text-center" rowspan="2">Room #</th>
                                <th scope="col" colspan="2" class="text-center">Guest 1</th>
                                <th scope="col" colspan="2" class="text-center">Guest 2</th>
                            </tr>
                            <tr>
                                <th scope="col" class="text-center">NIK</th>
                                <th scope="col" class="text-center">Name</th>
                                <th scope="col" class="text-center">NIK</th>
                                <th scope="col" class="text-center">Name</th>
                            </tr>
                            <?php endif; ?>
                        </thead>
                        <tbody>
                            <?php for ($j=0; $j < (int)$data[$i]['total_kamar']; $j++) : ?>
                                <?php if ($data[$i][0]['id_tipe_kamar'] == "3"): ?>
                                <tr>
                                    <th scope="row" class="text-center"><?php echo $data[$i][$j]['no_kamar']; ?></th>
                                    <td class="text-center"><?php echo $data[$i][$j]['nik_t1']; ?></td>
                                    <td class="text-center"><?php echo $data[$i][$j]['nama_t1']; ?></td>
                                </tr>
                                <?php elseif ($data[$i][0]['id_tipe_kamar'] == "2" || $data[$i][0]['id_tipe_kamar'] == "1"): ?>
                                <tr>
                                    <th scope="row" class="text-center"><?php echo $data[$i][$j]['no_kamar']; ?></th>
                                    <td class="text-center"><?php echo $data[$i][$j]['nik_t1']; ?></td>
                                    <td class="text-center"><?php echo $data[$i][$j]['nama_t1']; ?></td>
                                    <td class="text-center"><?php echo $data[$i][$j]['nik_t2']; ?></td>
                                    <td class="text-center"><?php echo $data[$i][$j]['nama_t2']; ?></td>
                                </tr>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
                <?php if ($data[$i]['status_payment'] == "PAID") : ?>
                    <div class="d-flex justify-content-center align-items-center w-100 mt-4 mb-3">
                        <ion-icon class="fs-2 text-success" name="checkmark-circle-outline"></ion-icon>
                        <span class="fs-5 text-success ms-3">Paid</span>
                    </div>
                <?php elseif($data[$i]['status_payment'] == "PENDING") : ?>
                    <div class="d-flex justify-content-end align-items-center w-100 mt-4 mb-3">
                        <button id="finishPaymentBtn" type="button" class="btn-action btnPay me-3" data-bs-snaptoken="<?=$data[$i]['snap_token']?>">
                            Finish Payment
                        </button>
                        <button type="button" class="btn-action btnCancel">
                            Cancel Reservation
                        </button>
                    </div>
                <?php else : ?>
                    <div class="d-flex justify-content-center align-items-center w-100 mt-4 mb-3">
                        <ion-icon class="fs-2 text-danger" name="close-circle-outline"></ion-icon>
                        <span class="fs-5 text-danger ms-3">Canceled</span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endfor; ?>
        <div class="spacer"></div>
        <div class="modal fade" id="paymentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="bookingModalLabel">Finish Payment</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div id="main-content" class="h-100 position-relative">
        <h5 class="text-body-tertiary position-absolute top-50 start-50 translate-middle"><i>Anda tidak memiliki riwayat reservasi.</i></h5>
    </div>
<?php endif; ?>



<!-- <div class="table-responsive">
    <table class="table table-borderless">
        <tbody>
            <tr>
                <th scope="col">Room Type :</th>
                <td>Prajurit</td>
                <th scope="col">Number of room :</th>
                <td>'.(count($newBookingData['prajurit']) - 4).'</td>
            </tr>
            <tr>
                <th scope="col">Check In &amp; Out :</th>
                <td class="d-inline-flex align-items-center">'.$newBookingData['check_in'].'<ion-icon class="mx-2" name="arrow-forward-outline"></ion-icon>'.$newBookingData['check_out'].' <span class="ms-1 text-body-tertiary">( '.$newBookingData['prajurit']['durasiInap'].' malam)</span></td>
                <th scope="col">Total Price :</th>
                <td><sup>Rp</sup>'.$newBookingData['prajurit']['totalHarga'].'</td>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-hover mt-4">
                        <thead class="">
                            <tr class="align-middle">
                                <th scope="col" class="col-2" rowspan="2">Room #</th>
                                <th scope="col" colspan="2" class="text-center">Guest</th>
                            </tr>
                            <tr>
                                <th scope="col" class="text-center">NIK</th>
                                <th scope="col" class="text-center">Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">'. $i+1 .'</th>
                                <td class="text-center">'. $newBookingData['prajurit'][$i+1]['nik'] .'</td>
                                <td class="text-center">'. $newBookingData['prajurit'][$i+1]['name'] .'</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div> -->