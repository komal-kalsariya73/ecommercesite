<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['order_id', 'transaction_id', 'payment_status', 'payment_method', 'created_at', 'updated_at'];

    public function insertTransaction($data)
    {
        return $this->insert($data);
    }

    // Update payment status and transaction ID
    public function updateStatus($paymentId, $data)
    {
        return $this->where('transaction_id', $paymentId) 
                    ->set($data)
                    ->update();
    }

    public function updateStripe($transactionId, $data)
    {
        $result = $this->where('transaction_id', $transactionId)
                       ->set($data)
                       ->update();

        if (!$result) {
            log_message('error', 'Failed to update transaction with ID: ' . $transactionId);
        } else {
            log_message('info', 'Transaction successfully updated with ID: ' . $transactionId);
        }

        return $result;
    }
    
}
