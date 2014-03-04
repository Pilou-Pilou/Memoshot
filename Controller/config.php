<?php
require_once('../Config/stripe-php-1.11.0/lib/Stripe.php');

$stripe = array(
    "secret_key" => "sk_test_m5TG7C5SPeUQ94lCLqth343U",
    "publishable_key" => "pk_test_gD8GKXiOxuegDa9HzVxQQ2wm"
);

Stripe::setApiKey($stripe['secret_key']);
?>
