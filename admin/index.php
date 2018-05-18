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

$orders = new Order();
$latestorders = $orders->getLatestOrders();
$lowstock = $orders->CheckStock();
?>
  <div class="container">
    <div class="row">
      <div class="col s12">
        <div class="card">
          <div class="card-content">
            <span class="card-title">Welcome to your dashboard</span>
            <p>This is where you manage products, customers, orders, blogpost etc.</p>
            <p>If you are new to the system, you can take a quick tour to get an overview?</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col s12">
        <div class="card">
          <div class="card-content">
            <span class="card-title">Latest orders</span>
            <table class="responsive-table striped">
              <thead>
                <tr>
                  <th>Order #</th>
                  <th>Order date</th>
                  <th>Name</th>
                  <th>Order amount</th>
                  <th>Shipping Method</th>
                  <th>Status</th>
                  <th>Details</th>
                </tr>
              </thead>
              <?php // TODO: Ændre farve på select felter ?>
              <tbody>
                <?php
                  foreach ($latestorders as $order) {
                    $orderProductsAndPrice = $orders->getOrderDetails($order->OrderNumber);
                    if (isset($order->PromoCode)) {
                      $discount = $orders->getPromoCodeDiscount($order->PromoCode);
                    }
                    ?>
                    <tr>
                      <td><?php echo $order->OrderNumber; ?></td>
                      <td><?php echo $order->OrderDate; ?></td>
                      <td><?php echo $order->FirstName . " " . $order->LastName; ?></td>
                      <td>$<?php echo $orderProductsAndPrice["Total"] + $orderProductsAndPrice["OrderInfo"]["DeliveryPrice"]; ?></td>
                      <td><?php echo $order->Method; ?></td>
                      <td><?php echo $order->Status; ?></td>
                      <td>
                        <a href="manage-order.php?order=<?php echo $order->OrderNumber; ?>">View details</a>
                      </td>
                    </tr>
                    <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
          <div class="card-action">
            <a href="manage-orders.php">All orders</a>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <div class="card">
              <div class="card-content">
                <span class="card-title">Low stock!</span>
                <table class="responsive-table striped">
                  <thead>
                    <tr>
                        <th>Item Number</th>
                        <th>Product Name</th>
                        <th>Amount</th>
                        <th>Add stock</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($lowstock as $low) {
                    ?>
                    <tr>
                      <td><?php echo $low->ItemNumber; ?></td>
                      <td><?php echo $low->ProductName; ?></td>
                      <td><?php echo $low->StockStatus; ?></td>
                      <td>
                        <a href="edit-product.php?item=<?php echo $low->ItemNumber; ?>&select=numbers">Add stock</a>
                      </td>
                    </tr>
                    <?php
                    }
                    ?>
                  </tbody>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php require_once("../admin/includes/footer.php"); ?>
