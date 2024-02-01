<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use App\Models\ReservationModel;

class ReservationController extends BaseController
{
    public function index()
    {
        $model = new ReservationModel();
        $time1 = Time::now('Asia/Jakarta', 'id_ID')->toDateTimeString();
        $time2 = Time::now('Asia/Jakarta', 'id_ID')->setHour(12)->setMinute(0)->setSecond(0)->toDateTimeString();

        $now = Time::parse($time1);

        $min_checkIn = $now->toDateString();
        $max_checkIn = $now->addMonths(1)->toDateString();
        $min_checkOut = $now->addDays(1)->toDateString();
        $max_checkOut = $now->addMonths(1)->toDateString();

        // dd($min_checkIn,$max_checkIn, $min_checkOut,);
        $param = [
            'minCheckIn' => $min_checkIn,
            'maxCheckIn' => $max_checkIn,
            'minCheckOut' => $min_checkOut,
            'maxCheckOut' => $max_checkOut,
            'page' => 'home',
            'title' => 'Reservation',
            'roomFacilities' => $model->getRoomFacilities(),
        ];

        if (!isset($_POST["dp_checkIn"]) && !isset($_POST["dp_checkOut"])) {
            $getAllAvailableRoom = $model->getAllAvailableRoom($min_checkIn, $min_checkOut);

            $param['checkInValue'] = $min_checkIn;
            $param['checkOutValue'] = $min_checkOut;
            $priceArr = array_column($getAllAvailableRoom, 'harga', 'id_tipe_kamar');
            for ($i = count($param['roomFacilities']); $i > 0; $i--) { 
                if (!array_key_exists($i, $priceArr)) {
                    if ($i == 3) {
                        $param['roomFacilities'][3-$i]->availRoom = 0;
                        $param['roomFacilities'][3-$i]->harga = 200000;
                    } elseif ($i == 2) {
                        $param['roomFacilities'][3-$i]->availRoom = 0;
                        $param['roomFacilities'][3-$i]->harga = 750000;
                    } elseif ($i == 1) {
                        $param['roomFacilities'][3-$i]->availRoom = 0;
                        $param['roomFacilities'][3-$i]->harga = 1500000;
                    }
                } else {
                    $param['roomFacilities'][3-$i]->availRoom = array_count_values(array_column($getAllAvailableRoom, 'id_tipe_kamar'))[$i];
                    $param['roomFacilities'][3-$i]->harga = $priceArr[$i];
                }
                
            }

        } else {
            $getAllAvailableRoom = $model->getAllAvailableRoom($_POST["dp_checkIn"], $_POST["dp_checkOut"]);

            $param['checkInValue'] = $_POST["dp_checkIn"];
            $param['checkOutValue'] = $_POST["dp_checkOut"];
            $priceArr = array_column($getAllAvailableRoom, 'harga', 'id_tipe_kamar');
            for ($i = count($param['roomFacilities']); $i > 0; $i--) { 
                if (!array_key_exists($i, $priceArr)) {
                    if ($i == 3) {
                        $param['roomFacilities'][3-$i]->availRoom = 0;
                        $param['roomFacilities'][3-$i]->harga = 200000;
                    } elseif ($i == 2) {
                        $param['roomFacilities'][3-$i]->availRoom = 0;
                        $param['roomFacilities'][3-$i]->harga = 750000;
                    } elseif ($i == 1) {
                        $param['roomFacilities'][3-$i]->availRoom = 0;
                        $param['roomFacilities'][3-$i]->harga = 1500000;
                    }
                } else {
                    $param['roomFacilities'][3-$i]->availRoom = array_count_values(array_column($getAllAvailableRoom, 'id_tipe_kamar'))[$i];
                    $param['roomFacilities'][3-$i]->harga = $priceArr[$i];
                }
                
            }
        }
        return view('guest/home', $param);
    }





    public function setBooking()
    {
        $model = new ReservationModel();
        if (isset($_POST['bookArray'])) {

            $_POST['bookArray']['check_in'] = $_POST['dp_checkIn'];
            $_POST['bookArray']['check_out'] = $_POST['dp_checkOut'];
    
            $newBookingData = $_POST['bookArray'];
            $status = $_POST['status'];
            $paymentType = $_POST['payment_type'];
            $bank = $_POST['bank'];
            $va_number = $_POST['va_number'];
            $timeStamp = $_POST['timeStamp'];
            $kode_reservasi = $_POST['kode_reservasi'];
            $snap_token = $_POST['snapToken'];

    

            if (array_key_exists('prajurit', $newBookingData)) {
                $saveData = $model->addDataBooking($timeStamp, $kode_reservasi, 'prajurit',$newBookingData, (int)$_SESSION['user']['id_tamu'], $paymentType, $bank, $va_number, $status, $snap_token);
                if ($saveData) {
                    $response = '
                        <div class="modal-header">
                            <div>
                                <h1 class="modal-title fs-5 text-success me-3" id="confirmModalLabel">Success</h1>
                                <h6 class="text-info-emphasis">#'.$kode_reservasi.'</h6>
                            </div>
                            <ion-icon class="ic-sccss-modal fs-2 text-success" name="checkmark-circle-outline"></ion-icon>
                        </div>
                        <div class="modal-body">
                            <h3 class="mb-3">Booking Detail :</h3>
                            <div class="table-responsive">
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
                                            <td class="d-inline-flex align-items-center">'.$newBookingData['check_in'].'<ion-icon class="mx-2" name="arrow-forward-outline"></ion-icon>'.$newBookingData['check_out'].'  <span class="ms-1 text-body-tertiary">( '.$newBookingData['prajurit']['durasiInap'].' malam)</span></td>
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
                    ';
    
                    for ($i=0; $i < count($newBookingData['prajurit']) - 4; $i++) { 
                        $response .= '
                        <tr>
                            <th scope="row">'. $i+1 .'</th>
                            <td class="text-center">'. $newBookingData['prajurit'][$i+1]['nik'] .'</td>
                            <td class="text-center">'. $newBookingData['prajurit'][$i+1]['name'] .'</td>
                        </tr>
                        ';
                    }
    
                    $response .= '            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button id="confirmBtn" type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                        </div>
                    ';
                } else {
                    $response = '
                        <div class="modal-header">
                            <div class="d-inline-flex">
                                <h1 class="modal-title fs-5 text-danger me-3" id="confirmModalLabel">Failed</h1>
                                <ion-icon class="ic-sccss-modal fs-2 text-danger" name="close-circle-outline"></ion-icon>
                            </div>
                        </div>
                        <div class="modal-body text-center">
                            <h1 class="mb-4"> Oops !</h1>
                            <h4 class="mb-4">Gagal melakukan reservasi, silahkan coba beberapa saat lagi !</h4>
                        </div>
                        <div class="modal-footer">
                            <button id="confirmBtn" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>';
                }
            } else if (array_key_exists('panglima', $newBookingData)) {
                $saveData = $model->addDataBooking($timeStamp, $kode_reservasi, 'panglima',$newBookingData, (int)$_SESSION['user']['id_tamu'], $paymentType, $bank, $va_number, $status, $snap_token);
                if ($saveData) {
                    $response = '
                        <div class="modal-header">
                            <div>
                                <h1 class="modal-title fs-5 text-success me-3" id="confirmModalLabel">Success</h1>
                                <h6 class="text-info-emphasis">#'.$kode_reservasi.'</h6>
                            </div>
                            <ion-icon class="ic-sccss-modal fs-2 text-success" name="checkmark-circle-outline"></ion-icon>
                        </div>
                        <div class="modal-body">
                            <h3 class="mb-3">Booking Detail :</h3>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">Room Type :</th>
                                            <td>Panglima</td>
                                            <th scope="col">Number of room :</th>
                                            <td>'.(count($newBookingData['panglima']) - 4).'</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Check In &amp; Out :</th>
                                            <td class="d-inline-flex align-items-center">'.$newBookingData['check_in'].'<ion-icon class="mx-2" name="arrow-forward-outline"></ion-icon>'.$newBookingData['check_out'].'  <span class="ms-1 text-body-tertiary">( '.$newBookingData['panglima']['durasiInap'].' malam)</span></td>
                                            <th scope="col">Total Price :</th>
                                            <td><sup>Rp</sup>'.$newBookingData['panglima']['totalHarga'].'</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="4">
                                                <table class="table table-hover mt-4">
                                                    <thead class="">
                                                        <tr class="align-middle">
                                                            <th scope="col" class="col-2" rowspan="2">Room #</th>
                                                            <th scope="col" colspan="2" class="text-center">Guest 1</th>
                                                            <th scope="col" colspan="2" class="text-center">Guest 2</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col" class="text-center">NIK</th>
                                                            <th scope="col" class="text-center">Name</th>
                                                            <th scope="col" class="text-center">NIK</th>
                                                            <th scope="col" class="text-center">Name</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                    ';

                    for ($i=0; $i < count($newBookingData['panglima']) - 4; $i++) { 
                        $response .= '
                        <tr>
                            <th scope="row">'. $i+1 .'</th>
                            <td class="text-center">'. $newBookingData['panglima'][$i+1]['guest1']['nik'] .'</td>
                            <td class="text-center">'. $newBookingData['panglima'][$i+1]['guest1']['name'] .'</td>
                            <td class="text-center">'. $newBookingData['panglima'][$i+1]['guest2']['nik'] .'</td>
                            <td class="text-center">'. $newBookingData['panglima'][$i+1]['guest2']['name'] .'</td>
                        </tr>
                        ';
                    }

                    $response .= '            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button id="confirmBtn" type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                        </div>
                    ';
                } else {
                    $response = '
                        <div class="modal-header">
                            <div class="d-inline-flex">
                                <h1 class="modal-title fs-5 text-danger me-3" id="confirmModalLabel">Failed</h1>
                                <ion-icon class="ic-sccss-modal fs-2 text-danger" name="close-circle-outline"></ion-icon>
                            </div>
                        </div>
                        <div class="modal-body text-center">
                            <h1 class="mb-4"> Oops !</h1>
                            <h4 class="mb-4">Gagal melakukan reservasi, silahkan coba beberapa saat lagi !</h4>
                        </div>
                        <div class="modal-footer">
                            <button id="confirmBtn" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>';
                }
            } else if (array_key_exists('baginda', $newBookingData)) {
                $saveData = $model->addDataBooking($timeStamp, $kode_reservasi, 'baginda',$newBookingData, (int)$_SESSION['user']['id_tamu'], $paymentType, $bank, $va_number, $status, $snap_token);
                if ($saveData) {
                    $response = '
                        <div class="modal-header">
                            <div>
                                <h1 class="modal-title fs-5 text-success me-3" id="confirmModalLabel">Success</h1>
                                <h6 class="text-info-emphasis">#'.$kode_reservasi.'</h6>
                            </div>
                            <ion-icon class="ic-sccss-modal fs-2 text-success" name="checkmark-circle-outline"></ion-icon>
                        </div>
                        <div class="modal-body">
                            <h3 class="mb-3">Booking Detail :</h3>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">Room Type :</th>
                                            <td>Baginda</td>
                                            <th scope="col">Number of room :</th>
                                            <td>'.(count($newBookingData['baginda']) - 4).'</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Check In &amp; Out :</th>
                                            <td class="d-inline-flex align-items-center">'.$newBookingData['check_in'].'<ion-icon class="mx-2" name="arrow-forward-outline"></ion-icon>'.$newBookingData['check_out'].'  <span class="ms-1 text-body-tertiary">( '.$newBookingData['baginda']['durasiInap'].' malam)</span></td>
                                            <th scope="col">Total Price :</th>
                                            <td><sup>Rp</sup>'.$newBookingData['baginda']['totalHarga'].'</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="4">
                                                <table class="table table-hover mt-4">
                                                    <thead class="">
                                                        <tr class="align-middle">
                                                            <th scope="col" class="col-2" rowspan="2">Room #</th>
                                                            <th scope="col" colspan="2" class="text-center">Guest 1</th>
                                                            <th scope="col" colspan="2" class="text-center">Guest 2</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col" class="text-center">NIK</th>
                                                            <th scope="col" class="text-center">Name</th>
                                                            <th scope="col" class="text-center">NIK</th>
                                                            <th scope="col" class="text-center">Name</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                    ';

                    for ($i=0; $i < count($newBookingData['baginda']) - 4; $i++) { 
                        $response .= '
                        <tr>
                            <th scope="row">'. $i+1 .'</th>
                            <td class="text-center">'. $newBookingData['baginda'][$i+1]['guest1']['nik'] .'</td>
                            <td class="text-center">'. $newBookingData['baginda'][$i+1]['guest1']['name'] .'</td>
                            <td class="text-center">'. $newBookingData['baginda'][$i+1]['guest2']['nik'] .'</td>
                            <td class="text-center">'. $newBookingData['baginda'][$i+1]['guest2']['name'] .'</td>
                        </tr>
                        ';
                    }

                    $response .= '            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button id="confirmBtn" type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                        </div>
                    ';
                } else {
                    $response = '
                        <div class="modal-header">
                            <div class="d-inline-flex">
                                <h1 class="modal-title fs-5 text-danger me-3" id="confirmModalLabel">Failed</h1>
                                <ion-icon class="ic-sccss-modal fs-2 text-danger" name="close-circle-outline"></ion-icon>
                            </div>
                        </div>
                        <div class="modal-body text-center">
                            <h1 class="mb-4"> Oops !</h1>
                            <h4 class="mb-4">Gagal melakukan reservasi, silahkan coba beberapa saat lagi !</h4>
                        </div>
                        <div class="modal-footer">
                            <button id="confirmBtn" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>';
                }
            }
    
            echo $response;
        }
    }
}