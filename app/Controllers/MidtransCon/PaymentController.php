<?php 
namespace App\Controllers\MidtransCon;

use App\Controllers\BaseController;
use Midtrans\Notification;
use CodeIgniter\I18n\Time;

class PaymentController extends BaseController
{
    public function index()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-Mb8wMUYpfoMzFcEGn6GyeNCT';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        if (isset($_POST['bookArray'])) {
            $_POST['bookArray']['check_in'] = $_POST['dp_checkIn'];
            $_POST['bookArray']['check_out'] = $_POST['dp_checkOut'];
    
            $newBookingData = $_POST['bookArray'];
    
            // Membuat kode reservasi
            $timeStamp = Time::now('Asia/Jakarta', 'id_ID')->toDateTimeString();
            $ts_remove_space= str_replace(' ', '', $timeStamp); // Menghapus spasi
            $ts_remove_colon = str_replace(':', '', $ts_remove_space); // Menghapus titik dua (:)
            $kode_reservasi = str_replace('-', '', $ts_remove_colon).'-'.$_SESSION['user']['id_tamu']; // Menghapus dash (-) dan menggabungkan ID user

            if (array_key_exists('prajurit', $newBookingData)) {
                $transaction_details = array(
                    'order_id' => $kode_reservasi,
                    'gross_amount' => (int)$newBookingData['prajurit']['totalHarga'], // no decimal allowed for creditcard
                );

                $item_details = array(
                    array(
                        'id' => 'Prajurit',
                        'price' => (int)$newBookingData['prajurit']['hargaPerMalam'] * (int)$newBookingData['prajurit']['durasiInap'],
                        'quantity' => (int)$newBookingData['prajurit']['jumKamar'],
                        'name' => "x Prajurit room   |   ".$newBookingData['prajurit']['durasiInap']." malam",
                    ),
                );

                $customer_details = array(
                    'first_name'    => $_SESSION['user']['nama'],
                    'email'         => $_SESSION['user']['email'],
                    'phone'         => $_SESSION['user']['no_telepon'],
                );

                $enable_payments = array("bni_va","bri_va");

                $transaction = array(
                    'enabled_payments' => $enable_payments,
                    'transaction_details' => $transaction_details,
                    'customer_details' => $customer_details,
                    'item_details' => $item_details,
                );


                $snap_token = \Midtrans\Snap::getSnapToken($transaction);

                return $snap_token;

            } elseif (array_key_exists('panglima', $newBookingData)) {
                $transaction_details = array(
                    'order_id' => $kode_reservasi,
                    'gross_amount' => (int)$newBookingData['panglima']['totalHarga'], // no decimal allowed for creditcard
                );

                $item_details = array(
                    array(
                        'id' => 'Prajurit',
                        'price' => (int)$newBookingData['panglima']['hargaPerMalam'] * (int)$newBookingData['panglima']['durasiInap'],
                        'quantity' => (int)$newBookingData['panglima']['jumKamar'],
                        'name' => "x Panglima room   |   ".$newBookingData['panglima']['durasiInap']." malam",
                    ),
                );

                $customer_details = array(
                    'first_name'    => $_SESSION['user']['nama'],
                    'email'         => $_SESSION['user']['email'],
                    'phone'         => $_SESSION['user']['no_telepon'],
                );

                $enable_payments = array("bni_va","bri_va");

                $transaction = array(
                    'enabled_payments' => $enable_payments,
                    'transaction_details' => $transaction_details,
                    'customer_details' => $customer_details,
                    'item_details' => $item_details,
                );


                $snap_token = \Midtrans\Snap::getSnapToken($transaction);

                return $snap_token;

            } elseif (array_key_exists('baginda', $newBookingData)) {
                $transaction_details = array(
                    'order_id' => $kode_reservasi,
                    'gross_amount' => (int)$newBookingData['baginda']['totalHarga'], // no decimal allowed for creditcard
                );

                $item_details = array(
                    array(
                        'id' => 'Prajurit',
                        'price' => (int)$newBookingData['baginda']['hargaPerMalam'] * (int)$newBookingData['baginda']['durasiInap'],
                        'quantity' => (int)$newBookingData['baginda']['jumKamar'],
                        'name' => "x Baginda room   |   ".$newBookingData['baginda']['durasiInap']." malam",
                    ),
                );

                $customer_details = array(
                    'first_name'    => $_SESSION['user']['nama'],
                    'email'         => $_SESSION['user']['email'],
                    'phone'         => $_SESSION['user']['no_telepon'],
                );

                $enable_payments = array("bni_va","bri_va");

                $transaction = array(
                    'enabled_payments' => $enable_payments,
                    'transaction_details' => $transaction_details,
                    'customer_details' => $customer_details,
                    'item_details' => $item_details,
                );


                $snap_token = \Midtrans\Snap::getSnapToken($transaction);

                return $snap_token;

            }
        }
    }


    public function notifHandler()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-Mb8wMUYpfoMzFcEGn6GyeNCT';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;


        if ($this->request->is('post')) {

            $notif = new Notification();
            $transaction = $notif->transaction_status;
            $order_id = $notif->order_id;


            if ($transaction == 'settlement')
            {
                $this->updateStatus($order_id, "PAID");
            }
            else if ($transaction == 'pending')
            {
                $this->updateStatus($order_id, "PENDING");
            } 
            else if ($transaction == 'expire')
            {
                $this->updateStatus($order_id, "UN_PAID");
            } 
            else if ($transaction == 'cancel')
            {
                $this->updateStatus($order_id, "CANCELED");
            }
        }
    }


    public function updateStatus($kode_reservasi, $status)
    {
        $db = db_connect();

        $getReservation = $db->query('SELECT * FROM tb_reservasi WHERE kode_reservasi = "'.$kode_reservasi.'"');

        if ($getReservation) {
            $db->table('tb_reservasi')->set('status_payment', $status)->where('kode_reservasi', $kode_reservasi)->update();
        }

        $db->close();
    }
}
 ?>