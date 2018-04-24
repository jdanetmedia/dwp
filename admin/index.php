<?php require_once("../admin/includes/header.php");
spl_autoload_register(function($class) {
  include "class/".$class.".php";
});
$orders = new Order();
$latestorders = $orders->getLatestOrders();
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
          <div class="card-action">
            <a href="#">Take tour</a>
            <a href="#">Dismiss for now</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col s12">
        <div class="card">
          <div class="card-content">
            <span class="card-title">Latest orders</span>
            <table class="responsive-table">
              <thead>
                <tr>
                    <th>Order #</th>
                    <th>Order date</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Details</th>
                    <th>Change order status</th>
                </tr>
              </thead>
              <?php // TODO: Ændre farve på select felter ?>
              <tbody>
                <?php
                  foreach ($latestorders as $order) {
                    ?>
                    <tr>
                      <td>#<?php echo $order->OrderNumber; ?></td>
                      <td><?php echo $order->OrderDate; ?></td>
                      <td><?php echo $order->FirstName; ?></td>
                      <td><?php echo $order->ShippingStreet . " " . $order->ShippingHouseNumber . ", " . $order->ZipCode . " " . $order->City; ?></td>
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
          <div class="card-action">
            <a href="manage-orders.php">All orders</a>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <div class="card">
              <div class="card-content">
                <span class="card-title">Low stock!</span>
                <table class="responsive-table">
                  <thead>
                    <tr>
                        <th>Item Number</th>
                        <th>Product Name</th>
                        <th>Amount</th>
                        <th>Add stock to the system</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1111</td>
                      <td>Green Duck</td>
                      <td>Some low number</td>
                      <td>
                        <a href="edit-product.php?item=1111">Add stock</a>
                      </td>
                    </tr>
                  </tbody>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php require_once("../admin/includes/footer.php"); ?>
