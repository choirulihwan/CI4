<?php

namespace App\Models;

use CodeIgniter\Model;

class QreferensiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'qreferensi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_ref','no_ref','keterangan','keterangan_label'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function findByIdRef($id_ref) 
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);         
        $builder->where('id_ref', $id_ref);
        $result = $builder->get()->getResult();        
        return $result;
    }
}
