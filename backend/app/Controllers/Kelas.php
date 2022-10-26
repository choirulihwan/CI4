<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\QuestionModel;

class Kelas extends ResourceController
{
    use ResponseTrait;
    public function index()
    {
        // $myconfig = new \Config\MyConfig();
        // $data = $myconfig->kelas;
        $model = new QuestionModel();
        $data = $model->getKelas();
        return ($data) ? $this->respond($data) : $this->failNotFound();           
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null, $jns = null)
    {        
        
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
