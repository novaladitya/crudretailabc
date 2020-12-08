<?php

namespace App\Controllers;

use App\Models\RetailabcKeluarModel;
use App\Models\RetailabcMasukModel;

class Pages extends BaseController
{
    protected $obatMasukModel, $obatKeluarModel;
    public function __construct()
    {
        $this->obatMasukModel = new RetailabcMasukModel();
        $this->obatKeluarModel = new RetailabcKeluarModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Home | Retail ABC'
        ];
        return view('pages/home', $data);
    }

    public function laporan()
    {
        $getJumlahObatMasuk = $this->obatMasukModel->query('SELECT SUM(unit) AS sum FROM obatmasuk')->getRow();
        $getJumlahObatKeluar = $this->obatKeluarModel->query('SELECT SUM(unit) AS sum FROM obatkeluar')->getRow();

        $jumlahObatMasuk = json_decode(json_encode($getJumlahObatMasuk), true);
        $jumlahObatKeluar = json_decode(json_encode($getJumlahObatKeluar), true);

        $data = [
            'title' => 'Laporan Transaksi | Retail ABC',
            'datamasuk' => $jumlahObatMasuk,
            'datakeluar' => $jumlahObatKeluar
        ];
        return view('pages/laporan', $data);
    }

    //--------------------------------------------------------------------

}
