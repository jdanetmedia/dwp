<?php require_once("../admin/includes/header.php");
spl_autoload_register(function($class) {
  include "class/".$class.".php";
});
$order = new Order();
$orderdetails = $order->getOrder($_GET["order"]);
$orderproducts = $order->getProducts($_GET["order"]);
$price = $order->getSum($_GET["order"]);
?>
<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
                <?php
                  foreach ($orderdetails as $order) {
                    //$price = $order->getSum($order->OrderNumber);
                    ?><span class="card-title">Order #<?php echo $order->OrderNumber; ?> <p class="right">Order placed at: <?php echo $order->OrderDate; ?></p></span>
                      <div class="card">
                        <div class="card-content">
                          <span class="card-title">Shipping info</span>
                          <p>Name: <br><?php echo $order->FirstName; ?> <?php echo $order->LastName; ?></p><br>
                          <p>Address: <br><?php echo $order->ShippingStreet . " " . $order->ShippingHouseNumber . ", " . $order->ZipCode . " " . $order->City; ?></p><br>
                          <p>Delivery Method: <br><?php echo $order->Method; ?></p><br>
                          <p>Delivery Price: <br>$<?php echo $order->DeliveryPrice; ?></p>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-content">
                          <span class="card-title">Comment</span>
                          <p><?php echo $order->Comment; ?></p>
                        </div>
                      </div>
                      <p><?php echo $order->OrderStatusID; ?></p>
                      <h5 class="left">Status</h5>
                      <div class="input-field col s12 m3 right">
                        <select>
                          <option value="1">Awaiting</option>
                          <option value="2">In progress</option>
                          <option value="3">Sent</option>
                        </select>
                      </div>
                    <?php
                  }
                ?>
          <table class="responsive-table">
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
          <h4 >Total: <p class="right">$<?php echo $totalprice->totalprice; ?></p></h4>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once("../admin/includes/footer.php"); ?>