<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Selamat Datang | Website Anda',
            'tes' => ['satu', 'dua', 'tiga']
        ];

        return view('pages/home', $data);
    }
    public function about()
    {
        $data = [
            'title' => 'Selamat Datang | Website Anda',
            'tes' => ['satu', 'dua', 'tiga']
        ];

        return view('pages/about', $data);
    }
    public function contact()
    {
        $data = [
            'title' => 'Contact | Unipdu Press',
            'alamat' => [
                ['tipe' => 'Rumah', 'alamat' => 'Janti Jogoroto', 'kota' => 'Jombang'],
                ['tipe' => 'kantor', 'alamat' => 'Kompleks Ponpes Darul Ulum Peterongan', 'kota' => 'Jombang']
            ]
        ];
        return view('pages/contact', $data);
    }
}
