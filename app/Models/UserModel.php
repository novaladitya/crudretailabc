<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';

    public function getUser($email)
    {
        return $this->where(['user_email' => $email])->first();
    }
}
