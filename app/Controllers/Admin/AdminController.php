<?php

namespace App\Controllers\Admin;
use CodeIgniter\I18n\Time;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function index()
    {
        if ($this->request->is('post')) {
            $adminEmail = $_POST['adminEmail'];
            $adminPass = $_POST['adminPass'];

            $findAdmin = $this->findAdmin($adminEmail, $adminPass);
            if($findAdmin){
                $_SESSION['admin'] = $findAdmin;
                return redirect()->route('admin');
            } else {
                session()->setFlashdata('failed', '<div class="row mb-3 alert alert-danger" role="alert">Email atau Password salah !</div>');
                return redirect()->back()->withInput();
            }

        } else {
            return view('admin_views/Layout/admin_login');
        }
        
    }

    public function logout()
    {
        unset($_SESSION['admin']);
        return redirect()->route('/');
    }




    public function dashboard()
    {
        if (isset($_SESSION['admin'])) {
            $param = [
                'preset' => view('admin_views/admin_menu/dashboard')
            ];
            return view('admin_views/Layout/admin_template', $param);
        } else {
            return redirect()->route('admin/signin');
        }
    }

    public function dashboardMenu()
    {
        return view('admin_views/admin_menu/dashboard');
    }

    public function reservationMenu()
    {
        $currentDate = Time::now();
        $currentMonth = $currentDate->getMonth();
        $currentYear = $currentDate->getYear();


        $data =['dataReservationTimeline' =>$this->getReservationTimeline($currentMonth, $currentYear)];
        return view('admin_views/admin_menu/reservation', $data);
    }

    public function roomMenu()
    {
        return view('admin_views/admin_menu/room');
    }








    public function findByRoomType()
    {
        if ($this->request->is('post')) {
            $month_to_find = $_POST["month"];
            $year_to_find = $_POST["year"];
            $roomType_to_find = $_POST["room_type"];

            $data = ['dataReservationTimeline' => $this->ReservationTimeline_By_RoomType($month_to_find, $year_to_find, (int)$roomType_to_find)];
            if ($data) {
                return view('admin_views/admin_menu/reservation_find_format', $data);
            }
        }
    }



    private function findAdmin($adminEmail, $adminPass)
    {
        $db = db_connect();
        $getAdmin = $db->table('tb_admin')->select('*')->where('email', $adminEmail)->where('password', $adminPass)->get()->getResultArray();

        if ($getAdmin) {
            $db->close();
            return $getAdmin[0];
        } else {
            return false;
        }
    }


    public function getReservationTimeline($month, $year)
    {
        $db = db_connect();
        $getRoomType = $db->query('SELECT id_tipe_kamar, nama_tipe FROM tb_tipe_kamar')->getResultArray();
        if ($getRoomType) {
            $monthName = $this->monthTranslate((int)$month);
            $dataArray = ['monthYear' => $monthName.' '.$year,'currentMonth' => $month,'currentYear'=>$year,'currentMonthName' => $monthName,'daysInCurrentMonth' => cal_days_in_month(CAL_GREGORIAN, (int)$month, (int)$year)];

            for ($i=0; $i < count($getRoomType); $i++) { 
                $dataArray[$i]["id_tipe_kamar"] = (int)$getRoomType[$i]["id_tipe_kamar"];
                $dataArray[$i]["nama_tipe"] = $getRoomType[$i]["nama_tipe"];

                $getRoomByType = $db->query('SELECT id_kamar, no_kamar FROM tb_kamar WHERE id_tipe_kamar ='.$getRoomType[$i]["id_tipe_kamar"].' ORDER BY id_kamar ASC')->getResultArray();
                if ($getRoomByType) {
                    for ($j=0; $j < count($getRoomByType); $j++) { 
                        $dataArray[$i][$j]["id_kamar"] = (int)$getRoomByType[$j]["id_kamar"];
                        $dataArray[$i][$j]["no_kamar"] = $getRoomByType[$j]["no_kamar"];
                        $getReservedRoomTimeline = $db->query(
                            'SELECT 
                            tb_reservasi.kode_reservasi, 
                            tb_reservasi.tgl_checkin, 
                            tb_reservasi.tgl_checkout, 
                            tb_reservasi.durasi_inap, 
                            tb_detail_reservasi.id_kamar  
                            FROM (tb_detail_reservasi 
                            INNER JOIN tb_reservasi ON tb_detail_reservasi.kode_reservasi = tb_reservasi.kode_reservasi)
                            WHERE CONVERT(MONTH(tb_reservasi.tgl_checkin), CHAR) = '.$month.
                            ' AND CONVERT(YEAR(tb_reservasi.tgl_checkin), CHAR) = '.$year.
                            ' AND tb_detail_reservasi.id_kamar = '.$getRoomByType[$j]["id_kamar"].
                            ' ORDER BY tb_reservasi.tgl_checkin ASC')->getResultArray();

                        if ($getReservedRoomTimeline) {
                            for ($k=0; $k < count($getReservedRoomTimeline); $k++) { 
                                $dataArray[$i][$j]["reserved_room"][$k]["kode_reservasi"] = "#".$getReservedRoomTimeline[$k]["kode_reservasi"];
                                $dataArray[$i][$j]["reserved_room"][$k]["tgl_checkin"] = $getReservedRoomTimeline[$k]["tgl_checkin"];
                                $dataArray[$i][$j]["reserved_room"][$k]["tgl_checkout"] = $getReservedRoomTimeline[$k]["tgl_checkout"];
                                $dataArray[$i][$j]["reserved_room"][$k]["start_day"] = (int)Time::parse($getReservedRoomTimeline[$k]["tgl_checkin"])->getDay();
                                $dataArray[$i][$j]["reserved_room"][$k]["end_day"] = (int)Time::parse($getReservedRoomTimeline[$k]["tgl_checkout"])->getDay();
                                $dataArray[$i][$j]["reserved_room"][$k]["durasi_inap"] = (int)$getReservedRoomTimeline[$k]["durasi_inap"];
                            }
                        }

                    }
                }
            }
        }
        $db->close();
        return $dataArray;
    }


    public function roomMenu_content()
    {
        $db = db_connect();
        $getRoomType = $db->query('SELECT * FROM tb_tipe_kamar')->getResultArray();

        if ($getRoomType)
        {

            for ($i=0; $i < count($getRoomType); $i++)
            {
                
            }
        }
    }


    public function ReservationTimeline_By_RoomType($month, $year, $roomType)
    {
        $db = db_connect();
        $getRoomType = $db->query('SELECT id_tipe_kamar, nama_tipe FROM tb_tipe_kamar WHERE id_tipe_kamar = '.$roomType)->getResultArray();
        if ($getRoomType) {
            $monthName = $this->monthTranslate((int)$month);
            $dataArray = ['monthYear' => $monthName.' '.$year,'currentMonth' => $month,'currentYear'=>$year,'currentMonthName' => $monthName,'daysInCurrentMonth' => cal_days_in_month(CAL_GREGORIAN, (int)$month, (int)$year)];

            for ($i=0; $i < count($getRoomType); $i++) { 
                $dataArray[$i]["id_tipe_kamar"] = (int)$getRoomType[$i]["id_tipe_kamar"];
                $dataArray[$i]["nama_tipe"] = $getRoomType[$i]["nama_tipe"];

                $getRoomByType = $db->query('SELECT id_kamar, no_kamar FROM tb_kamar WHERE id_tipe_kamar ='.$getRoomType[$i]["id_tipe_kamar"].' ORDER BY id_kamar ASC')->getResultArray();
                if ($getRoomByType) {
                    for ($j=0; $j < count($getRoomByType); $j++) { 
                        $dataArray[$i][$j]["id_kamar"] = (int)$getRoomByType[$j]["id_kamar"];
                        $dataArray[$i][$j]["no_kamar"] = $getRoomByType[$j]["no_kamar"];
                        $getReservedRoomTimeline = $db->query(
                            'SELECT 
                            tb_reservasi.kode_reservasi, 
                            tb_reservasi.tgl_checkin, 
                            tb_reservasi.tgl_checkout, 
                            tb_reservasi.durasi_inap, 
                            tb_detail_reservasi.id_kamar  
                            FROM (tb_detail_reservasi 
                            INNER JOIN tb_reservasi ON tb_detail_reservasi.kode_reservasi = tb_reservasi.kode_reservasi)
                            WHERE CONVERT(MONTH(tb_reservasi.tgl_checkin), CHAR) = '.$month.
                            ' AND CONVERT(YEAR(tb_reservasi.tgl_checkin), CHAR) = '.$year.
                            ' AND tb_detail_reservasi.id_kamar = '.$getRoomByType[$j]["id_kamar"].
                            ' ORDER BY tb_reservasi.tgl_checkin ASC')->getResultArray();

                        if ($getReservedRoomTimeline) {
                            for ($k=0; $k < count($getReservedRoomTimeline); $k++) { 
                                $dataArray[$i][$j]["reserved_room"][$k]["kode_reservasi"] = "#".$getReservedRoomTimeline[$k]["kode_reservasi"];
                                $dataArray[$i][$j]["reserved_room"][$k]["tgl_checkin"] = $getReservedRoomTimeline[$k]["tgl_checkin"];
                                $dataArray[$i][$j]["reserved_room"][$k]["tgl_checkout"] = $getReservedRoomTimeline[$k]["tgl_checkout"];
                                $dataArray[$i][$j]["reserved_room"][$k]["start_day"] = (int)Time::parse($getReservedRoomTimeline[$k]["tgl_checkin"])->getDay();
                                $dataArray[$i][$j]["reserved_room"][$k]["end_day"] = (int)Time::parse($getReservedRoomTimeline[$k]["tgl_checkout"])->getDay();
                                $dataArray[$i][$j]["reserved_room"][$k]["durasi_inap"] = (int)$getReservedRoomTimeline[$k]["durasi_inap"];
                            }
                        }

                    }
                }
            }
        }
        $db->close();
        return $dataArray;
    }


    private function monthTranslate(int $month)
    {
        if ($month == 1) {
            return "JANUARY";
        } elseif ($month == 2) {
            return "FEBRUARY";
        } elseif ($month == 3) {
            return "MARCH";
        } elseif ($month == 4) {
            return "APRIL";
        } elseif ($month == 5) {
            return "MAY";
        } elseif ($month == 6) {
            return "JUNE";
        } elseif ($month == 7) {
            return "JULY";
        } elseif ($month == 8) {
            return "AUGUST";
        } elseif ($month == 9) {
            return "SEPTEMBER";
        } elseif ($month == 10) {
            return "OCTOBER";
        } elseif ($month == 11) {
            return "NOVEMBER";
        } elseif ($month == 12) {
            return "DECEMBER";
        }
    }
}
?>