<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;

class Product extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function index()
    {
        $model = new ProductModel();
        $data = $model->findAll();
        return ($data) ? $this->respond($data) : $this->failNotFound();        
    }

    // solving error: Response to preflight request doesn't pass access control check: 
    // No 'Access-Control-Allow-Origin' header is present on the requested resource
    public function index_options()
    { 
        $this->response(null, REST_Controller::HTTP_OK); 
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new ProductModel();
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
            'title' => $json->title,
            'price' => $json->price,
        ];
        $model = new ProductModel();
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
            'title' => $json->title,
            'price' => $json->price,
        ];
        $model = new ProductModel();
        $cekId = $model->find(['id' => $id]);
        if(!$cekId) return $this->failNotFound();
        $product = $model->update($id, $data); 
        return ($product) ? $this->respond($product) : $this->fail('Gagal update', 400);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new ProductModel();
        $cekId = $model->find(['id' => $id]);
        if(!$cekId) return $this->failNotFound();
        $product = $model->delete($id); 
        return ($product) ? $this->respondDeleted('Hapus Berhasil') : $this->fail('Gagal hapus', 400);
    }
}
