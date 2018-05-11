<?php
require_once("../includes/sessionstart.php");
require_once("../includes/connection.php");
require_once('../model/cartDAO.php');
require_once('../vendor/autoload.php');

// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey("sk_test_YZzzQg82HA6EdEV0aEDmlWzS");

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];

$charge = \Stripe\Charge::create([
    'amount' => $_SESSION["totalWithShipping"] * 100,
    'currency' => 'usd',
    'description' => 'Example charge',
    'source' => $token,
    'receipt_email' => $_SESSION["CustomerEmail"],
]);
$chargedID = $charge->id;
//echo $chargedID;
UpdateChargeID($chargedID);
unset($_SESSION["cart"]);
//var_dump($charge->id);
function UpdateChargeID($chargeID) {
  try {
      $conn = connectToDB();

      $statement = "UPDATE CustomerOrder SET StripeChargeID = :StripeChargeID WHERE OrderNumber = :OrderNumber";

      $handle = $conn->prepare($statement);

      $handle->bindParam(':StripeChargeID', $chargeID);
      $handle->bindParam(':OrderNumber', $_SESSION["OrderNumber"]);
      $handle->execute();
      // TODO: check if successfull before redirect and send mail
      //send mail to confirm order with link to order.php
      header('Location: ../view/order.php?order=' . $_SESSION["OrderNumber"]);
  }
  catch(\PDOExeption $ex) {
      print($ex->getMessage());
  }
}

?>
