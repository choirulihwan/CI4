<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\TodoModel;

class Todo extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function index()
    {
        $model = new TodoModel();
        $data = $model->findAll();
        return ($data) ? $this->respond($data) : $this->failNotFound();        
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new TodoModel();
        $data = $model->find(['id'  => $id]);
        return ($data) ? $this->respond($data[0]) : $this->failNotFound(); 
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $json = $this->request->getJSON();
        $data = [
            'name' => $json->name,
            'status' => $json->status,
        ];
        $model = new TodoModel();
        $product = $model->insert($data);        
        return ($product) ? $this->respondCreated($product) : $this->fail('Gagal', 400);
    }

   /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $json = $this->request->getJSON();
        $data = [
            'name' => $json->name,
            'status' => $json->status,
        ];
        $model = new TodoModel();
        $cekId = $model->find(['id' => $id]);
        if(!$cekId) return $this->failNotFound();
        $todo = $model->update($id, $data); 
        return ($todo) ? $this->respond($todo) : $this->fail('Gagal update', 400);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new TodoModel();
        $cekId = $model->find(['id' => $id]);
        if(!$cekId) return $this->failNotFound();
        $todo = $model->delete($id); 
        return ($todo) ? $this->respondDeleted('Hapus Berhasil') : $this->fail('Gagal hapus', 400);
    }
}
