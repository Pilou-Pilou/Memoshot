<?php
require_once(dirname(__FILE__) . '/config.php');

$token = $_POST['stripeToken'];
$montant = $_POST['montant'];
$montant = $montant * 100;

$customer = Stripe_Customer::create(array(
    'email' => 'customer@example.com',
    'card' => $token
));

$charge = Stripe_Charge::create(array(
    'customer' => $customer->id,
    'amount' => $montant,
    'currency' => 'cad'
));

echo "Vous avez payé" . ($montant / 100) . '$';
?>
