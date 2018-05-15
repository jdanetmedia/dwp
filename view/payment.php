<?php
require_once("../includes/sessionstart.php");
require_once('../includes/header.php');
require_once('../model/cartDAO.php');
$deliveryInfo = getDeliveryInfo($_SESSION["shippingoption"]);
if (!logged_in()) {
?>
<script type="text/javascript">
	window.location.href = 'login.php?goto=shipping';
</script>
<?php
	//redirect_to("index.php");
	}
?>
<div class="container">
  <div class="row">
      <h5>Payment</h5>
      <?php
      echo $_SESSION["street"];
      echo $_SESSION["house"];
      echo $_SESSION["zipcode"];
      echo $_SESSION["city"];
      echo $_SESSION["saveaddress"];
      echo $_SESSION["shippingoption"];
      echo $_SESSION["total"];
      echo $_SESSION["total"] + $deliveryInfo["DeliveryPrice"];;

      if (isset($_SESSION["DiscountAmount"])) {
				$discount = ($_SESSION["total"] / 100) * $_SESSION["DiscountAmount"];
				$newtotal =	$_SESSION["total"] - $discount;
        $_SESSION["totalWithShipping"] = $newtotal + $deliveryInfo["DeliveryPrice"];
      } else {
				$_SESSION["totalWithShipping"] = $_SESSION["total"] + $deliveryInfo["DeliveryPrice"];
			}

      if(isset($_SESSION["ordermessage"])) {
        echo $_SESSION["ordermessage"];
      }
      ?>
      <form action="../model/charge.php" method="POST">
        <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="pk_test_bSzdfxQloxhUY6IUpD0peqhc"
        data-amount="<?php echo $_SESSION["totalWithShipping"] * 100; ?>"
        data-name="Demo Site"
        data-description="Example charge"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto"
        data-currency="usd">
        </script>
      </form>
      <!-- stripe payment script -->
      <div class="clear"></div>
  </div>
</div>
<?php require_once('../includes/footer.php'); ?>
