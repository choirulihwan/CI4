<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\QCategoryModel;

class QCategoryMan extends BaseController
{
    public function index()
    {
        $model = new QCategoryModel();
        $data = $model->findAll();
        
        $result = ['data' => $data];        
        return view('qcategory_list', $result);
    }

    public function create()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules(['category' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if($isDataValid){
            $model = new QCategoryModel();            
            $model->insert([
                "category" => $this->request->getPost('category')            
            ]);
            $last_id = $model->insertID();
            return redirect('mancategory');
            exit;
        }
        
        return view('qcategory_form');
    }

    public function edit($id = null)
    {
        $model = new QCategoryModel();
        $data['category'] = $model->where('id', $id)->first();
        
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'id' => 'required',
            'category' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();


        if($isDataValid){
            $model->update($id, [
                "category" => $this->request->getPost('category')
            ]);

            return redirect('mancategory');
            exit;
        }

        return view('qcategory_form', $data);
    }

    public function delete($id){
        $model = new QCategoryModel();
        $model->delete($id);
        return redirect('mancategory');
    }
}
