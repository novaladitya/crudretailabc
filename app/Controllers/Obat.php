<?php

namespace App\Controllers;

use App\Models\RetailabcKeluarModel;
use App\Models\RetailabcMasukModel;
use App\Models\RetailabcModel;

class Obat extends BaseController
{
    protected $obatModel, $obatMasukModel, $obatKeluarModel;
    public function __construct()
    {
        $this->obatModel = new RetailabcModel();
        $this->obatMasukModel = new RetailabcMasukModel();
        $this->obatKeluarModel = new RetailabcKeluarModel();
    }

    public function index()
    {
        //$obat = $this->obatModel->findAll();

        $data = [
            'title' => 'Data Gudang | Retail ABC',
            'obat' => $this->obatModel->getObat(),
            'validation' => \Config\Services::validation()
        ];
        if (session()->get('logged_in')) {
            return view('obat/index', $data);
        } else {
            return redirect()->to('/login');
        }
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Edit Obat | Retail ABC',
            'obat' => $this->obatModel->getObat($slug),
            'validation' => \Config\Services::validation()
        ];
        if (empty($data['obat'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Obat Tidak Ditemukan.');
        }
        if (session()->get('logged_in')) {
            return view('obat/editobat', $data);
        } else {
            return redirect()->to('/login');
        }
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[obat.nama]',
                'errors' => [
                    'required' => 'Nama obat harus diisi.',
                    'is_unique' => 'Nama obat sudah ada.'
                ]
            ],
            'foto' => [
                'rules' => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => "Bukan file gambar.",
                    'mime_in' => "Bukan file gambar."
                ]
            ],
            'stok' => [
                'rules' => 'decimal|greater_than_equal_to[0]',
                'errors' => [
                    'decimal' => "Angka tidak sesuai.",
                    'greater_than_equal_to' => "Angka tidak sesuai."
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/obat')->withInput()->with('validation', $validation);
            return redirect()->to('/obat')->withInput();
        }

        $slug = url_title($this->request->getVar('nama'), '-', true);

        //get gambar foto
        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto->getError() == 4) {
            $namaFoto = 'default.jpg';
        } else {
            //ubah nama foto
            $namaFoto = "$slug.jpg";
            //pindah lokasi gambar foto
            $fileFoto->move('img', $namaFoto);
        }

        $this->obatModel->save([
            'nama' => $this->request->getVar('nama'),
            'slug' => $slug,
            'stok' => $this->request->getVar('stok'),
            'foto' => $namaFoto
        ]);

        $this->obatMasukModel->save([
            'nama' => $this->request->getVar('nama'),
            'slug' => $slug,
            'unit' => $this->request->getVar('stok')
        ]);

        session()->setFlashdata('pesan', 'Data obat berhasil ditambahkan.');

        return redirect()->to('/obat');
    }

    public function delete($id)
    {
        //cari gambar bersarkan id, hapus pada folder img
        $obat = $this->obatModel->find($id);
        if ($obat['foto'] != 'default.jpg') {
            //hapus gambar pada img
            unlink('img/' . $obat['foto']);
        }

        $this->obatModel->delete($id);
        session()->setFlashdata('pesan', 'Data obat berhasil dihapus.');

        return redirect()->to('/obat');
    }

    public function update($id)
    {
        $slug = url_title($this->request->getVar('nama'), '-', true);

        $stokLama = $this->obatModel->find($id);
        $unitLama = $stokLama['stok'];
        $unitBaru = $this->request->getVar('stok');
        if ($unitBaru > $unitLama) {
            $unit = $unitBaru - $unitLama;
            $this->obatMasukModel->save([
                'nama' => $this->request->getVar('nama'),
                'slug' => $slug,
                'unit' => $unit
            ]);
        } elseif ($unitBaru < $unitLama) {
            $unit = $unitLama - $unitBaru;
            $this->obatKeluarModel->save([
                'nama' => $this->request->getVar('nama'),
                'slug' => $slug,
                'unit' => $unit
            ]);
        }

        $this->obatModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'slug' => $slug,
            'stok' => $this->request->getVar('stok'),
            'foto' => $this->request->getVar('foto')
        ]);

        return redirect()->to("/obat/$slug")->with('pesan', 'Data stok obat berhasil diubah.');
    }

    public function trxmasuk()
    {
        $data = [
            'title' => 'Data Transaksi Masuk | Retail ABC',
            'obat' => $this->obatMasukModel->getObatMasuk(),
        ];

        if (session()->get('logged_in')) {
            return view('obat/trxmasuk', $data);
        } else {
            return redirect()->to('/login');
        }
    }

    public function trxkeluar()
    {
        $data = [
            'title' => 'Data Transaksi Keluar | Retail ABC',
            'obat' => $this->obatKeluarModel->getObatKeluar(),
        ];

        if (session()->get('logged_in')) {
            return view('obat/trxkeluar', $data);
        } else {
            return redirect()->to('/login');
        }
    }

    //--------------------------------------------------------------------

}
