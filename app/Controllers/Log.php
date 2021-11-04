<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LogModel;

class Log extends BaseController
{
    private $model;
    private $controller;

    public function __construct()
    {
        $this->session = \Config\Services::session();        
        $this->session->start();

        $session = $this->session->get();        
        if(!isset($session['logged_in']) || $session['logged_in'] == false){
            header("Location:".base_url());
            die();
        }
        
        $this->model = new logModel();   
        $this->controller = 'log';
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
            
            $paginateData = $this->model->select('log.*')
                ->select('perfil.name as perfil')
                ->select('user.name as user')
                ->select('module.name as module')
                ->join('user','user.id = log.id_user')			
                ->join('perfil','perfil.id = log.id_perfil')
                ->join('module','module.id = log.id_module')
                ->orderBy('log.id', 'DESC')
				->paginate(10);
		} else {
			$paginateData = $this->model->select('log.*')
                ->select('perfil.name as perfil')
                ->select('user.name as user')
                ->select('module.name as module')
				->orLike('user.name', $search)
                ->orLike('perfil.name', $search)
                ->orLike('log.date', $search)
                ->orLike('module.name', $search)
                ->orLike('log.action', $search)
                ->join('user','user.id = log.id_user')
                ->join('perfil','perfil.id = log.id_perfil')
                ->join('module','module.id = log.id_module')
                ->orderBy('log.id', 'DESC')
				->paginate(10);
		}

        return view($this->controller,
                        [   'form' => $this->controller,
                            'search' => $this->controller,
                            'logs' => $paginateData,
                            'pager' => $this->model->pager
                        ]
                   );
    }

    public function save(){      
        $this->motoboyModel->save($this->request->getPost());
    }
}
