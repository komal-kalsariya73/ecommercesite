<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CartModel;
use App\Models\ProductModel;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('product/checkout'); 
    }

}