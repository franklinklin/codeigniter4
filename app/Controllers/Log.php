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
        $total_motoboy = '';
		$search = "";
		if (isset($searchData) && isset($searchData['search'])) {
			$search = $searchData['search'];
		}
        if(!isset($searchData['user_search'])){
            $searchData['user_search'] ='';
        }
        if(!isset($searchData['date_search'])){
            $searchData['date_search'] ='';
        }
        if(!isset($searchData['date_search_end'])){
            $searchData['date_search_end'] ='';
        }
        if ($search == '' && $searchData['user_search'] == '' && $searchData['date_search'] == '' && $searchData['date_search_end'] == '') {
            
            $paginateData = $this->model->select('log.*')
                ->select('perfil.name as perfil')
                ->select('user.name as user')
                ->select('module.name as module')
                ->join('user','user.id = log.id_user')			
                ->join('perfil','perfil.id = user.id_perfil')
                ->join('module','module.id = log.id_module')
                ->orderBy('log.id', 'DESC')
				->paginate(1000);
		} else {
			/*$paginateData = $this->model->select('log.*')
                ->select('perfil.name as perfil')
                ->select('user.name as user')
                ->select('module.name as module')
				->orLike('user.name', $search)
                ->orLike('perfil.name', $search)
                ->orLike('log.date', $search)
                ->orLike('module.name', $search)
                ->orLike('log.action', $search)
                ->join('user','user.id = log.id_user')
                ->join('perfil','perfil.id = user.id_perfil')
                ->join('module','module.id = log.id_module')                
                ->orderBy('log.id', 'DESC')
				->paginate(1000);*/
            $paginateData = $this->model->search_where($searchData);

            if($searchData['user_search']){
                $total_motoboy = $this->model->get_total_motoboy($searchData);
            }
        }

        $moto_launching = $this->model->getMotoboysWithLaunch();
                
        return view($this->controller,
                    [   
                        'form' => $this->controller,
                        'search' => $this->controller,
                        'logs' => $paginateData,
                        'pager' => $this->model->pager,
                        'search_log' => true,
                        'user' => $this->model->getUser(),
                        'moto_launching' => $moto_launching,
                        'search_data' => $searchData,
                        'total_motoboy' => $total_motoboy
                    ]
                );
    }

    /*public function log($data){      
        $this->model->save($data);
    }*/ 
}
