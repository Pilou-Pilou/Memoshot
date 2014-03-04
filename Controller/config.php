<?php
require_once('./lib/Stripe.php');

$stripe = array(
    "secret_key" => "sk_test_zLVZghtNxTb5iVRNW2rPaeJc",
    "publishable_key" => "pk_test_gD8GKXiOxuegDa9HzVxQQ2wm"
);

Stripe::setApiKey($stripe['secret_key']);
?>
