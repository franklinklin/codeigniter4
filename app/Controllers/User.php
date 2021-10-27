<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
$request = \Config\Services::request();

class User extends BaseController
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

        $this->model = new userModel();   
        $this->controller = 'user';
        $this->form = 'user_form';
        $this->message = 'Usuário';
    }
    public function test(){
        $teste = $this->session->get('email');
        echo"<pre>";print_r($teste);
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
			$paginateData = $this->model->paginate(10);
		} else {
			$paginateData = $this->model->select('*')
				->orLike('name', $search)				
                ->orLike('email', $search)
				->paginate(10);
		}

        return view($this->controller,
                        [   'form' => $this->controller,
                            'search' => $this->controller,
                            'users' => $paginateData,
                            'pager' => $this->model->pager
                        ]
                   );
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
      
        if($this->model->save($this->request->getPost())){
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
                'user'=> $this->model->find($id),
                'save'=>$this->controller,
                'search'=>$this->controller
            ]
        );  
    }

    function check(){

        //$email = $this->request->getGetPost('email');        
        //$password = $this->request->getGetPost('password');        
        $email = 'franklinklin@gmail.com';
        $password = '12345678';
        $result = $this->model->checkLogin($email, $password);        

        if($result){
            echo json_encode(true);
        }else{            
            echo json_encode(false);
        }
        die();
    }

    function logout(){
        
        $newdata = [
            'username'  => '',
            'email'     => '',
            'logged_in' => FALSE
        ];
        $this->session->set($newdata);
        die('bye');
    }
}
