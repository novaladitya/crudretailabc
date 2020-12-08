<?php

namespace App\Models;

use CodeIgniter\Model;

class RetailabcKeluarModel extends Model
{
    protected $table = 'obatkeluar';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'slug', 'unit'];

    public function getObatKeluar()
    {
        return $this->findAll();
    }
}
