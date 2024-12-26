<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckoutModel extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fname', 'lname','address','email','phone','notes','city','total_amt','create_at'];
}

?>