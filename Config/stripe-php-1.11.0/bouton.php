<?php require_once('./config.php'); ?>

<form action="charge.php" method="post">
    <input name="montant" id="montant"/>
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="<?php echo $stripe['publishable_key']; ?>"
            data-description="One year's subscription"></script>
</form>