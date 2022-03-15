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
        'action',
        'id_installment'
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
        $query = $db->query("SELECT * FROM user where deleted_at ='0000-00-00 00:00:00' ORDER BY id_perfil DESC");
        $list = $query->getResultArray();
        return $list;
    }

    function getMotoboysWithLaunch(){
        $db = db_connect();
        $query = $db->query('SELECT DISTINCT client.id_motoboy FROM billing INNER JOIN client ON client.id = billing.id_user');
        $list = $query->getResultArray();
        return $list;
    }

    function search_where($data){

        if(isset($data['date_search']) && $data['date_search']){
            $date_search = str_replace("/", "-", $data['date_search']);
        }

        if(isset($data['date_search_end']) && $data['date_search_end']){
            $date_search_end = str_replace("/", "-", $data['date_search_end']);
        }
       
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

            if(isset($data['date_search']) && $data['date_search']){
                $sql .= " AND log.date >= '".date('Y-m-d', strtotime($date_search))." 00:00:00'";                
            }
            if(isset($data['date_search_end']) && $data['date_search_end']){
                $sql .= " AND log.date <= '".date('Y-m-d', strtotime($date_search_end))." 23:59:59'";
            }
            if($data['user_search']){                
                $sql .= " AND user.id = ".$data['user_search']."";
            }
              
        $query = $db->query($sql);
        $list = $query->getResultArray();
        return $list;
    }

    function get_total_motoboy($data){

        if(isset($data['date_search']) && $data['date_search']){
            $date_search = str_replace("/", "-", $data['date_search']);
        }

        if(isset($data['date_search_end']) && $data['date_search_end']){
            $date_search_end = str_replace("/", "-", $data['date_search_end']);
        }
        
        $db = db_connect();
        $sql ="
            SELECT 
            log.id,
            perfil.id as id_perfil,            
            installments.amount,
            installments.pix,
            installments.especie
            FROM log
            INNER JOIN user ON user.id = log.id_user
            INNER JOIN perfil ON perfil.id = user.id_perfil
            INNER JOIN installments ON installments.id = log.id_installment
            WHERE
            user.id = ".$data['user_search']."
            AND installments.status = 3";

            if($data['date_search']){
                $sql .= " AND log.date >= '".date('Y-m-d', strtotime($date_search))." 00:00:00'";               
            }

            if(isset($data['date_search_end']) && $data['date_search_end']){
                $sql .= " AND log.date <= '".date('Y-m-d', strtotime($date_search_end))." 23:59:59'";
            }
              
        $query = $db->query($sql);
        $list = $query->getResultArray();
        return $list;
    }
}
