<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'product_id', 'product_name', 'price', 'image', 'qty', 'total_price', 'created_at'];

    // Optionally add custom methods if needed
    public function getCartByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }
}
