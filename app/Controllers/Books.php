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
            'title' => 'Form Tambah Buku',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation()
        ];
        return view('book/create', $data);
    }
    public function save()
    {
        // validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[books.judul]',
                'errors' => [
                    'required' => '{field} buku harus di isi.',
                    'is_unique' => '{field} buku sudah terdaftar'
                ]
            ],
            'penulis' => [
                'rules' => 'required|is_unique[books.penulis]',
                'errors' => [
                    'required' => '{field} buku harus di isi.',
                    'is_unique' => '{field} buku sudah terdaftar'
                ]
            ],
            'penerbit' => [
                'rules' => 'required|is_unique[books.penerbit]',
                'errors' => [
                    'required' => '{field} buku harus di isi.',
                    'is_unique' => '{field} buku sudah terdaftar'
                ]
            ]

        ])) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/books/create')->withInput();
        }

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
    public function delete($id)
    {
        $this->bukuModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/book');
    }
}
