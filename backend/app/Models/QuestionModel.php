<?php

namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'questions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'answer', 'id_category', 'jns_pertanyaan', 'kelas', 'sekolah', 'user_input', 'tgl_input'];

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

    // public function __construct() {
    //     $this->db = \Config\Database::connect();
    // }
    
    public function getKelas() {
        $db = \Config\Database::connect();
        $builder = $db->table('questions'); 
        $builder->distinct();
        $builder->select('kelas');
        $result = $builder->get()->getResult();  
        
        $myconfig = new \Config\MyConfig();
        $kelas = $myconfig->kelas;

        if(!empty($result)):            
            foreach($result as $k => $v):
                foreach($kelas as $k2 => $v2):
                    if($v->kelas == $v2['id']):
                        $result2[$k]['id'] = $v->kelas;
                        $result2[$k]['nama'] = $v2['nama'];
                    endif;
                endforeach;
            endforeach;
        endif;

        return $result2;
        // return $builder->getCompiledSelect();
    }

    public function getQuestionComplete($cat = null, $jns = null, $kelas = null, $urutan = null) {
        $this->db = \Config\Database::connect();
        $builder = $this->db->table('questions a'); 
        $builder->join('options b', 'a.id = b.id_question', 'left');        
        $builder->select('a.title as question, a.answer, b.title as options, a.id');
        
        if($cat != null):
            $builder->where('id_category', $cat);
        endif;

        if($jns != null):
            $builder->where('jns_pertanyaan', $jns);
        endif;

        if($kelas != null):
            $builder->where('kelas', $kelas);
        endif;

        $builder->orderBy('id', $urutan);                     

        $result = $builder->get()->getResult();  
           

        if(!empty($result)):            
            foreach($result as $k => $v):
                $result2[$v->id]['question'] = $v->question;
                $result2[$v->id]['answer'] = $v->answer;
                $result2[$v->id]['options'][] = $v->options;
                $result2[$v->id]['selected'] = null;
            endforeach;
        endif;
        $result2 = array_values($result2);
        return $result2;
        // return $builder->getCompiledSelect();
    }

    
}
