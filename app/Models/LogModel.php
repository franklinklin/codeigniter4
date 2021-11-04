<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'log';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'id',
        'id_user',
        'id_module',
        'date',
        'action'

    ];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

    function list(){
        
        $db = db_connect();
        $builder = $db->table('log');
        $builder->select('perfil.name as perfil');
        $builder->select('log.*');
        $builder->join('perfil','perfil.id = log.id_perfil');
        $query = $builder->get();
        //$result = $builder->get()->getRow();
        $db->close();
        $result = $query->getResultArray();
        return $result;
    }
}
