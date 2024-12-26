<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CartModel;
use App\Models\ProductModel;
use App\Models\OrderItemsModel;
use App\Models\OrderModel;

class CartController extends Controller
{
    public function index()
    {
        return view('product/cart'); 
    }

    public function addToCart()
{
    if ($this->request->isAJAX()) {
        $session = session();
        $productId = $this->request->getPost('product_id');
        $qty = $this->request->getPost('qty');
        $userId = $session->get('user_id') ?? 1; 

        $productModel = new ProductModel();
        $cartModel = new CartModel();

        $product = $productModel->find($productId);

        if ($product) {
            $existingCartItem = $cartModel->where([
                'user_id' => $userId,
                'product_id' => $productId
            ])->first();

            if ($existingCartItem) {
                $newQuantity = $existingCartItem['qty'] + $qty;
                $newTotalPrice = $newQuantity * $product['price'];

                $cartModel->update($existingCartItem['id'], [
                    'qty' => $newQuantity,
                    'total_price' => $newTotalPrice,
                ]);
            } else {
                $cartModel->insert([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'product_name' => $product['product_name'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'qty' => $qty,
                    'total_price' => $product['price'] * $qty,
                ]);
            }

            // Get the updated cart count
            $cartItems = $cartModel->where('user_id', $userId)->findAll();
            $cartCount = is_array($cartItems) ? count($cartItems) : 0;

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Product added to cart successfully!',
                'cartCount' => $cartCount,  // Return the updated cart count
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Product not found.',
            ]);
        }
    }

    return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Invalid request.',
    ]);
}

    public function displayCart()
    {
        $session = session();
        $cartModel = new CartModel();
        $userId = $session->get('user_id') ?? 1;

        $cart = $cartModel->where('user_id', $userId)->findAll();
        $subtotal = array_sum(array_column($cart, 'total_price'));

        return view('/product/cart', ['cart' => $cart, 'subtotal' => $subtotal]);
    }

    public function deleteItem($id)
    {
        $cartModel = new CartModel();

        if ($cartModel->delete($id)) {
            $session = session();
            $userId = $session->get('user_id') ?? 1;

            $cartItems = $cartModel->where('user_id', $userId)->findAll();
            $newSubtotal = array_sum(array_column($cartItems, 'total_price'));

            return $this->response->setJSON([
                'success' => true,
                'newSubtotal' => $newSubtotal,
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to remove item.',
        ]);
    }

    public function checkout()
    {
        return view('product/checkout');
    }

    
    public function getCartItems()
    {
        $session = session();
        $cartModel = new CartModel();
        $userId = $session->get('user_id') ?? 1; // Replace 1 with dynamic user_id

        $cartItems = $cartModel->where('user_id', $userId)->findAll();

        if (!$cartItems) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No items in the cart.',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $cartItems,
        ]);
    }

    public function placeOrder()
    {
        $session = session();
        $cartModel = new CartModel();
        $orderModel = new OrderModel();
        $orderItemsModel = new OrderItemsModel();

        $validation = $this->validate([
            'fname' => 'required',
            'lname' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|valid_email',
            'city' => 'required',
            'total_amt' => 'required|numeric|greater_than[0]',
        ]);

        if (!$validation) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors(),
            ]);
        }

        $data = $this->request->getPost();
        $userId = $session->get('user_id') ?? 1;

        $data['user_id'] = $userId;

        $orderId = $orderModel->insert($data);

        if ($orderId) {
            $cartItems = $cartModel->where('user_id', $userId)->findAll();

            foreach ($cartItems as $item) {
                $orderItemsModel->insert([
                    'order_id' => $orderId,
                    'product_id' => $item['product_id'],
                    'product_name' => $item['product_name'],
                    'price' => $item['price'],
                    'quantity' => $item['qty'],
                    'total_price' => $item['total_price'],
                ]);
            }

            $cartModel->where('user_id', $userId)->delete(); 
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Order placed successfully!',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to place order.',
        ]);
    }

    public function getCartCount()
    {
        $session = session();
        $cartModel = new CartModel();
        $userId = $session->get('user_id') ?? 1; 
    
        // Get cart items for the user
        $cartItems = $cartModel->where('user_id', $userId)->findAll();
    
        // Check if $cartItems is an array before calling count()
        $cartCount = is_array($cartItems) ? count($cartItems) : 0;
    
        return $this->response->setJSON([
            'cartCount' => $cartCount,  // Return the cart count
        ]);
    }
    
}
