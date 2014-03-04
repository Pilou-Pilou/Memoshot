<?php
require_once('./lib/Stripe.php');

$stripe = array(
    "secret_key" => "sk_test_duO6HIgVwGQBGfNEfh42Biof",
    "publishable_key" => "pk_test_XuVR09jtc5w7irJxUCftxhcO"
);

Stripe::setApiKey($stripe['secret_key']);
?>
