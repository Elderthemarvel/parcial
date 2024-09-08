<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CreateController extends BaseController
{

    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect(); 
    }

    public function index()
    {
        //
    }

    public function savePais(){
        $model = model('PaisesModel');
        $data = $this->request->getPost();
        if($model->insert($data)){
            $response['error']=false;
        }else{
            $response['error']=true;
        }
        return $this->response->setJSON($response);
    }

    public function saveEditorial(){
        $model = model('EditorialModel');
        $data = $this->request->getPost();
        if($model->insert($data)){
            $response['error']=false;
        }else{
            $response['error']=true;
        }
        return $this->response->setJSON($response);
    }

    public function saveAutor(){
        $model = model('AutoresModel');
        $data = $this->request->getPost();
        if($model->insert($data)){
            $response['error']=false;
        }else{
            $response['error']=true;
        }
        return $this->response->setJSON($response);
    }

    public function saveLibro(){
        $model = model('LibrosModel');
        $model2 = model('AutoresLibrosModel');
        $libro = $this->request->getPost('libro');
        $autorLibro = $this->request->getPost('autores_libro');
        $this->db->transStart();
            $model->insert($libro);
            $autorLibro['libro_id'] = $model->insertID();
            $model2->insert($autorLibro);
        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            $response['error']=false;
        }   
        else{
            $response['error']=true;
        }
        return $this->response->setJSON($autorLibro);
    }
}
