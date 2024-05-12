<?php

namespace App\Controllers;

use App\Models\BooksModel;

class Books extends BaseController
{

    protected $bukuModel;
    public function __construct()
    {
        $this->bukuModel = new BooksModel();
    }

    public function index()
    {
        //$buku = $this->bukuModel->findAll();
        $data = [
            'title' => 'Daftar Buku',
            'buku' => $this->bukuModel->getBuku()
        ];

        return view('book/index', $data);
    }
    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Buku',
            'buku' => $this->bukuModel->getBuku($slug)
        ];

        if (empty($data['buku'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Buku' . $slug . 'Tidak ditemukan');
        }

        return view('book/detail', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Buku'
        ];
        return view('book/create', $data);
    }
    public function save()
    {
        // url_title digunakan untuk membuat field slug pada database terisi otomatis
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bukuModel->save([
            'judul'     => $this->request->getVar('judul'),
            'slug'      => $slug,
            'penulis'   => $this->request->getVar('penulis'),
            'penerbit'  => $this->request->getVar('penerbit'),
            'cover'     => $this->request->getVar('cover')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/book');
    }
}
