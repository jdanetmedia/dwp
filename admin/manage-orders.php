<?php require_once("../admin/includes/header.php");
spl_autoload_register(function($class) {
  include "class/".$class.".php";
});
$orders = new Order();
$allorders = $orders->getAllOrders();
?>
<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">All orders</span>
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
                foreach ($allorders as $order) {
                  $price = $orders->getSum($order->OrderNumber);
                  ?>
                  <tr>
                    <td><?php echo $order->OrderNumber; ?></td>
                    <td><?php echo $order->OrderDate; ?></td>
                    <td><?php echo $order->FirstName . " " . $order->LastName; ?></td>
                    <?php foreach ($price as $totalprice) { ?>
                    <td>$<?php echo $totalprice->totalprice; ?></td>
                    <?php } ?>
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
      </div>
    </div>
  </div>
</div>
<?php require_once("../admin/includes/footer.php"); ?>
