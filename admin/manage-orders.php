<?php require_once("../admin/includes/header.php");
spl_autoload_register(function($class) {
  include "class/".$class.".php";
});
$orders = new Order();
$allorders = $allorders->getAllOrders();
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
                while ($row = mysqli_fetch_array($orders)) {
                  ?>
                  <tr>
                    <td>March 6th 2018 @ 11.30.24</td>
                    <td>Donald Duck</td>
                    <td>Duckroad 1, Ducktown</td>
                    <td>$99.00</td>
                    <td>
                      <a href="#">View details</a>
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
