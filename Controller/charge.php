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
$req1 = "INSERT INTO 'Abonnement' VALUES" . $POST['abonnement'];
$req2 = "UPDATE users.abonnement= " . mysql_insert_id() . "WHERE id=" . $_SESSION['id'];
$result1 = mysql_query($req1);
if (!$result1) {
    echo "ça marche pas INSERT" . mysql_error();
} else
    echo "ça marche ";
$result2 = mysql_query($req2);
if (!$result2) {
    echo "ça marche pas UPDATE" . mysql_error();
} else
    echo "ça marche ";

?>
