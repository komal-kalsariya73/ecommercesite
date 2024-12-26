<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemsModel extends Model
{
    protected $table = 'order_item';
    protected $primaryKey = 'id';
    protected $allowedFields = ['order_id', 'product_id', 'product_name', 'price', 'quantity', 'total_price'];
}
