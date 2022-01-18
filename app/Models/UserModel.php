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
    protected $useSoftDeletes       = false;
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

            if(isset($result->name) && $result->name){
                $newdata = [
                    'menu'  => $result->id_perfil,
                    'cpf'  => $result->cpf,
                    'username'  => $result->name,
                    'email'     => $result->email,
                    'id'        => $result->id,
                    'logged_in' => TRUE
                ];
                $this->session->set($newdata);
            }
        }
        return $result;
    }

    function edit($data){
        
        $db = db_connect();
        $builder = $db->table('user');
        $edit = [
            'name' => $data['name'],
            //'email' => $data['email'],
            'id_perfil' => $data['id_perfil'],
            'password' => md5($data['password']),
            'cpf' => $data['cpf']
        ];        
        $builder->where('id', $data['id']);
        $builder->update($edit);
        return true;
    }

    function lastId(){
        $db = db_connect();
        $query = $db->query('SELECT id FROM user order by id desc limit 1;');
        $last_row = $query->getRow();
        return $last_row->id;
    }

    function getCpf($cpf){
        $db = db_connect();
        $query = $db->query('SELECT id FROM user WHERE cpf ="'.$cpf.'"');
        $last_row = $query->getRow();
        return $last_row->id;
    }

    function ajaxGetCpf($cpf){
        $db = db_connect();
        $query = $db->query('SELECT * FROM user WHERE cpf ="'.$cpf.'"');
        $last_row = $query->getRow();
        return $last_row->id;
    }    

    function checkCpf($cpf,$id_perfil){
        $db = db_connect();
        if($id_perfil ==2){
            $query = $db->query("SELECT * FROM motoboy WHERE document ='".$cpf."'");        
        }elseif($id_perfil ==3){
            $query = $db->query("SELECT * FROM client WHERE document ='".$cpf."'");
        }    
        $list = $query->getRow();
        return $list;
    }

    function checkDuplicate($cpf,$id_perfil){
        $db = db_connect();
        $query = $db->query("SELECT * FROM user WHERE cpf ='".$cpf."' AND id_perfil='".$id_perfil."'");  
        $list = $query->getRow();     
        return $list; 
    }

    function save_user($data){
        $db = db_connect();
        $builder = $db->table('user');

        $data = [
            'cpf' => $data['cpf'],
            'name' => $data['name'],
            'id_perfil' => $data['id_perfil'],
            'id_user' => $data['id_user'],
            'password' => md5($data['password'])
        ];
        $builder->insert($data);
        return true;
    }    
}
