<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Stripe extends BaseConfig
{
    public $secretKey = 'sk_test_51QaBCyEKVRYQUNGXpQtdwRzjWiy1LQ5pB8l2GUJBLrX61mKnZuvs6C4oPrgPQBcPp2dTK5Xiwy6wDn0XM7ehnbyV00qE6evKUE';  // Replace with your actual secret key from Stripe
    public $publishableKey = 'pk_test_51QaBCyEKVRYQUNGXy2ap9V6kSPmU4eW38xUuICUguFLV6XHWXJu69FfzmQp33D8kfO4rQGI7yakxIXU4UYFISM1X00z0AWoq7M'; // Replace with your actual publishable key
}
