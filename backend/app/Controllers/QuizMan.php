<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

use App\Models\OptionModel;
use App\Models\QuestionModel;
use App\Models\QCategoryModel;
use App\Models\QreferensiModel;
use App\Controllers\BaseController;

class QuizMan extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        $cat_selected = $session->getFlashdata('cat_selected');    
        $kelas_selected = $session->getFlashdata('kelas_selected');    
        if(!$cat_selected) $cat_selected = '1';
        if(!$kelas_selected) $kelas_selected = '31';

        $model = new QuestionModel();
        $data = $model->where('id_category', $cat_selected)->findAll();

        $ocat = new QCategoryModel();
        $cat = $ocat->findAll();

        if (($this->request->getPost('category')) || ($this->request->getPost('kelas'))):
            $cat_selected = $this->request->getPost('category');
            $kelas_selected = $this->request->getPost('kelas');
            $data = $model->where('id_category', $cat_selected)
                    ->where('kelas', $kelas_selected)
                    ->findAll();
        endif;
        
        $result = ['data' => $data,
                    'cat'   => $cat,
                    'cat_selected' => $cat_selected,
                    'kelas_selected' => $kelas_selected];        
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

        $oref = new QreferensiModel();
        $sekolah = $oref->findByIdRef('NSS');
        $data['sekolah'] = $sekolah;
        
        if($isDataValid){
            $model = new QuestionModel();            
            $model->insert([
                "title" => $this->request->getPost('question'),
                "answer" => $this->request->getPost('answer'), 
                "id_category" => $this->request->getPost('category'),
                "jns_pertanyaan"    => $this->request->getPost('jns'),
                "kelas" => $this->request->getPost('kelas'),
                "sekolah" => $this->request->getPost('sekolah'),
                "user_input" => $session->get('id_user'),
                "tgl_input" => Time::now('Asia/Jakarta', 'en_US'),
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
            $session->setFlashdata('kelas_selected', $this->request->getPost('kelas'));
            return redirect('manquiz');
            exit;
        }
        
        return view('quiz_form', $data);
    }

    public function edit($id = null)
    {
        $session = \Config\Services::session();

        $oref = new QreferensiModel();
        $sekolah = $oref->findByIdRef('NSS');
        $data['sekolah'] = $sekolah;
        
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
                "id_category" => $this->request->getPost('category'),
                "jns_pertanyaan"    => $this->request->getPost('jns'), 
                "kelas" => $this->request->getPost('kelas'),
                "sekolah" => $this->request->getPost('sekolah'),
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
            $session->setFlashdata('kelas_selected', $this->request->getPost('kelas'));
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
        $session->setFlashdata('kelas_selected', $data['kelas']);
        $model->delete($id);        
        return redirect('manquiz');
    }
}
