<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use App\Models\UserModel;
use App\Models\LogModel;

class Login extends BaseController
{
    protected $session;
    private $loginModel;

    public function __construct()
    {        
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->loginModel = new LoginModel();
        helper('url');
    }

    public function checklogin(){
        $newdata = [
            'username'  => 'johndoe',
            'email'     => 'johndoe@some-site.com',
            'logged_in' => TRUE
        ];
        /*$this->session->set($newdata); // setting session data
        echo $this->session->get("username");
        $teste = $this->session->get();
        echo"<pre>";print_r($teste);*/

        $tt = $this->loginModel->myquery();
        echo "<pre>";print_r($tt);
        
    }

    public function index555()
    {   
        $request = service('request');
		$searchData = $request->getPost();

		$search = "";
		if (isset($searchData) && isset($searchData['search'])) {
			$search = $searchData['search'];
		}

        if ($search == '') {
			$paginateData = $this->loginModel->paginate(1000);
		} else {
			$paginateData = $this->loginModel->select('*')
				->orLike('email', $search)
				->orLike('password', $search)    			
				->paginate(1000);
		}

        return view('login',
                        [   'search' => 'login',
                            'logins' => $paginateData,
                            'pager' => $this->loginModel->pager
                        ]
                   );
    }

    public function delete($id){

        if($this->loginModel->delete($id)){

           echo view('messages',[
               'message' => 'Usuário excluído com sucesso'
           ]);
        }else{

            echo"Erro.";
        }
    }

    public function create(){
        return view('form');
    }

    public function save(){
        
        if($this->loginModel->save($this->request->getPost())){
            return view("messages",[
                'message' => 'Usuário salvo com sucesso',
                'back'=>'Login'
            ]);
        } else {
            echo "Ocorreu um erro";
        }
    }

    public function edit($id){
        return view('form',['user'=> $this->loginModel->find($id)]);  
    }

    function index(){
        return view('login');
    }

    function check(){

        $post = $this->request->getPost();
        
        if(!isset($post['cpf']) || $post['cpf']=='' || !isset($post['password']) || $post['password']==''){
            echo json_encode(false);
            die();
        }
        $userModel = new UserModel();
        $result = $userModel->checkLogin($post['cpf'], $post['password']);  
            
        if($result){
            //use App\Models\LogModel;
            //$data['id_perfil'] = $result->id_perfil;
            $data['id_perfil'] = 3;
            $data['id_user'] = $result->id;
            $data['id_module'] = 1;
            $data['date'] = date('Y-m-d H:i:s');
            $data['action'] = 'Efetuou o login no sistema';

            $logModel = new LogModel();
            $logModel->save($data);

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
        header("Location:".base_url());
        die();
    }
}
