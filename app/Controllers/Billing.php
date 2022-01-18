<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BillingModel;
use App\Models\LogModel;

class Billing extends BaseController
{
    private $model;
    private $controller;
    private $form;
    private $message;

    public function __construct()
    {
        $this->session = \Config\Services::session();        
        $this->session->start();

        $session = $this->session->get(); 
                    
        if(!isset($session['logged_in']) || $session['logged_in'] == false){
            header("Location:".base_url());
            die();
        }
        $this->id_user = $session['id'];
        $this->menu = $session['menu'];
        $this->cpf = $session['cpf'];
        $this->model = new BillingModel();   
        $this->controller = 'billing';
        $this->form = 'billing_form';
        $this->message = 'Cobrança';
        $this->detail = 'perfil_detail';
        $this->list = 'perfil_detail_list';

    }

    public function index()
    {   
        if($this->menu ==3){
            
            return view('perfil_client_list',[
                'search' => $this->controller,
                'billings'=> $this->model->getCpf($this->cpf)
            ]);
            die();
        }

        if($this->menu ==2){
            $colletc = $this->model->getCollect($this->cpf);          
            return view('perfil_motoboy',[
                'search' => $this->controller,
                'billings'=> $this->model->getCollect($this->cpf),
                'paid' => $this->model->installments_paid($this->cpf)
            ]);
            die();
        }
        
        /*$this->id_user = $session['id'];
        $this->menu = $session['menu'];
        $this->cpf = $session['cpf'];*/
        /*$data['id_perfil'] = $this->menu;
        $data['id_user'] = $this->id_user;
        $data['id_module'] = 6;
        $data['date'] = date('Y-m-d H:i:s');
        $data['action'] = 'Acessou a listagem de cobrança';
        $logModel = new LogModel();
        $logModel->save($data);*/

        $request = service('request');
		$searchData = $request->getPost();

		$search = "";
		if (isset($searchData) && isset($searchData['search'])) {
			$search = $searchData['search'];
		}

        if ($search == '') {
			//$paginateData = $this->model->paginate(10);
            $paginateData = $this->model->select('client.name')
                                        ->select('billing.amount_paid')
                                        ->select('billing.total')
                                        ->select('billing.amount_to_be_paid')
                                        ->select('billing.id')
                                        ->select('billing.last_date')
                                        ->join('client', 'client.id = billing.id_user')
                                        ->paginate(1000);
		} else {
			$paginateData = $this->model
                                 ->select('client.name')
                                 ->select('billing.amount_paid')
                                 ->select('billing.total')
                                 ->select('billing.amount_to_be_paid')
                                 ->select('billing.id')
                                 ->select('billing.last_date')
                                 ->join('client', 'client.id = billing.id_user')
                                 ->orLike('client.name', $search)
                                 ->orLike('client.document', $search)
                                 ->orLike('billing.total', $search)
                                 ->orLike('billing.amount_to_be_paid', $search)
                                 ->orLike('billing.amount_paid', $search)
                                 ->paginate(1000);
		}

        return view($this->controller,
            [   
                'form' => $this->controller,
                'search' => $this->controller,
                'billings' => $paginateData,
                'menu' => $this->menu,
                'pager' => $this->model->pager
            ]
        );
    }

    public function list()
    {   
        error_reporting(E_ALL);

        if($this->menu ==3){
            
            return view('perfil_client_list',[
                'search' => $this->controller,
                'billings'=> $this->model->getCpf($this->cpf)
            ]);
            die();
        }

        if($this->menu ==2){
            return view('perfil_motoboy',[
                'search' => $this->controller,
                'billings'=> $this->model->getCollect($this->cpf)
            ]);
            die();
        }
        
        $request = service('request');
		$searchData = $request->getPost();
        
        $search = "";
		if (isset($searchData) && isset($searchData['search'])) {
			$search = $searchData['search'];
		}

        if ($search == '') {
			//$paginateData = $this->model->paginate(10);
            $paginateData = $this->model->select('client.name')
                                        ->select('billing.amount_paid')
                                        ->select('billing.total')
                                        ->select('billing.amount_to_be_paid')
                                        ->select('billing.id')
                                        ->join('client', 'client.id = billing.id_user');
                                        //->paginate(10);
		} else {
			$paginateData = $this->model
                                 ->select('client.name')
                                 ->select('billing.amount_paid')
                                 ->select('billing.total')
                                 ->select('billing.amount_to_be_paid')
                                 ->select('billing.id')
                                 ->join('client', 'client.id = billing.id_user')
                                 ->orLike('client.name', $search)
                                 ->orLike('client.document', $search)
                                 ->orLike('billing.total', $search)
                                 ->orLike('billing.amount_to_be_paid', $search)
                                 ->orLike('billing.amount_paid', $search);
                                 //->paginate(10);
		}

        return view($this->controller,
            [   
                'form' => $this->controller,
                'search' => $this->controller,
                'billings' => $paginateData,
                'menu' => $this->menu,
                'pager' => ''
                //'pager' => $this->model->pager
            ]
        );
    }

    public function detail_id($id){

        $billing = $this->model->find($id);
        $client = $this->model->ajaxGetCpf($billing['document']);            

        return view($this->form,
            [
                'billing'=> $billing,
                'save'=>$this->controller,
                'search'=>$this->controller,
                'list_installments'=> $this->model->list_installments($id),
                'success'=> true,
                'client'=>$client
            ]
        );
    }    

    public function detail($id){

       $check = $this->model->checkCpfIdBilling($this->cpf,$id);       
       if($check->id < 1){
            header("Location:".base_url('billing'));
            die();
       }

        return view('perfil_client',[
            'billing'=> $this->model->find($id),
            'list_installments'=> $this->model->list_installments($id),
            'detail_id'=>$id
        ]);
    }

    public function detail_motoboy($id){

        $check = $this->model->checkCpfIdBillingMotoboy($this->cpf,$id);       
        if($check->id < 1){
             header("Location:".base_url('billing'));
             die();
        }
 
         return view('perfil_client',[
             'billing'=> $this->model->find($id),
             'list_installments'=> $this->model->list_installments($id),
             'detail_id'=>$id,
             'perfil_moto'=>true
         ]);
     }

    public function payment(){
        
        if($this->model->payment($this->request->getPost())){
            header("Location:".base_url('billing/detail/'.$this->request->getPost('detail_id')));
            die();
        }
    }

    public function confirm_payment(){

        $data['id_perfil'] = $this->menu;
        $data['id_user'] = $this->id_user;
        $data['id_module'] = 6;
        $data['date'] = date('Y-m-d H:i:s');
        $data['action'] = 'confirmou pagamento id:'.$this->request->getPost('id_installment');
        $logModel = new LogModel();
        $logModel->save($data);

        $redirect_detail_motoboy = $this->request->getPost('redirect_detail_motoboy');

        if($this->model->confirm_payment($this->request->getPost())){

            $detail_id = $this->request->getPost('detail_id');
            $getAmountPaid = $this->model->getAmountPaid($detail_id);

            if($getAmountPaid){
                $amountPaid = 0;
                foreach($getAmountPaid as $paid){
                    $amount = str_replace(".", "", $paid['amount']);
                    $amount = str_replace(",", ".", $amount);                
                    $amountPaid = $amountPaid + $amount;
                }          
                $this->model->updateAmountPaid($detail_id,$amountPaid);                
            }
            
            if($redirect_detail_motoboy == true) {

                $data['obs'] = $this->request->getPost('obs');
                $data['pix'] = $this->request->getPost('pix');
                $data['especie'] = $this->request->getPost('especie');
                $data['id'] = $this->request->getPost('id_installment');
                $this->model->updateInstallments($data);

                header("Location:".base_url('billing/detail_motoboy/'.$detail_id));
            }else{    
                header("Location:".base_url('billing/edit/'.$detail_id));
            }
            die();
        }
    }

    public function delete($id){

        if($this->model->delete($id)){

           echo view('messages',[
               'message' => $this->message.' excluído com sucesso',
               'back'=> $this->controller
           ]);
        }else{

            echo"Erro.";
        }
    }

    public function create(){
        return view($this->form,[
                                    'search' => $this->controller,
                                    'save' => $this->controller
                                ]);
    }

    public function save(){
        
        $post = $this->request->getPost();
        $billing = $post;
        if(isset($post['document']) && $post['document'] ==''){
            $required[] = 'CPF';
        }else{
            $checkCpf = $this->model->ajaxGetCpf($post['document']);            
            if($checkCpf == false){
                $required[] = 'este CPF não cadastrado';
            }else{
                $client = $checkCpf;
            }
        }

        if(isset($post['contract_date']) && $post['contract_date'] ==''){
            $required[] = 'Data do contrato';
        }

        /*if(isset($post['name']) && $post['name'] ==''){
            $required[] = 'Nome';
        }*/

        /*if(isset($post['phone']) && $post['phone'] ==''){
            $required[] = 'Contato';
        }*/

        if(isset($post['total']) && $post['total'] ==''){
            $required[] = 'Valor';
        }

        if(isset($post['fees']) && $post['fees'] ==''){
            $required[] = 'Juros';
        }

        if(isset($post['installments']) && $post['installments'] ==''){
            $required[] = 'QTD de Parcelas';
        }

        if(isset($post['installments_value']) && $post['installments_value'] ==''){
            $required[] = 'Valor da Parcelas';
        }

        if(isset($post['amount_to_be_paid']) && $post['amount_to_be_paid'] ==''){
            $required[] = 'Valor a ser pago';
        }

        if(isset($required)){
            
            return view($this->form,[
                'required' => $required,
                'search' => $this->controller,
                'save' => $this->controller,
                'billing' => $billing
            ]);
        }else{

            if(isset($post['id']) && $post['id']){
                
                if($this->model->edit($this->request->getPost())){

                    return view($this->form,[
                        'billing'=> $this->model->find($post['id']),
                        'save'=>$this->controller,
                        'search'=>$this->controller,
                        'list_installments'=> $this->model->list_installments($post['id']),
                        'success_edit'=> true,
                        'client'=>$client
                    ]);
                } else {
                    echo "Ocorreu um erro";
                }
            }else{

                $post['contract_date'] = date('Y-m-d', strtotime($post['contract_date']));                
                $post['id_user'] = $client->id;
                
                if($this->model->save($post)){

                    $lastId = $this->model->lastId();

                    $data['id_perfil'] = $this->menu;
                    $data['id_user'] = $this->id_user;
                    $data['id_module'] = 6;
                    $data['date'] = date('Y-m-d H:i:s');
                    $data['action'] = 'Cadastrou a cobrança id:'.$lastId;
                    $logModel = new LogModel();
                    $logModel->save($data);
                    
                    $installments = $post['installments'];
                    for ($i = 1; $i <= $installments; $i++) {

                        $data['id_billing'] = $lastId;
                        $data['installment'] = $i;
                        $data['amount'] = $post['installments_value'];                    
                        $data['status'] =1;
                        $data['document'] = $post['document'];
                        $this->model->insert_installments($data);
                    }

                    header("Location:".base_url('billing/detail_id/'.$lastId));
                    die();
                }
            }
            
        }
    }

    public function edit($id){

        /*$data['id_perfil'] = $this->menu;
        $data['id_user'] = $this->id_user;
        $data['id_module'] = 6;
        $data['date'] = date('Y-m-d H:i:s');
        $data['action'] = 'Acessou detalhe da cobrança id:'.$id;
        $logModel = new LogModel();
        $logModel->save($data);*/

        $billing = $this->model->find($id);
        //echo $billing['id_user'];
        $client = $this->model->clientId($billing['id_user']);
        
        return view($this->form,
            [
                'billing'=> $billing,
                'save'=>$this->controller,
                'search'=>$this->controller,
                'list_installments'=> $this->model->list_installments($id),
                'detail_id'=>$id,
                'motoboys'=>$this->model->getMotoboys(),
                'client'=>$client     
            ]
        );  
    }

    public function client(){
        return view("perfil_client",[
            'user'=> '',
            'save'=> '',
            'search'=> ''
        ]);
    }

    public function motoboy(){
        return view("perfil_motoboy",[
            'user'=> '',
            'save'=> '',
            'search'=> ''
        ]);
    }

    public function ajaxSendMoto(){
        
        $post = $this->request->getPost();

        $data['id_perfil'] = $this->menu;
        $data['id_user'] = $this->id_user;
        $data['id_module'] = 6;
        $data['date'] = date('Y-m-d H:i:s');
        $data['action'] = 'enviou motoboy:'.$post['id_motoboy'].' para coletar a parcela '.$post['id_installment'];
        $logModel = new LogModel();
        $logModel->save($data);

        $id_motoboy =  $post['id_motoboy'];
        $id_installment =  $post['id_installment'];
        $this->model->setSendMotoboy($id_installment, $id_motoboy);
    }

    public function ajaxStatus(){
        $post = $this->request->getPost();
        $id_installment =  $post['id_installment'];
        $id_status =  4;
        $this->model->setStatus($id_installment, $id_status);
    }

    public function ajaxCalc(){

        $post = $this->request->getPost();
        $total =  $post['total'];
        $fees =  $post['fees'];
        $installments =  $post['installments'];
        
        $fees = (floatval($total) * floatval($fees)) / 100;
        $result['amount_to_be_paid'] = $fees + $total;
        
        $installment = $result['amount_to_be_paid'] / $installments;
        $installment = round($installment);

        $result['amount_to_be_paid'] = number_format($result['amount_to_be_paid'], 2, ',', '.');
        $result['installments_value'] = number_format($installment, 2, ',', '.');

        echo json_encode($result);
    }

    public function ajaxGetCpf(){

        $post = $this->request->getPost();
        $result =$this->model->ajaxGetCpf($post['cpf']);
        echo json_encode($result);
    }  
    
    public function collect(){
        $post = $this->request->getPost();
        $id_installment = $post['id_collect'];
        $id_status = 5;
        $this->model->setStatus($id_installment, $id_status);
        header("Location:".base_url('billing'));
        die();
    }

    public function checkStatus(){
        $post = $this->request->getPost();
        $result = $this->model->checkStatus($post['id']);
        echo json_encode($result);
    }
}
