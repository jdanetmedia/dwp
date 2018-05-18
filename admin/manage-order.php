<?php
require_once("../includes/sessionstart.php");
require_once("../admin/includes/header.php");
spl_autoload_register(function($class) {
  include "class/".$class.".php";
});

if (!logged_in()) {
?>
<script type="text/javascript">
	window.location.href = 'login.php';
</script>
<?php
	//redirect_to("login.php");
}

$order = new Order();

if (isset($_POST["ordermessage"])) {
    $order->mailCheck($connection, $_GET["order"]);
}

if (isset($_POST["status"])) {
  $order->updateStatus($_GET["order"], $_POST["status"]);
}

$orderdetails = $order->getOrderDetails($_GET["order"]);
$ordermessage = $order->getMessage($_GET["order"]);
$price = $order->getSum($_GET["order"]);
?>
<div class="container">
  <div class="row">
    <div class="col s12">
          <h5>Order #<?php echo $orderdetails["OrderInfo"]["OrderNumber"]; ?>Order placed at: <?php echo $orderdetails["OrderInfo"]["OrderDate"]; ?></h5>
                      <div class="card small">
                        <div class="card-content">
                          <span class="card-title">Shipping info</span>
                          <div class="col s12 m6">
                            <p>Name: <br><?php echo $orderdetails["OrderInfo"]["FirstName"]; ?> <?php echo $orderdetails["OrderInfo"]["LastName"]; ?></p><br>
                            <p>Address: <br><?php echo $orderdetails["OrderInfo"]["ShippingStreet"] . " " . $orderdetails["OrderInfo"]["ShippingHouseNumber"] . ", " . $orderdetails["OrderInfo"]["ZipCode"] . " " . $orderdetails["OrderInfo"]["City"]; ?></p><br>
                            <p>Stripe Charge ID: <br><?php echo $orderdetails["OrderInfo"]["StripeChargeID"]; ?></p><br>
                          </div>
                          <div class="col s12 m6">
                            <p>Delivery Method: <br><?php echo $orderdetails["OrderInfo"]["Method"]; ?></p><br>
                            <p>Delivery Price: <br>$<?php echo $orderdetails["OrderInfo"]["DeliveryPrice"]; ?></p>
                            <?php if (isset($orderdetails["OrderInfo"]["PromoCode"])) {
                              $discount = $order->getPromoCodeDiscount($orderdetails["OrderInfo"]["PromoCode"]);
                            ?>
                            <br><p>Promocode: <br><?php echo $orderdetails["OrderInfo"]["PromoCode"]; ?></p>
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-content">
                          <span class="card-title">Comment</span>
                          <p><?php echo $orderdetails["OrderInfo"]["Comment"]; ?></p>
                        </div>
                      </div>
                </div>
                      <h5 class="left">Status</h5>
                      <form action="manage-order.php?order=<?php echo $_GET["order"]; ?>" method="post">
                        <input class="waves-effect waves-light btn grey darken-4 right new-prod-btn right" type="submit" name="statussubmit" value="Save">
                        <div class="input-field col s12 m3 right">
                          <select name="status">
                            <?php
                              $allstatus = $order->getStatus();
                              foreach ($allstatus as $status) {
                                if($orderD->OrderStatusID == $status->OrderStatusID) {
                                  ?>
                                  <option value="<?php echo $status->OrderStatusID; ?>" selected><?php echo $status->Status; ?></option>
                                  <?php
                                } else {
                                  ?>
                                  <option value="<?php echo $status->OrderStatusID; ?>"><?php echo $status->Status; ?></option>
                                  <?php
                                }
                              }
                            ?>
                          </select>
                        </div>
                      </form>
                    <?php
                  }
                ?>
                    <table class="responsive-table striped">
                      <thead>
                        <tr>
                            <th>ItemNumber</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Price per product</th>
                            <th>Combined price</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          foreach ($orderdetails["Products"] as $products) {
                            ?>
                            <tr>
                              <td><?php echo $products["ItemNumber"]; ?></td>
                              <td><?php echo $products["ProductName"]; ?></td>
                              <td><?php echo $products["Amount"]; ?></td>
                              <td><?php echo $products["FinalPrice"]; ?></td>
                              <td><?php echo $products["FinalPrice"] * $products["Amount"]; ?></td>
                            </tr>
                            <?php
                          }
                        ?>
                      </tbody>
                    </table>
          <?php if(isset($orderdetails["BeforeDiscount"])) {
          ?>
          <h4>Before discount: <strike>$<?php echo $orderdetails["BeforeDiscount"] + $orderdetails["OrderInfo"]["DeliveryPrice"]; ?></strike></h4>
          <?php
          } ?>
          <h4>Total: $<?php echo $orderdetails["Total"] + $orderdetails["OrderInfo"]["DeliveryPrice"]; ?></h4>
        </div>
      <h5>Messages</h5>
      <?php
      foreach ($ordermessage as $message) {
      ?>
      <div class="card">
        <div class="card-content">
          <span class="card-title"><?php echo $message->OrderMessageDate; ?></span>
          <p><?php echo $message->OrderMessage; ?></p>
        </div>
      </div>
      <?php
      }
      ?>
      <div class="card small">
        <div class="card-content">
          <span class="card-title">Write a message</span>
          <form class="col s12" name="contact" method="post" action="">
            <div class="input-field col s12">
              <textarea id="textarea" class="materialize-textarea" name="ordermessage"></textarea>
              <label for="textarea">Message</label>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="SendOrderMessage">Send</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once("../admin/includes/footer.php"); ?>
