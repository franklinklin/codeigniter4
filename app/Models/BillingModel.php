<?php

namespace App\Models;

use CodeIgniter\Model;

class BillingModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'billing';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'id',
        'document',
        'name',
        'value',
        'installments',
        'installments_value',
        'amount_paid',
        'amount_to_be_paid',
        'contract_date',
        'phone',
        'company',
        'fees',
        'total',
        'id_user'
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

    function lastId(){
        $db = db_connect();
        $query = $db->query('SELECT id FROM billing order by id desc limit 1;');
        $last_row = $query->getRow();
        return $last_row->id;
    }
    
    function list_installments($id){
        $db = db_connect();
        $query = $db->query('SELECT * FROM installments WHERE id_billing ='.$id);
        $list = $query->getResultArray();
        return $list;
    }

    function getCpf($cpf){
        $db = db_connect();
        $query = $db->query("SELECT * FROM billing WHERE document ='".$cpf."'");
        $list = $query->getResultArray();
        return $list;
    }

    function ajaxGetCpf($cpf){
        $db = db_connect();
        $query = $db->query("SELECT * FROM client WHERE document ='".$cpf."'");
        $list = $query->getRow();
        return $list;
    }

    function clientId($id){
        $db = db_connect();
        $query = $db->query("SELECT * FROM client WHERE id ='".$id."'");
        $list = $query->getRow();
        return $list;
    }

    function checkCpfIdBilling($cpf,$id){
        $db = db_connect();
        $query = $db->query("SELECT COUNT(billing.id) as id
                             FROM billing 
                             INNER JOIN installments ON installments.id_billing = billing.id
                             WHERE billing.document ='".$cpf."'
                             AND billing.id ='".$id."'");
        $response = $query->getRow();
        return $response;
    }

    function checkCpfIdBillingMotoboy($cpf,$id){
        $db = db_connect();
        $query = $db->query("SELECT COUNT(billing.id) as id
                             FROM billing 
                             INNER JOIN installments ON installments.id_billing = billing.id
                             INNER JOIN client ON client.id = billing.id_user
                             INNER JOIN motoboy ON motoboy.id = client.id_motoboy
                             WHERE motoboy.document = '".$cpf."'
                             AND billing.id ='".$id."'");
        $response = $query->getRow();
        return $response;
    }


    function getAmountPaid($id){
        $db = db_connect();
        $query = $db->query("SELECT amount FROM installments WHERE id_billing ='".$id."' AND status=3");
        $list = $query->getResultArray();
        return $list;
    }

    function getMotoboys(){
        $db = db_connect();
        $query = $db->query("SELECT id, name FROM motoboy");
        $list = $query->getResultArray();
        return $list;
    }

    function getCollect($cpf){
        $db = db_connect();
        /*$sql="SELECT 
                installments.id,
                client.name,
                client.zipcode,
                client.number,
                client.address,
                client.phone,
                client.district,
                client.city,
                client.state,
                client.phone,
                installments.installment, 
                billing.installments,
                installments.amount, 
                installments.status
            FROM installments 
            INNER JOIN billing_motoboy ON billing_motoboy.id_installment = installments.id 
            INNER JOIN motoboy ON motoboy.id = billing_motoboy.id_motoboy
            INNER JOIN billing ON billing.id = installments.id_billing
            INNER JOIN client ON client.id = billing.id_user
            WHERE motoboy.document = '".$cpf."'";
        $query = $db->query($sql);
        $list = $query->getResultArray();
        return $list;
        */
        
        $sql="SELECT     
            billing.id,
            client.name,
            billing.amount_to_be_paid ,
            billing.installments,
            billing.amount_paid,
            client.zipcode,
            client.number,
            client.address,
            client.phone,
            client.district,    
            client.city,
            client.state,
            client.phone           
        FROM billing
        INNER JOIN client ON client.id = billing.id_user
        INNER JOIN motoboy ON motoboy.id = client.id_motoboy
        WHERE motoboy.document = '".$cpf."'";
        $query = $db->query($sql);
        $list = $query->getResultArray();
        return $list;
    }

    function installments_paid($cpf){

        $db = db_connect();
        $sql = "SELECT id_billing 
                FROM installments
                INNER JOIN billing ON billing.id = installments.id_billing
                INNER JOIN client ON client.id = billing.id_user
                INNER JOIN motoboy ON motoboy.id = client.id_motoboy
                WHERE 
                installments.payment_date ='".date('Y-m-d')."' 
                AND installments.status =3
                AND motoboy.document ='".$cpf."'";
        $query = $db->query($sql);
        $list = $query->getResultArray();
        return $list;
    }

    function updateAmountPaid($detail_id,$amountPaid){
    
        $db = db_connect();
        $builder = $db->table('billing');
        $edit = [
            'amount_paid' => number_format($amountPaid, 2, ',', '.'),
            'last_date' => date('Y-m-d')
        ];        
        $builder->where('id', $detail_id);
        $builder->update($edit);
    }

    function updateInstallments($data){
    
        $db = db_connect();
        $builder = $db->table('installments');
        $edit = [
            'obs' => $data['obs'],
            'pix' => $data['pix'],
            'especie' => $data['especie']
        ];        
        $builder->where('id', $data['id']);
        $builder->update($edit);
    }


    function setSendMotoboy($id_installment, $id_motoboy){        
        $db = db_connect();
        $builder = $db->table('billing_motoboy');
        $data = [
            'id_installment' => $id_installment,
            'id_motoboy' => $id_motoboy
        ];        
        $builder->insert($data);
    }

    function setStatus($id_installment, $id_status){
        $db = db_connect();
        $builder = $db->table('installments');
        $edit = [
            'id' => $id_installment,
            'status' => $id_status
        ];        
        $builder->where('id', $id_installment);
        $builder->update($edit);
    }

    function insert_installments($data){
        $db = db_connect();
        $builder = $db->table('installments');
        
        $data = [
            'id_billing' => $data['id_billing'],
            'installment'  => $data['installment'],
            'amount'  => $data['amount'],
            'payment_date'  => '0000-00-00',
            'status'  => $data['status'],
            'document'  => $data['document']
        ];
        $builder->insert($data);
    }
    
    function edit($data){
        
        $db = db_connect();
        $builder = $db->table('billing');
        $edit = [
            'phone' => $data['phone']
            //,
            //'amount_paid' => $data['amount_paid']
        ];        
        $builder->where('id', $data['id']);
        $builder->update($edit);
        return true;
    }

    function payment($data){
        $db = db_connect();
        $builder = $db->table('installments');
        
        $pay = [
            'type' => $data['type_payment'],
            //'advance' => $data['advance'],
            'status' => 2,
            'payment_date' => date('Y-m-d')
        ];        
        $builder->where('id', $data['id_installment']);
        $builder->where('id_billing', $data['detail_id']);        
        $builder->update($pay);
        return true;
    }

    function confirm_payment($data){
        $db = db_connect();
        $builder = $db->table('installments');
        
        $pay = ['status' => 3];

        $builder->where('id', $data['id_installment']);
        $builder->where('id_billing', $data['detail_id']);        
        $builder->update($pay);
        return true;
    }

    function save_billing($id_installment, $id_motoboy){        
        $db = db_connect();
        $builder = $db->table('billing');
        $data = [
            'id_installment' => $id_installment,
            'id_motoboy' => $id_motoboy
        ];        
        $builder->insert($data);
    }
    function checkStatus($id){
        $db = db_connect();
        $sql="SELECT sum(status) as status FROM installments WHERE id_billing=".$id;
        $query = $db->query($sql);
        $list = $query->getRow();
        return $list;
    }
    
}
