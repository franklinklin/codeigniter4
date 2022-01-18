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
    
    function log($data){

        $db = db_connect();
        $builder = $db->table('log');
        //$builder->save($data);

        $builder->set('id_perfil', $data['id_perfil']);
        $builder->set('id_user', $data['id_user']);
        $builder->set('id_module',  $data['id_module']);
        $builder->set('action', $data['action']);
        $builder->insert();
    }

    function getUser(){
        $db = db_connect();
        $query = $db->query('SELECT * FROM user');
        $list = $query->getResultArray();
        return $list;
    }

    function search_where($data){

        $date_search = str_replace("/", "-", $data['date_search']);
       
        $db = db_connect();
        $sql ="
            SELECT 
            log.id,
            perfil.name as perfil,
            user.id_perfil,
            user.name as user,
            module.name as module,
            log.action,
            log.date
            FROM log
            INNER JOIN user ON user.id = log.id_user
            INNER JOIN perfil ON perfil.id = user.id_perfil
            INNER JOIN module ON module.id = log.id_module
            WHERE
            (user.name LIKE '%".$data['search']."%' OR
             perfil.name LIKE '%".$data['search']."%' OR
             log.date LIKE '%".$data['search']."%' OR
             module.name LIKE '%".$data['search']."%' OR
             log.action LIKE '%".$data['search']."%')";

             if($data['date_search']){
                $sql .= " AND log.date >= '".date('Y-m-d', strtotime($date_search))." 00:00:00'";
                $sql .= " AND log.date <= '".date('Y-m-d', strtotime($date_search))." 23:59:59'";
             }
             if($data['user_search']){                
                $sql .= " AND user.id = ".$data['user_search']."";
             }
              
        $query = $db->query($sql);
        $list = $query->getResultArray();
        return $list;
    }
}
