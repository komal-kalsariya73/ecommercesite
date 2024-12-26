<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/admin', 'MainController::index');

$routes->get('/', 'MainController::index');
$routes->get('/product/main', 'MainController::index');
$routes->get('product/products', 'ProductsController::display');
$routes->get('/product/fetchProduct/(:num)', 'MainController::fetchProduct/$1');  
$routes->post('product/addtocart', 'CartController::addToCart');
$routes->get('/product/thankyou', 'MainController::Thankyou');
 
$routes->get('product/cart', 'CartController::displayCart');  
$routes->post('cart/deleteItem/(:num)', 'CartController::deleteItem/$1');

$routes->get('/product/checkout', 'CheckoutController::index');
$routes->get('cart/getCartItems', 'CartController::getCartItems');
$routes->get('/cart/getCartCount', 'CartController::getCartCount');
// $routes->post('cart/placeOrder', 'CartController::placeOrder');
$routes->post('cart/placeOrder', 'CartController::placeOrder');


$routes->get('/login', 'LoginController::create');
$routes->post('/login', 'LoginController::login');
$routes->get('/logout', 'LoginController::logout');

$routes->post('paypal/create-payment', 'PayPalController::createPayment');
$routes->get('paypal/execute-payment', 'PayPalController::executePayment');