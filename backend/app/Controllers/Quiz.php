<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\QuestionModel;
use App\Models\QreferensiModel;

class Quiz extends ResourceController
{
    use ResponseTrait;
    public function index()
    {
        // $limit = 20;
        // $model = new QuestionModel();
        // $data = $model->getQuestionComplete();
        // shuffle($data);
        
        // for($i=0;$i<$limit;$i++):
        //     $data2[$i] = $data[$i];
        // endfor;
        
        // return ($data2) ? $this->respond($data2) : $this->failNotFound();   
        
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null, $jns = null, $kelas = null)
    {        
        $ref = new QReferensiModel();
        $data_ref = $ref->where('id_ref', 'JMS')->first();
        $limit = (int) $data_ref['keterangan'];        
        $data_rand = $ref->where('id_ref', 'JUS')->first();
        $rand = $data_rand['keterangan'];

        $model = new QuestionModel();
        $data = $model->getQuestionComplete($id, $jns, $kelas);
        
        $jml = count($data);
        if ($jml < $limit):
            $limit = $jml;
        endif;
        
        for($i=0;$i<$limit;$i++):            
            $data2[$i] = $data[$i];            
        endfor;

        if ($rand == 'rand'):
            shuffle($data2);
        elseif($rand == 'desc'):            
            $temp = $data2;
            for($i=0;$i<count($temp);$i++):
                $data2[$i] = $temp[count($temp)-($i+1)];
            endfor;
        endif;
        
        return ($data2) ? $this->respond($data2) : $this->failNotFound();
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
