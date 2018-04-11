<?php
// TODO: create session variable with array, that contains the cart items
$_SESSION["cart"] = array();
if (isset($_POST['submitcart'])) {
  if (!isset($_COOKIE["cart"])) {
    // Set array
    $amount = $_POST["amount"];
    $item = $_GET["item"];
    $_SESSION["cart"] = array("2222"=>"5");
} else {
  // push new item to array
}
}

?>
