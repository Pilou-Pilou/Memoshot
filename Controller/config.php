<?php
require_once('../Config/stripe-php-1.11.0/lib/Stripe.php');

$stripe = array(
    "secret_key" => "sk_test_yQbtqtO3hGEvMst87bZ31aaX",
    "publishable_key" => "pk_test_niGtKr5kHPTSes1ceB4WLhEw"
);

Stripe::setApiKey($stripe['secret_key']);
?>
