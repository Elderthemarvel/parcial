<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DeleteController extends BaseController
{
    public function index()
    {
        //
    }

    public function eliminar_pais($id){
        $model = model('PaisesModel');
        if($model->delete($id)){
            $response['error']=false;
        }else{
            $response['error']=true;
        }
        return $this->response->setJSON($response);
    }

    public function eliminar_editorial($id){
        $model = model('EditorialModel');
        if($model->delete($id)){
            $response['error']=false;
        }else{
            $response['error']=true;
        }
        return $this->response->setJSON($response);
    }

    public function eliminar_autor($id){
        $model = model('AutoresModel');
        if($model->delete($id)){
            $response['error']=false;
        }else{
            $response['error']=true;
        }
        return $this->response->setJSON($response);
    }
}
