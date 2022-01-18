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
			$paginateData = $this->model->paginate(1000);
		} else {
			$paginateData = $this->model->select('*')
				->orLike('name', $search)				
                ->orLike('email', $search)
				->paginate(1000);
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

        $post = $this->request->getPost();
        $user = $post;
        
        if(isset($post['id']) && $post['id'] ==''){
            $check = $this->model->checkDuplicate($post['cpf'],$post['id_perfil']);
            if($check){
                $required[] = 'Já existe um cadastro com este perfil e CPF';    
            }
        }
        /*if(isset($post['name']) && $post['name'] ==''){
            $required[] = 'Nome do usuário';
        }*/

        /*if(isset($post['email']) && $post['email'] ==''){
            $required[] = 'E-mail';
        }*/

        if(isset($post['id_perfil']) && $post['id_perfil'] ==''){
            $required[] = 'Perfil';
        }

        if(isset($post['cpf']) && $post['cpf'] ==''){
            $required[] = 'CPF';
        }else{
            if($post['id_perfil']!=1){                
                $checkCpf = $this->model->checkCpf($post['cpf'],$post['id_perfil']);
                if($checkCpf == false){
                    $required[] = 'este CPF não esta cadastrado';
                }else{
                    $dataUser = $checkCpf;
                }
            }
        }

        if(isset($post['password']) && $post['password'] ==''){
            $required[] = 'Senha';
        }else{
            
            if(strlen($post['password']) < 6){
                $required[] = 'a senha deve ter no mínimo 6 dígitos';
            }
        }

        if(isset($post['confirm_password']) && $post['confirm_password'] ==''){
            $required[] = 'Confirmar senha';
        }

        if(isset($post['confirm_password']) && isset($post['password']) && $post['password'] != $post['confirm_password']){
            $required[] = 'Senha não confere';
        }

        if(isset($required)){
            
            return view($this->form,[
                'required' => $required,
                'search' => $this->controller,
                'save' => $this->controller,
                'user' => $user
            ]);
        }else{

            if(isset($post['id']) && $post['id']){

                if($this->model->edit($this->request->getPost())){
                    return view($this->form,[
                        'save' => $this->controller,
                        'search' => $this->controller,
                        'user' => $user,
                        'success_edit'=> true
                    ]);
                } else {
                    echo "Ocorreu um erro";
                }
            }else{

                $post =  $this->request->getPost();    
                
                if($this->model->save_user($post)){
                    
                    $lastId = $this->model->getCpf($post['cpf']);
                    
                    return view($this->form,[
                        'save' => $this->controller,
                        'search' => $this->controller,
                        'user' => $this->model->find($lastId),
                        'success'=> true
                    ]);
                } else {
                    echo "Ocorreu um erro";
                }
            }
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

    function ajaxLoadCpf(){
        
        $post = $this->request->getPost();
        $checkCpf = $this->model->checkCpf($post['cpf'],$post['id_perfil']);
        if($checkCpf == false){
            $result = false;
        }else{
            $result = $checkCpf;
        }
        echo json_encode($result);
    }
}
