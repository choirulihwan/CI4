<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Users extends BaseController
{
    public function index()
    {
        //
    }

    public function setpassword($pass) {
        echo password_hash($pass, PASSWORD_BCRYPT);
    }

    public function login() 
    {

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'username' => 'required',
            'password' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        
        if($isDataValid):
            $users = new UsersModel();
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $dataUser = $users->where(['username' => $username])->first();
            
            if ($dataUser) {
                if (password_verify($password, $dataUser['password'])) {
                    session()->set([
                        'username' => $dataUser['username'],
                        'nama' => $dataUser['nama'],
                        'logged_in' => TRUE
                    ]);
                    print "pass benar";exit;
                    return redirect()->to(base_url());
                } else {
                    session()->setFlashdata('error', 'Username & Password Salah');
                    print "pass salah";exit;
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                print "user gak ada";exit;
                return redirect()->back();
            } 
        else:
            print "input ndak valid";exit;       
        endif;


        return view('login_form');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/users/login');
    }
}
