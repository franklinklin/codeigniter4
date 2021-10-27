<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'user';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = true;// este useSoftDeletes com TRUE ele exclui de maneira logina e marca a data basta adicionar uma coluna deleted_at updated_at created_at
    protected $protectFields        = true;
    protected $allowedFields        = [
        'id',
        'email',
        'password'
    ];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    function myquery(){
    
        $db = db_connect();
        $builder = $db->table('user')->get()->getResultArray();
        $db->close();
        return $builder;
    }
  
}
