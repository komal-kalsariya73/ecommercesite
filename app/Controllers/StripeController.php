<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\TransactionModel;
use App\Models\OrderModel;

class StripeController extends Controller
{
    public function createSession()
    {
        $orderModel = new OrderModel();
        $latestOrder = $orderModel->getLatestOrder();

        if (!$latestOrder) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Order not found']);
        }

        $order_id = $latestOrder['id'];
        $totalAmount = $latestOrder['total_amt'];

        $config = new \Config\Stripe();
        Stripe::setApiKey($config->secretKey);

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => ['name' => 'Order Payment'],
                        'unit_amount' => $totalAmount * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => base_url('stripe/thankyou'). '?session_id={CHECKOUT_SESSION_ID}&order_id=' . $order_id,
                'cancel_url' => base_url('stripe/cancle'),
            ]);

            $transactionModel = new TransactionModel();
            $transactionModel->insert([
                'order_id' => $order_id,
                'transaction_id' => $session->id, // Storing the Stripe session ID
                'payment_status' => 'pending',
                'payment_method' => 'stripe',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            

            return $this->response->setJSON(['status' => 'success', 'sessionId' => $session->id, 'orderId' => $order_id]);
        } catch (\Exception $e) {
            log_message('error', 'Stripe error: ' . $e->getMessage());
            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function thankyou()
    {
        $sessionId = $this->request->getGet('session_id');
        $orderId = $this->request->getGet('order_id');

        if (!$sessionId || !$orderId) {
            return view('stripe/cancle', ['message' => 'Invalid session or order ID']);
        }

        $config = new \Config\Stripe();
        Stripe::setApiKey($config->secretKey);
        $session = Session::retrieve($sessionId);
        try {
           
            $paymentIntentId = $session->payment_intent; 
            if ($session->payment_status === 'paid') {
                $transactionModel = new TransactionModel();
                $transaction = $transactionModel->where('transaction_id', $sessionId)->first();
            
                if ($transaction) {
                    $transactionModel->update($transaction['id'], [
                        'payment_status' => 'completed',
                        'transaction_id' => $paymentIntentId,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                } else {
                    log_message('error', 'Transaction not found for session ID: ' . $sessionId);
                    return view('stripe/cancle', ['message' => 'Transaction not found']);
                }
            }
             else {
                return view('stripe/cancle', ['message' => 'Payment not completed']);
            }
        } catch (\Exception $e) {
            log_message('error', 'Stripe error: ' . $e->getMessage());
            return view('stripe/cancle', ['message' => 'An error occurred while verifying payment']);
        }

        return view('stripe/success', ['session_id' => $sessionId, 'order_id' => $orderId]);
    }

    public function cancle()
    {
        return view('stripe/cancle', ['message' => 'Your payment was canceled.']);
    }
}
?>
