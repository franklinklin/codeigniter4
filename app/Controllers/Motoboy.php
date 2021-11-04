<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MotoboyModel;

class Motoboy extends BaseController
{
    private $motoboyModel;
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
        
        $this->motoboyModel = new motoboyModel();   
        $this->controller = 'motoboy';
        $this->form = 'motoboy_form';
        $this->message = 'Motoboy';
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
			$paginateData = $this->motoboyModel->paginate(10);
		} else {
			$paginateData = $this->motoboyModel->select('*')
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
				->paginate(10);
		}

        return view($this->controller,
                        [   'form' => $this->controller,
                            'search' => $this->controller,
                            'clients' => $paginateData,
                            'pager' => $this->motoboyModel->pager
                        ]
                   );
    }

    public function delete($id){

        if($this->motoboyModel->delete($id)){

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
      
        if($this->motoboyModel->save($this->request->getPost())){
            return view("messages",[
                'message' => $this->message.' salvo com sucesso',
                'back'=> $this->controller
            ]);
        } else {
            echo "Ocorreu um erro";
        }
    }

    public function edit($id){
        
        return view($this->form,
            [
                'user'=> $this->motoboyModel->find($id),
                'save'=>$this->controller,
                'search'=>$this->controller
            ]
        );  
    }
}
