<?php
namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class ReservationModel extends Model
{
    public function getAllAvailableRoom($checkIn, $checkOut)
    {
        $db = db_connect();

        $data = $db->query('SELECT id_kamar, id_tipe_kamar, harga FROM tb_kamar 
        WHERE id_kamar NOT IN (SELECT tb_detail_reservasi.id_kamar FROM tb_reservasi 
        INNER JOIN tb_detail_reservasi ON tb_reservasi.kode_reservasi = tb_detail_reservasi.kode_reservasi 
        WHERE tb_reservasi.tgl_checkin BETWEEN "'.$checkIn.' 14:00:00" AND "'.$checkOut.' 12:00:00" 
        OR tb_reservasi.tgl_checkout BETWEEN "'.$checkIn.' 14:00:00" AND "'.$checkOut.' 12:00:00") ORDER BY id_kamar')
        ->getResultObject();

        $db->close();
        return $data;
    }

    public function getRoomFacilities()
    {
        $db = db_connect();
        $data = $db->query('SELECT * FROM tb_tipe_kamar ORDER BY id_tipe_kamar DESC')->getResultObject();
        $db->close();
        return $data;
    }

    public function addDataBooking($timeStamp, $kode_reservasi, $tipekamar, $dataBooking, $id_tamu, $paymentType, $bank, $va_number, $status, $snap_token)
    {
        $db = db_connect();

        $data_reservasi = [
            'kode_reservasi' => $kode_reservasi,
            'id_admin' => 1,
            'id_tamu' => $id_tamu,
            'total_kamar' => (int)$dataBooking[$tipekamar]['jumKamar'],
            'durasi_inap' => (int)$dataBooking[$tipekamar]['durasiInap'],
            'tgl_checkin' => $dataBooking['check_in'].' 14:00:00',
            'tgl_checkout' => $dataBooking['check_out'].' 12:00:00',
            'tgl_pesan' => $timeStamp,
            'total_harga' => $dataBooking[$tipekamar]['totalHarga'],
            'payment_type' => $paymentType,
            'bank' => $bank,
            'va_number' => $va_number,
            'snap_token' => $snap_token,
            'status_payment' => $status
        ];
        
        if ($db->table('tb_reservasi')->insert($data_reservasi)) {
            if ($tipekamar == 'prajurit') {
                $check_kamar = $db->query('SELECT id_kamar, id_tipe_kamar FROM tb_kamar 
                WHERE id_kamar NOT IN (SELECT tb_detail_reservasi.id_kamar FROM tb_reservasi 
                INNER JOIN tb_detail_reservasi ON tb_reservasi.kode_reservasi = tb_detail_reservasi.kode_reservasi 
                WHERE tb_reservasi.tgl_checkin BETWEEN "'.$dataBooking['check_in'].' 14:00:00" AND "'.$dataBooking['check_out'].' 12:00:00" 
                OR tb_reservasi.tgl_checkout BETWEEN "'.$dataBooking['check_in'].' 14:00:00" AND "'.$dataBooking['check_out'].' 12:00:00")
                AND id_tipe_kamar = 3 ORDER BY id_kamar')
                ->getResultArray();

                if ((int)$dataBooking[$tipekamar]['jumKamar'] <= count($check_kamar)) {
                    for ($i=0; $i < $dataBooking[$tipekamar]['jumKamar']; $i++) {
                        $insert = [
                            'kode_reservasi' => $kode_reservasi,
                            'id_kamar' => (int)$check_kamar[$i]['id_kamar'],
                            'nik_t1' => $dataBooking[$tipekamar][$i+1]['nik'],
                            'nama_t1' => $dataBooking[$tipekamar][$i+1]['name'],
                            'nik_t2' => "",
                            'nama_t2' => ""
                        ];
                        if ($db->table('tb_detail_reservasi')->insert($insert)) {
                            continue;
                        } else {
                            return false;
                            break;
                        }
                    }
                } else {
                    return false;
                }
            } elseif ($tipekamar == 'panglima') {
                $check_kamar = $db->query('SELECT id_kamar, id_tipe_kamar FROM tb_kamar 
                WHERE id_kamar NOT IN (SELECT tb_detail_reservasi.id_kamar FROM tb_reservasi 
                INNER JOIN tb_detail_reservasi ON tb_reservasi.kode_reservasi = tb_detail_reservasi.kode_reservasi 
                WHERE tb_reservasi.tgl_checkin BETWEEN "'.$dataBooking['check_in'].' 14:00:00" AND "'.$dataBooking['check_out'].' 12:00:00" 
                OR tb_reservasi.tgl_checkout BETWEEN "'.$dataBooking['check_in'].' 14:00:00" AND "'.$dataBooking['check_out'].' 12:00:00")
                AND id_tipe_kamar = 2 ORDER BY id_kamar')
                ->getResultArray();

                if ((int)$dataBooking[$tipekamar]['jumKamar'] <= count($check_kamar)) {
                    for ($i=0; $i < $dataBooking[$tipekamar]['jumKamar']; $i++) { 
                        $insert = [
                            'kode_reservasi' => $kode_reservasi,
                            'id_kamar' => (int)$check_kamar[$i]['id_kamar'],
                            'nik_t1' => $dataBooking[$tipekamar][$i+1]['guest1']['nik'],
                            'nama_t1' => $dataBooking[$tipekamar][$i+1]['guest1']['name'],
                            'nik_t2' => $dataBooking[$tipekamar][$i+1]['guest2']['nik'],
                            'nama_t2' => $dataBooking[$tipekamar][$i+1]['guest2']['name']
                        ];
                        if ($db->table('tb_detail_reservasi')->insert($insert)) {
                            continue;
                        } else {
                            return false;
                            break;
                        }
                    }
                } else {
                    return false;
                }
            } elseif ($tipekamar == 'baginda') {
                $check_kamar = $db->query('SELECT id_kamar, id_tipe_kamar FROM tb_kamar 
                WHERE id_kamar NOT IN (SELECT tb_detail_reservasi.id_kamar FROM tb_reservasi 
                INNER JOIN tb_detail_reservasi ON tb_reservasi.kode_reservasi = tb_detail_reservasi.kode_reservasi 
                WHERE tb_reservasi.tgl_checkin BETWEEN "'.$dataBooking['check_in'].' 14:00:00" AND "'.$dataBooking['check_out'].' 12:00:00" 
                OR tb_reservasi.tgl_checkout BETWEEN "'.$dataBooking['check_in'].' 14:00:00" AND "'.$dataBooking['check_out'].' 12:00:00")
                AND id_tipe_kamar = 1 ORDER BY id_kamar')
                ->getResultArray();

                if ((int)$dataBooking[$tipekamar]['jumKamar'] <= count($check_kamar)) {
                    for ($i=0; $i < $dataBooking[$tipekamar]['jumKamar']; $i++) { 
                        $insert = [
                            'kode_reservasi' => $kode_reservasi,
                            'id_kamar' => (int)$check_kamar[$i]['id_kamar'],
                            'nik_t1' => $dataBooking[$tipekamar][$i+1]['guest1']['nik'],
                            'nama_t1' => $dataBooking[$tipekamar][$i+1]['guest1']['name'],
                            'nik_t2' => $dataBooking[$tipekamar][$i+1]['guest2']['nik'],
                            'nama_t2' => $dataBooking[$tipekamar][$i+1]['guest2']['name']
                        ];
                        if ($db->table('tb_detail_reservasi')->insert($insert)) {
                            continue;
                        } else {
                            return false;
                            break;
                        }
                    }
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }

        $db->close();

        return true;


    }

    public function getUserHistory($id)
    {
        $db = db_connect();
        $data = [];

        $collect_kode_reservasi = $this->db->query('SELECT kode_reservasi, tgl_checkin, tgl_checkout, durasi_inap, total_kamar, total_harga, status_payment, payment_type, bank, snap_token FROM tb_reservasi WHERE id_tamu = '.$id.' ORDER BY kode_reservasi DESC')->getResultArray();

        for ($i=0; $i < count($collect_kode_reservasi); $i++) { 

            $collect_reservation_detail = $this->db->query('SELECT tb_detail_reservasi.id_kamar, tb_kamar.no_kamar, tb_kamar.id_tipe_kamar, tb_detail_reservasi.nik_t1, tb_detail_reservasi.nama_t1, tb_detail_reservasi.nik_t2, tb_detail_reservasi.nama_t2 FROM ((tb_detail_reservasi INNER JOIN tb_kamar ON tb_detail_reservasi.id_kamar = tb_kamar.id_kamar) INNER JOIN tb_tipe_kamar ON tb_kamar.id_tipe_kamar = tb_tipe_kamar.id_tipe_kamar) WHERE tb_detail_reservasi.kode_reservasi = "'.$collect_kode_reservasi[$i]['kode_reservasi'].'"')->getResultArray();

            $data[$i] = $collect_kode_reservasi[$i];
            $data[$i]['tgl_checkin'] = Time::parse($data[$i]['tgl_checkin'], 'Asia/Jakarta')->toDateString();
            $data[$i]['tgl_checkout'] = Time::parse($data[$i]['tgl_checkout'], 'Asia/Jakarta')->toDateString();
            for ($j=0; $j < count($collect_reservation_detail); $j++) { 
                $data[$i][$j] = $collect_reservation_detail[$j];
            }

        }
        return $data;
        $db->close();
    }
}



?>