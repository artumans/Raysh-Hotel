<?php

namespace App\Controllers;
use App\Models\ReservationModel;

class ProfileController extends BaseController
{ 
    public function index() 
    {
        if (isset($_SESSION['user'])) {
            $model = new ReservationModel();
            $dataHistory = $model->getUserHistory((int)$_SESSION['user']['id_tamu']);
            $data = ['data' => $dataHistory];
            $param = [
                'title' => 'Profile',
                'page' => 'profile',
                'preset' => view('guest/profile_menu/historybooking', $data)
            ];
    
            return view('guest/profile', $param);
        } else {
            return redirect()->route('signin');
        }
    }

    public function contentHistory()
    {
        $model = new ReservationModel();
        $dataHistory = $model->getUserHistory((int)$_SESSION['user']['id_tamu']);
        $data = ['data' => $dataHistory];
        return view('guest/profile_menu/historybooking', $data);
    }

    public function contentUserProfile()
    {
        return view('guest/profile_menu/userProfile');
    }

    public function contentSettings()
    {
        return view('guest/profile_menu/settings');
    }


    public function updateUser($id = null)
    {
        // dd($_POST, $id);
        $db = db_connect();
        $findUser = $db->query('SELECT * FROM tb_tamu WHERE id_tamu = '.$id.' AND password = "'.$_POST['userPass'].'"')->getResultArray();

        if ($findUser) {
            $newData = [
                'nama' => $_POST['userName'],
                'email' => $_POST['userEmail'],
                'no_telepon' => $_POST['userPhone'],
                'alamat' => $_POST['userAddr'],
            ];

            if ($db->table('tb_tamu')->where('id_tamu',$id)->update($newData)) {
                $_SESSION['user'] = $newData;
                $_SESSION['user']['id_tamu'] = $id;
                session()->setFlashdata('updateInfo', 
                '<div class="row mb-3 mt-3 alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Edit Data !</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
                return redirect()->route('profile');
            }
        } else {
            session()->setFlashdata('updateInfo', 
            '<div class="row mb-3 mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal Edit Data : Pastikan password anda benar !</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            return redirect()->route('profile');
        }

        $db->close();
    }

}
