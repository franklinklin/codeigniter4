<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'client';
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
        'address_business',
        'number',
        'number_business',
        'zipcode',
        'zipcode_business',
        'state',
        'state_business',
        'city',
        'city_business',
        'district',
        'district_business',
        'phone'
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
}
