<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\QuestionModel;
use App\Models\OptionModel;
use App\Models\QCategoryModel;

class QuizMan extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        $cat_selected = $session->getFlashdata('cat_selected');    
        if(!$cat_selected) $cat_selected = '1';

        $model = new QuestionModel();
        $data = $model->where('id_category', $cat_selected)->findAll();

        $ocat = new QCategoryModel();
        $cat = $ocat->findAll();

        if ($this->request->getPost('category')):
            $cat_selected = $this->request->getPost('category');
            $data = $model->where('id_category', $cat_selected)->findAll();
        endif;
        
        $result = ['data' => $data,
                    'cat'   => $cat,
                    'cat_selected' => $cat_selected];        
        return view('quiz_list', $result);
    }

    public function create()
    {
        $session = \Config\Services::session();
        $validation =  \Config\Services::validation();
        $validation->setRules(['question' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        $ocat = new QCategoryModel();
        $cat = $ocat->findAll();
        $data['cat'] = $cat;

        if($isDataValid){
            $model = new QuestionModel();            
            $model->insert([
                "title" => $this->request->getPost('question'),
                "answer" => $this->request->getPost('answer'), 
                "id_category" => $this->request->getPost('category')                
            ]);
            $last_id = $model->insertID();
            
            $model = new OptionModel();
            foreach($this->request->getPost('pilihan') as $v):
                if(trim($v) != ''):
                    $model->insert([
                        "id_question" => $last_id,
                        "title" => $v            
                    ]);
                endif;
            endforeach;
            
            $session->setFlashdata('cat_selected', $this->request->getPost('category'));
            return redirect('manquiz');
            exit;
        }
        
        return view('quiz_form', $data);
    }

    public function edit($id = null)
    {
        $session = \Config\Services::session();

        $ocat = new QCategoryModel();
        $cat = $ocat->findAll();
        $data['cat'] = $cat;
        
        $model = new QuestionModel();
        $data['question'] = $model->where('id', $id)->first();

        $options = new OptionModel();
        $data['options'] = $options->where('id_question', $id)->findAll();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'id' => 'required',
            'question' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();


        if($isDataValid){
            $model->update($id, [
                "title" => $this->request->getPost('question'),
                "answer" => $this->request->getPost('answer'),
                "id_category" => $this->request->getPost('category')      
            ]);

            //delete and insert all options
            $options->delete_by_idquestion($id);
            foreach($this->request->getPost('pilihan') as $v):
                if(trim($v) != ''):
                    $options->insert([
                        "id_question" => $id,
                        "title" => $v            
                    ]);
                endif;
            endforeach;

            $session->setFlashdata('cat_selected', $this->request->getPost('category'));
            return redirect('manquiz');
            exit;
        }

        return view('quiz_form', $data);
    }

    public function delete($id){
        $session = \Config\Services::session();

        $model = new QuestionModel();
        $data = $model->where('id', $id)->first();

        $session->setFlashdata('cat_selected', $data['id_category']);
        $model->delete($id);        
        return redirect('manquiz');
    }
}
