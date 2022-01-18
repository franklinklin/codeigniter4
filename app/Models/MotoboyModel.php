<?php

namespace App\Models;

use CodeIgniter\Model;

class MotoboyModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'motoboy';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'id',
        'name',
        'document',
        'birth_date',
        'email',
        'address',
        'number',
        'zipcode',
        'state',
        'city',
        'district',
        'phone',
        'license_plate',
        'cnh',
        'year',
        'owner'
    ];

    // Dates
    protected $useTimestamps        = true;
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

    function getMotoboys(){
        $db = db_connect();
        $query = $db->query("SELECT id, name FROM motoboy");
        $list = $query->getResultArray();
        return $list;
    }
}
