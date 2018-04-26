<?php require_once("../admin/includes/header.php");
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

$orderdetails = $order->getOrder($_GET["order"]);
$ordermessage = $order->getMessage($_GET["order"]);
$orderproducts = $order->getProducts($_GET["order"]);
$price = $order->getSum($_GET["order"]);
?>
<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
                <?php
                  foreach ($orderdetails as $orderD) {
                    //$price = $order->getSum($order->OrderNumber);
                    ?><span class="card-title">Order #<?php echo $orderD->OrderNumber; ?> <p class="right">Order placed at: <?php echo $orderD->OrderDate; ?></p></span>
                      <div class="card">
                        <div class="card-content">
                          <span class="card-title">Shipping info</span>
                          <p>Name: <br><?php echo $orderD->FirstName; ?> <?php echo $orderD->LastName; ?></p><br>
                          <p>Address: <br><?php echo $orderD->ShippingStreet . " " . $orderD->ShippingHouseNumber . ", " . $orderD->ZipCode . " " . $orderD->City; ?></p><br>
                          <p>Delivery Method: <br><?php echo $orderD->Method; ?></p><br>
                          <p>Delivery Price: <br>$<?php echo $orderD->DeliveryPrice; ?></p>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-content">
                          <span class="card-title">Comment</span>
                          <p><?php echo $orderD->Comment; ?></p>
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
                foreach ($orderproducts as $products) {
                  ?>
                  <tr>
                    <td><?php echo $products->ItemNumber; ?></td>
                    <td><?php echo $products->ProductName; ?></td>
                    <td><?php echo $products->Amount; ?></td>
                    <td><?php echo $products->Price; ?></td>
                    <td><?php echo $products->Price * $products->Amount; ?></td>
                  </tr>
                  <?php
                }
              ?>
            </tbody>
          </table>
          <?php
          foreach ($price as $totalprice) { ?>
          <h4>Total: <p class="right">$<?php echo $totalprice->totalprice; ?></p></h4>
          <?php } ?>
        </div>
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
