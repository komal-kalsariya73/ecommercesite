<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ProductModel;

class MainController extends Controller
{
    public function index()
    {
        $model = new ProductModel();
    $data['products'] = $model->findAll(); 
    return view('product/main', $data); 
    }
    // public function fetchProduct($id)
    // {
    //     $model = new ProductModel();
    //     $product = $model->find($id);

    //     if ($product) {
    //         return $this->response->setJSON([
    //             'success' => true,
    //             'data' => $product
    //         ]);
    //     }

    //     return $this->response->setJSON([
    //         'success' => false,
    //         'message' => 'product not found.'
    //     ]);
    // }

    public function fetchProduct($id)
    {
        $productModel = new ProductModel();

        $product = $productModel->find($id);

        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Product with ID $id not found.");
        }

        $data['product'] = $product;

        return view('product/singleproduct', $data);
    }
    public function Thankyou()
    {
       
    return view('product/thankyou'); 
    }

}
