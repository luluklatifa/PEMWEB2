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
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|ext_in[sampul,jpg,jpeg,png]',
                'error' => [
                    // 'uploaded'  => 'Pilih gambar ynag sesuai.',
                    'max_size' => 'Ukuran file terlalu besar',
                    'is_image'  => 'Yang anda pilih bukan gambar.',
                    'ext_in'   => 'Sampul buku harus berekstensi png,jpg,jpeg.'
                ]
            ]

        ])) {
            // session()->setFlashdata('validation', \Config\Services::validation());
            // return redirect()->to('/books/create')->withInput();
            return redirect()->to('/books/create')->withInput()->with('errors', $this->validator->getErrors());
        }

        $gambarSampul = $this->request->getFile('sampul');
        // $namaSampul = $gambarSampul->getRandomName();
        // $gambarSampul->move('img');
        // $namaSampul = $gambarSampul->getName();

        if ($gambarSampul->getError() == 4) {
            $namaSampul = 'no-cover.jpg';
        } else {
            $namaSampul = $gambarSampul->getRandomName();
            $gambarSampul->move('img', $namaSampul);
        }



        // url_title digunakan untuk membuat field slug pada database terisi otomatis
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bukuModel->save([
            'judul'     => $this->request->getVar('judul'),
            'slug'      => $slug,
            'penulis'   => $this->request->getVar('penulis'),
            'penerbit'  => $this->request->getVar('penerbit'),
            'sampul'     => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/book');
    }
    public function delete($id)
    {
        $buku = $this->bukuModel->find($id);
        if ($buku['sampul'] != 'no-cover.jpg') {
            unlink('img/' . $buku['sampul']);
        }

        $this->bukuModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/book');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data Buku',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'buku' => $this->bukuModel->getBuku($slug)
        ];

        return view('book/edit', $data);
    }

    public function update($id)
    {
        // validasi update 
        // cek judul
        $bukuLama = $this->bukuModel->getBuku($this->request->getVar('slug'));
        // jika judul lama sama dengan judul yang akan di inputkan maka jalankan rules nya
        if ($bukuLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[books.judul]';
        }

        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
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
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|ext_in[sampul,jpg,jpeg,png]',
                'error' => [
                    // 'uploaded'  => 'Pilih gambar ynag sesuai.',
                    'max_size' => 'Ukuran file terlalu besar',
                    'is_image'  => 'Yang anda pilih bukan gambar.',
                    'ext_in'   => 'Sampul buku harus berekstensi png,jpg,jpeg.'
                ]
            ]


        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to('/book/edit/' . $this->request->getVar('slug'))->withInput()->with('errors', $this->validator->getErrors());
            // return redirect()->to('/books/edit')->withInput()->with('errors', $this->validator->getErrors());
        }

        $gambarSampul = $this->request->getFile('sampul');
        if ($gambarSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            $namaSampul = $gambarSampul->getRandomName();
            $gambarSampul->move('img', $namaSampul);
            unlink('img/' . $this->request->getVar('sampulLama'));
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bukuModel->save([
            'id'        => $id,
            'judul'     => $this->request->getVar('judul'),
            'slug'      => $slug,
            'penulis'   => $this->request->getVar('penulis'),
            'penerbit'  => $this->request->getVar('penerbit'),
            'sampul'     => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/book');
    }
}
