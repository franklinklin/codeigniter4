<?php

namespace App\Models;

use CodeIgniter\Model;
$this->session = \Config\Services::session();

class UserModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'user';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'id',
        'email',
        'password'
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
    
/*    public function __construct()
    {
        
    }*/

    function checkLogin($cpf, $password){
        
        $this->session = \Config\Services::session();        
        $this->session->start();

        $result = false;
        if($cpf && $password){
            $db = db_connect();
                $builder = $db->table('user');
                $builder->where('cpf', $cpf);
                $builder->where('password', md5($password));
                $result = $builder->get()->getRow();
            $db->close();

            if(isset($result->name) && $result->name && isset($result->email) && $result->email){
                $newdata = [
                    'username'  => $result->name,
                    'email'     => $result->email,
                    'logged_in' => TRUE
                ];
                $this->session->set($newdata);
            }
        }
        return $result;
    }
}
