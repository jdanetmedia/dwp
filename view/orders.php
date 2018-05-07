<?php
require_once("../includes/sessionstart.php");
require_once("../includes/header.php");
require_once("../model/ordersDAO.php");
$orders = getAllOrders($_SESSION["CustomerEmail"]);

if (!logged_in()) {
?>
<script type="text/javascript">
	window.location.href = 'login.php';
</script>
<?php
	//redirect_to("login.php");
}
?>
<div class="container">
  <h1>Orders</h1>
  <?php
  while ($row = mysqli_fetch_array($orders)) {
  ?>
      <div class="row">
        <div class="col s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Ordernumber: #<?php echo $row["OrderNumber"]; ?></span>
              <p>Date: <?php echo $row["OrderDate"]; ?></p>
            </div>
            <div class="card-action">
              <a href="order.php?order=<?php echo $row["OrderNumber"]; ?>">View order</a>
            </div>
          </div>
        </div>
      </div>
  <?php
  }
  ?>
</div>
<?php
require_once("../includes/footer.php");
?>
