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
          <table class="responsive-table">
            <thead>
              <tr>
                  <th>Order date</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Order amount</th>
                  <th>Details</th>
                  <th>Change order status</th>
              </tr>
            </thead>
            <?php // TODO: Ændre farve på select felter ?>
            <tbody>
              <?php
                foreach ($allorders as $order) {
                  $price = $orders->getSum($order->OrderNumber);
                  ?>
                  <tr>
                    <td><?php echo $order->OrderDate; ?></td>
                    <td><?php echo $order->FirstName; ?></td>
                    <td><?php echo $order->ShippingStreet . " " . $order->ShippingHouseNumber . ", " . $order->ZipCode . " " . $order->City; ?></td>
                    <?php foreach ($price as $totalprice) { ?>
                    <td>$<?php echo $totalprice->totalprice; ?></td>
                    <?php } ?>
                    <td>
                      <a href="manage-order.php?order=<?php echo $order->OrderNumber; ?>">View details</a>
                    </td>
                    <td>
                      <div class="input-field">
                        <select>
                          <option value="1">Awaiting</option>
                          <option value="2">In progress</option>
                          <option value="3">Sent</option>
                        </select>
                      </div>
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
