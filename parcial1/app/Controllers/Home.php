<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('layout');
    }

    public function paises(): string
    {
        $model = model('PaisesModel');
        $data['paises'] = $model->findAll();
        return view('paises',$data);
    }

    public function editoriales(): string
    {
        $model = model('EditorialModel');
        $data['editoriales'] = $model->findAll();
        return view('editoriales',$data);
    }

    public function autores(): string
    {
        $model = model('AutoresModel');
        $paises = model('PaisesModel');
        $data['autores'] = $model->info_autores();
        $data['paises'] = $paises->findAll();
        return view('autores',$data);
    }

    public function libros(): string
    {
        $model = model('LibrosModel');
        $editorial = model('EditorialModel');
        $autor = model('AutoresModel');
        $data['autores'] = $autor->findAll();
        $data['editoriales'] = $editorial->findAll();
        $data['libros'] = $model->info_libros();
        return view('libros',$data);
    }
}
