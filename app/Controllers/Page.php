<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Selamat Datang | Website Anda'
        ];
        echo view('layout/header', $data);
        echo view('pages/home', $data);
        echo view('layout/footer', $data);
    }
    public function about()
    {
        $data = [
            'title' => 'Selamat Datang | Website Anda'
        ];
        echo view('layout/header', $data);
        echo view('pages/about', $data);
        echo view('layout/footer', $data);
    }
    
}
$data = [
    'title' => 'Home | Unipdu Press',
    'tes' => ['satu', 'dua', 'tiga']
];
