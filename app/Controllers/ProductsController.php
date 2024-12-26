<?php

// app/Controllers/ProductsController.php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ProductModel;

class ProductsController extends Controller
{
    // Fetch all distinct categories
    private function getCategories()
    {
        $model = new ProductModel();
        return $model->distinct()->select('category')->findAll();
    }

    // Main function to display products with filters and pagination
    public function display()
    {
        // Get category, search, and page from the request
        $category = $this->request->getGet('category');
        $search = $this->request->getGet('search'); // Ensure this is fetched from the request
        $page = $this->request->getGet('page') ?? 1;

        // Default pagination settings
        $perPage = 3;
        $offset = ($page - 1) * $perPage;

        // Load product model
        $model = new ProductModel();

        // Fetch products based on category, search, and pagination
        $data['products'] = $model->getProducts($category, $search, $perPage, $offset);

        // Get total product count for pagination
        $data['totalProducts'] = $model->getProductCount($category, $search);

        // Calculate total pages for pagination
        $data['totalPages'] = ceil($data['totalProducts'] / $perPage);

        // Fetch categories for the filter
        $data['categories'] = $this->getCategories();

        // Pass the search and category to the view
        $data['search'] = $search; // Make sure the search term is passed
        $data['category'] = $category;
        $data['page'] = $page;

        return view('product/products', $data);
    }
}


?>