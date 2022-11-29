<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Users extends BaseController
{
    public function index()
    {
        
    }

    public function setpassword($pass) {
        echo password_hash($pass, PASSWORD_BCRYPT);
    }

    public function changepassword()
    {
        
        $validation =  \Config\Services::validation();

        if (strtolower($this->request->getMethod()) === 'post') {   
            $session = \Config\Services::session();         
            $validation->setRules(
                [
                    'old_pass' => 'required',
                    'pass' => 'required|min_length[8]',
                    'confirm_pass' => 'required|matches[pass]',            
                ]
            );
            $isDataValid = $validation->withRequest($this->request)->run();
        
            if($isDataValid){
                $model = new UsersModel();            

                $row = $model->find($session->get('id_user'));
                $password = $this->request->getPost('old_pass');
                
                if (password_verify($password, $row['password'])):          
                    $model->update($session->get('id_user'), [                
                        "password" => password_hash($this->request->getPost('pass'), PASSWORD_BCRYPT)
                    ]);
            
                    return $this->logout(); 
                else:
                    session()->setFlashdata('error', 'Password lama tidak sesuai');                    
                    return redirect()->to('/users/chpass');
                endif;
            }
        } else {
            $data = [
                'judul' => 'Perubahan Password',
                'validation'    => $validation
            ];
    
            return view('changepassword_form', $data);
        } 

        
    }

    public function login() 
    {
        $validation = \Config\Services::validation();
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
                        'id_user' => $dataUser['id'],
                        'logged_in' => TRUE
                    ]);
                    
                    return redirect()->to(base_url());
                } else {
                    session()->setFlashdata('error', 'Username & Password Salah');                    
                    return redirect()->to('/users/login');
                }
            } else {
                session()->setFlashdata('error', 'Username belum terdaftar');                
                return redirect()->to('/users/login');
            }         
        endif;

        return view('login_form');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/users/login');
    }
}
