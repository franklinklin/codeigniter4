<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\MotoboyModel;

class Client extends BaseController
{
    private $clientModel;
    private $form;
    private $controller;
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
        
        $this->clientModel = new clientModel();  
        $this->controller = 'client';
        $this->form = 'client_form';
        $this->message = 'Cliente';
        $this->motoboyModel = new motoboyModel(); 
    }
    
    public function index()
    {   
        $request = service('request');
		$searchData = $request->getPost();

		$search = "";
		if (isset($searchData) && isset($searchData['search'])) {
			$search = $searchData['search'];
		}

        if ($search == '') {
			$paginateData = $this->clientModel->paginate(1000);
		} else {
			$paginateData = $this->clientModel->select('*')
				->orLike('name', $search)
				->orLike('document', $search)
                ->orLike('birth_date', $search)
                ->orLike('email', $search)
                ->orLike('number', $search)
                ->orLike('zipcode', $search)
                ->orLike('state', $search)
                ->orLike('city', $search)
                ->orLike('district', $search)
                ->orLike('phone', $search)
				->paginate(1000);
		}
        
        return view('client',
                        [   'form' => 'client',
                            'search' => 'client',
                            'clients' => $paginateData,
                            'pager' => $this->clientModel->pager,
                            'motoboys' => $this->motoboyModel->getMotoboys()
                        ]
                   );
    }

    public function delete($id){

        if($this->clientModel->delete($id)){

           echo view('messages',[
               'message' => 'Cliente excluído com sucesso',
               'back'=>'client'
           ]);
        }else{

            echo"Erro.";
        }
    }

    public function create(){

        return view('client_form',[
            'search' => 'client',
            'save' => 'client',
            'motoboys' => $this->motoboyModel->getMotoboys()
        ]);
}

    public function save(){
      
        $post = $this->request->getPost();        
        $client = $post;

        if(isset($post['name']) && $post['name'] ==''){
            $required[] = 'Nome';
        }

        if(isset($post['document']) && $post['document'] ==''){
            $required[] = 'CPF';
        }

        if(isset($post['email']) && $post['email'] ==''){
            $required[] = 'E-mail';
        }        

        if(isset($post['phone']) && $post['phone'] ==''){
            $required[] = 'Contato';
        }

        if(isset($post['zip_code']) && $post['zip_code'] ==''){
            $required[] = 'CEP';
        }

        if(isset($post['number']) && $post['number'] ==''){
            $required[] = 'Numero';
        }        

        if(isset($required)){
            
            return view($this->form,[
                'required' => $required,
                'search' => $this->controller,
                'save' => $this->controller,
                'user' => $client
            ]);
        }else{

            if($this->clientModel->save($this->request->getPost())){
                return view("messages",[
                    'message' => 'Cliente salvo com sucesso',
                    'back'=>'client'
                ]);
            } else {
                echo "Ocorreu um erro";
            }
        }
    }

    public function edit($id){
        return view('client_form',
            [
                'user'=> $this->clientModel->find($id),
                'save'=>'client',
                'search'=>'client',
                'motoboys' => $this->motoboyModel->getMotoboys()
            ]
        );  
    }
}
