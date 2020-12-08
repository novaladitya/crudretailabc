<?php

namespace App\Models;

use CodeIgniter\Model;

class RetailabcModel extends Model
{
    protected $table = 'obat';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'slug', 'foto', 'stok'];

    public function getObat($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
