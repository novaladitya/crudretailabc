<?php

namespace App\Models;

use CodeIgniter\Model;

class RetailabcMasukModel extends Model
{
    protected $table = 'obatmasuk';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'slug', 'unit'];

    public function getObatMasuk()
    {
        return $this->findAll();
    }
}
