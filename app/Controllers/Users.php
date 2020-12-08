<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        $data = [
            'title' => 'Login | Retail ABC',
            'validation' => \Config\Services::validation()
        ];

        if (session()->get('logged_in')) {
            return redirect()->to('/');
        } else {
            return view('pages/login', $data);
        }
    }

    public function auth()
    {
        $inputEmail = $this->request->getVar('email');
        $inputPassword = $this->request->getVar('password');
        $user = $this->userModel->getUser($inputEmail);
        if ($user) {
            $password = $user['user_password'];
            if ($inputPassword == $password) {
                $dataSession = [
                    'user_id' => $user['user_id'],
                    'user_level' => $user['user_level'],
                    'user_name' => $user['user_name'],
                    'user_email' => $user['user_email'],
                    'logged_in' => TRUE
                ];
                session()->set($dataSession);
                return redirect()->to('/');
            } else {
                session()->setFlashdata('pesan', 'Password salah.');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('pesan', 'Email tidak ditemukan.');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    //--------------------------------------------------------------------

}
