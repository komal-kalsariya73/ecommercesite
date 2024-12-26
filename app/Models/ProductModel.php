<?php

namespace App\Models;

use CodeIgniter\Model;

// app/Models/ProductModel.php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_name', 'description', 'price', 'category', 'qty', 'image', 'created_at','updated_at'];

    public function getProducts($category = null, $search = null, $perPage = 3, $offset = 0)
    {
        $builder = $this->builder();

        // Filter by category
        if ($category) {
            $builder->where('category', $category);
        }

        // Filter by search term
        if ($search) {
            $builder->like('product_name', $search);
        }

        // Pagination
        $builder->limit($perPage, $offset);

        return $builder->get()->getResultArray();
    }

    // Function to get the count of products based on category and search
    public function getProductCount($category = null, $search = null)
    {
        $builder = $this->builder();

        // Filter by category
        if ($category) {
            $builder->where('category', $category);
        }

        // Filter by search term
        if ($search) {
            $builder->like('product_name', $search);
        }

        return $builder->countAllResults();
    }
}

?>