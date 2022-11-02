<?php

namespace App\Controllers;

use App\Models\QreferensiModel;
use App\Controllers\BaseController;

class Qreferensi extends BaseController
{
    public function index()
    {
        $model = new QreferensiModel();
        $data = $model->findAll();
        
        $result = ['data' => $data];        
        return view('qreferensi_list', $result);
    }

    public function create()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'id_ref' => 'required', 
            'no_ref' => 'required', 
            'keterangan' => 'required',             
            ]);
        $isDataValid = $validation->withRequest($this->request)->run();

        if($isDataValid){
            $model = new QreferensiModel();            
            $model->insert([
                "id_ref" => $this->request->getPost('id_ref'),
                "no_ref" => $this->request->getPost('no_ref'),
                "keterangan" => $this->request->getPost('keterangan'),
                "keterangan_label" => $this->request->getPost('keterangan_label')            
            ]);

            // $last_id = $model->insertID();
            return redirect('manref');
            exit;
        }
        
        return view('qreferensi_form');
    }

    public function edit($id = null)
    {
        $model = new QreferensiModel();
        $data['referensi'] = $model->where('id', $id)->first();
        
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'id_ref' => 'required', 
            'no_ref' => 'required', 
            'keterangan' => 'required',             
            ]);
        $isDataValid = $validation->withRequest($this->request)->run();


        if($isDataValid){
            $model->update($id, [
                "id_ref" => $this->request->getPost('id_ref'),
                "no_ref" => $this->request->getPost('no_ref'),
                "keterangan" => $this->request->getPost('keterangan'),
                "keterangan_label" => $this->request->getPost('keterangan_label')
            ]);

            return redirect('manref');
            exit;
        }

        return view('qreferensi_form', $data);
    }

    public function delete($id){
        $model = new QreferensiModel();
        $model->delete($id);
        return redirect('manref');
    }
}
