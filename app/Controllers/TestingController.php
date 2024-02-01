<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;

class TestingController extends BaseController
{

    public function index()
    {

        if (isset($_POST['bookArray'])) {

            $_POST['bookArray']['check_in'] = $_POST['dp_checkIn'];
            $_POST['bookArray']['check_out'] = $_POST['dp_checkOut'];
    
            $newBookingData = $_POST['bookArray'];
            d($newBookingData);
    
            // Membuat kode reservasi
            $timeStamp = Time::now('Asia/Jakarta', 'id_ID')->toDateTimeString();
            $ts_remove_space= str_replace(' ', '', $timeStamp); // Menghapus spasi
            $ts_remove_colon = str_replace(':', '', $ts_remove_space); // Menghapus titik dua (:)
            $kode_reservasi = str_replace('-', '', $ts_remove_colon).'-1'; // Menghapus dash (-) dan menggabungkan ID user

    

            if (array_key_exists('prajurit', $newBookingData)) {
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
            } else if (array_key_exists('panglima', $newBookingData)) {
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
            } else if (array_key_exists('baginda', $newBookingData)) {
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
            }
    
            echo $response;
        }





        // if (session()->has('bookArray')) {
        //     $previousBookingData = session()->bookArray;

            // if (array_key_exists('prajurit', $previousBookingData) && array_key_exists('prajurit', $newBookingData)) {
            //     $currentPrajuritCount = count($previousBookingData['prajurit']) - 1;
            //     $newPrajuritCount = count($newBookingData['prajurit']) - 1;

            //     for ($i=$currentPrajuritCount; $i < ($newPrajuritCount + $currentPrajuritCount); $i++) { 

            //         $_SESSION['bookArray']['prajurit']['jumKamar'] = $previousBookingData['prajurit']['jumKamar'] + $newBookingData['prajurit']['jumKamar'];

            //         $_SESSION['bookArray']['prajurit'][$i+1] = ['nik' => $newBookingData['prajurit'][$i+1-$currentPrajuritCount]['nik'], 'name' => $newBookingData['prajurit'][$i+1-$currentPrajuritCount]['name']];
            //     }
            // } else if ((!array_key_exists('prajurit', $previousBookingData) && array_key_exists('prajurit', $newBookingData))) {
            //     $newPrajuritCount = count($newBookingData['prajurit']) - 1;
            //     for ($i=0; $i < $newPrajuritCount; $i++) { 

            //         $_SESSION['bookArray']['prajurit']['jumKamar'] = (int)$newBookingData['prajurit']['jumKamar'];

            //         $_SESSION['bookArray']['prajurit'][$i+1] = ['nik' => $newBookingData['prajurit'][$i+1]['nik'], 'name' => $newBookingData['prajurit'][$i+1]['name']];
            //     }
            // }


        //     if (array_key_exists('panglima', $previousBookingData) && array_key_exists('panglima', $newBookingData)) {
        //         $currentPrajuritCount = count($previousBookingData['panglima']) - 1;
        //         $newPrajuritCount = count($newBookingData['panglima']) - 1;

        //         for ($i=$currentPrajuritCount; $i < ($newPrajuritCount + $currentPrajuritCount); $i++) { 

        //             $_SESSION['bookArray']['panglima']['jumKamar'] = $previousBookingData['panglima']['jumKamar'] + $newBookingData['panglima']['jumKamar'];

        //             $_SESSION['bookArray']['panglima'][$i+1]['guest1'] = ['nik' => $newBookingData['panglima'][$i+1-$currentPrajuritCount]['guest1']['nik'], 'name' => $newBookingData['panglima'][$i+1-$currentPrajuritCount]['guest1']['name']];

        //             $_SESSION['bookArray']['panglima'][$i+1]['guest2'] = ['nik' => $newBookingData['panglima'][$i+1-$currentPrajuritCount]['guest2']['nik'], 'name' => $newBookingData['panglima'][$i+1-$currentPrajuritCount]['guest2']['name']];
        //         }
        //     } else if ((!array_key_exists('panglima', $previousBookingData) && array_key_exists('panglima', $newBookingData))) {
        //         $newPrajuritCount = count($newBookingData['panglima']) - 1;
        //         for ($i=0; $i < $newPrajuritCount; $i++) { 

        //             $_SESSION['bookArray']['panglima']['jumKamar'] = (int)$newBookingData['panglima']['jumKamar'];

        //             $_SESSION['bookArray']['panglima'][$i+1]['guest1'] = ['nik' => $newBookingData['panglima'][$i+1]['guest1']['nik'], 'name' => $newBookingData['panglima'][$i+1]['guest1']['name']];
                    
        //             $_SESSION['bookArray']['panglima'][$i+1]['guest2'] = ['nik' => $newBookingData['panglima'][$i+1]['guest2']['nik'], 'name' => $newBookingData['panglima'][$i+1]['guest2']['name']];
        //         }
        //     }


        //     if (array_key_exists('baginda', $previousBookingData) && array_key_exists('baginda', $newBookingData)) {
        //         $currentPrajuritCount = count($previousBookingData['baginda']) - 1;
        //         $newPrajuritCount = count($newBookingData['baginda']) - 1;

        //         for ($i=$currentPrajuritCount; $i < ($newPrajuritCount + $currentPrajuritCount); $i++) { 

        //             $_SESSION['bookArray']['baginda']['jumKamar'] = $previousBookingData['baginda']['jumKamar'] + $newBookingData['baginda']['jumKamar'];

        //             $_SESSION['bookArray']['baginda'][$i+1]['guest1'] = ['nik' => $newBookingData['baginda'][$i+1-$currentPrajuritCount]['guest1']['nik'], 'name' => $newBookingData['baginda'][$i+1-$currentPrajuritCount]['guest1']['name']];

        //             $_SESSION['bookArray']['baginda'][$i+1]['guest2'] = ['nik' => $newBookingData['baginda'][$i+1-$currentPrajuritCount]['guest2']['nik'], 'name' => $newBookingData['baginda'][$i+1-$currentPrajuritCount]['guest2']['name']];
        //         }
        //     } else if ((!array_key_exists('baginda', $previousBookingData) && array_key_exists('baginda', $newBookingData))) {
        //         $newPrajuritCount = count($newBookingData['baginda']) - 1;
        //         for ($i=0; $i < $newPrajuritCount; $i++) { 

        //             $_SESSION['bookArray']['baginda']['jumKamar'] = (int)$newBookingData['baginda']['jumKamar'];

        //             $_SESSION['bookArray']['baginda'][$i+1]['guest1'] = ['nik' => $newBookingData['baginda'][$i+1]['guest1']['nik'], 'name' => $newBookingData['baginda'][$i+1]['guest1']['name']];

        //             $_SESSION['bookArray']['baginda'][$i+1]['guest2'] = ['nik' => $newBookingData['baginda'][$i+1]['guest2']['nik'], 'name' => $newBookingData['baginda'][$i+1]['guest2']['name']];
        //         }
        //     }
        // } else {
        //     session()->set($_POST);
        // }

        // $data = ['success', 200];
    }
}

// <div class="modal-header">
//     <h1 class="modal-title fs-5 text-success" id="confirmModalLabel">Success</h1>
//     <ion-icon class="ic-sccss-modal fs-2 text-success" name="checkmark-circle-outline"></ion-icon>
// </div>
// <div class="modal-body">
//     <h1>Room booking is success !</h1>
// </div>
// <div class="modal-footer">
//     <button id="confirmBtn" type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
// </div>