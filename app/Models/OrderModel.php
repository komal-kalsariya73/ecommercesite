<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fname', 'lname', 'address', 'phone', 'email', 'city', 'notes', 'total_amt','create_at'];

    public function getLatestOrder()
    {
        return $this->orderBy('id', 'DESC')->first();
    }
}
