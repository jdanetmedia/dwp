<?php
require_once("../includes/sessionstart.php");
require_once('../model/cartDAO.php');
require_once('../vendor/autoload.php');

// save order to db

// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey("sk_test_YZzzQg82HA6EdEV0aEDmlWzS");

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];

$charge = \Stripe\Charge::create([
    'amount' => $_SESSION["total"] * 100,
    'currency' => 'usd',
    'description' => 'Example charge',
    'source' => $token,
    'receipt_email' => $_SESSION["CustomerEmail"],
]);
var_dump($charge->id);
?>
