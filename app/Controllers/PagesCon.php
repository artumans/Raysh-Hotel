<?php

namespace App\Controllers;

class PagesCon extends BaseController
{ 
    public function index()
    {
        $param = [
            'title' => 'Sign In',
            'active' => 'signin',
            'preset' => view('Pages/signIn_form')
        ];
        return view('Layout/signUp_In', $param);
    }

    public function signIn()
    {
        if (!empty($_POST)) {
            $findUser = $this->findUser($_POST['userEmail'], $_POST['userPass']);
            if ($findUser) {
                $_SESSION['user'] = $findUser;
                return redirect()->route('/');
            } else {
                session()->setFlashdata('f_si', '<div class="row mb-3 alert alert-danger" role="alert">Email atau Password anda salah !</div>');
                return redirect()->route('signin');
            }
        } else {
            return view('Pages/signIn_form');
        }
        
    }

    public function signUp()
    {
        if (!empty($_POST)) {
            $addUser = $this->addUser($_POST['userEmail'], $_POST['userPass'], $_POST['userName'], $_POST['userPhone'], $_POST['userAddr']);
            if ($addUser) {
                $_SESSION['user'] = $addUser;
                return redirect()->route('/');
            } else {
                $param = [
                    'title' => 'Sign In',
                    'active' => 'signup',
                    'preset' => view('Pages/signUp_form')
                ];
                return view('Layout/signUp_In', $param);
            }
        } else {
            return view('Pages/signUp_form');
        }
        
    }

    public function signOut()
    {
        unset($_SESSION['user']);
        return redirect()->route('/');
    }

    public function findUser($userEmail, $userPass)
    {
        $db = db_connect();
        $getUser = $db->query('SELECT * FROM tb_tamu WHERE email = "'.$userEmail.'" AND password = "'.$userPass.'"')->getResultArray();
        if (!$getUser) {
            $db->close();
            return false;
        } else {
            $db->close();
            return $getUser[0];
        }
    
    }

    public function addUser($userEmail, $userPass, $userName, $userPhone, $userAddr)
    {
        $db = db_connect();
        $findEmail = $db->query('SELECT * FROM tb_tamu WHERE email = "'.$userEmail.'"')->getResultArray();

        if ($findEmail) {
            session()->setFlashdata('f_su', '<div class="row mb-3 alert alert-danger" role="alert">Email telah digunakan !</div>');
            $db->close();
            return false;
        } else {
            $data = [
                'nama' => $userName,
                'email' => $userEmail,
                'alamat' => $userAddr,
                'password' => $userPass
            ];
            
            if ($userPhone[0] == "0") {
                $data['no_telepon'] = $userPhone;
            } else {
                $data['no_telepon'] = "0".$userPhone;
            }


            if ($db->table('tb_tamu')->insert($data)) {
                $returnUser = $db->query('SELECT * FROM tb_tamu WHERE email = "'.$userEmail.'" AND password = "'.$userPass.'"')->getResultArray();
                $db->close();
                return $returnUser[0];
            } else {
                session()->setFlashdata('f_su', '<div class="row mb-3 alert alert-danger" role="alert">Gagal membuat akun !</div>');
                $db->close();
                return false;
            }
        }
    }

}
