<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;

class Client extends BaseController
{
    private $clientModel;

    public function __construct()
    {
        $this->clientModel = new clientModel();   
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
			$paginateData = $this->clientModel->paginate(10);
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
				->paginate(10);
		}

        return view('client',
                        [   'form' => 'client',
                            'search' => 'client',
                            'clients' => $paginateData,
                            'pager' => $this->clientModel->pager
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
                                    'save' => 'client'
                                ]);
    }

    public function save(){
      
        if($this->clientModel->save($this->request->getPost())){
            return view("messages",[
                'message' => 'Cliente salvo com sucesso',
                'back'=>'client'
            ]);
        } else {
            echo "Ocorreu um erro";
        }
    }

    public function edit($id){
        return view('client_form',
            [
                'user'=> $this->clientModel->find($id),
                'save'=>'client',
                'search'=>'client'
            ]
        );  
    }
}
