<?php
require_once("../includes/header.php");
require_once("../model/ordersDAO.php");
$orderNumber = $_GET["order"];
$orderinfo = getOrder($orderNumber);
$orderProducts = getOrderProducts($orderNumber);

if (!logged_in()) {
?>
<script type="text/javascript">
	window.location.href = 'login.php';
</script>
<?php
	//redirect_to("login.php");
}
if ($orderinfo["CustomerEmail"] != $_SESSION["CustomerEmail"]) {
  ?>
  <div class="container">
    <h2>This isn't your order!</h2>
  </div>
  <?php
} else {
	$totalPrice = 0;
	$totalPrice = $totalPrice + $orderinfo["DeliveryPrice"];
?>
<div class="container">
  <div class="row">
    <h2>Order info</h2>
    <div class="card col s12 m6">
      <div class="card-content">
        <span class="card-title">Ordernumber #<?php echo $orderinfo["OrderNumber"]; ?></span>
        <p>Order comment: </p>
        <p><?php echo $orderinfo["Comment"]; ?></p>
        <br>
        <p>Date: <?php echo $orderinfo["OrderDate"]; ?></p>
        <br>
        <p>Status: <?php echo $orderinfo["Status"]; ?></p>
      </div>
    </div>
    <div class="card col s12 m6">
      <div class="card-content">
        <span class="card-title">Shipping Info</span>
        <p><?php echo $orderinfo["ShippingStreet"] . " " .$orderinfo["ShippingHouseNumber"]; ?></p>
        <p><?php echo $orderinfo["ZipCode"] . " " . $orderinfo["City"]; ?></p>
        <br>
        <p><b>Delivery Method:</b></p>
        <p><?php echo $orderinfo["Method"]; ?></p>
        <p>Delivery cost: $<?php echo $orderinfo["DeliveryPrice"]; ?></p>
      </div>
    </div>
  </div>
  <div class="row">
    <h2>Products</h2>
    <?php
    while ($row = mysqli_fetch_array($orderProducts)) {
    ?>
    <div class="card col s12">
      <div class="card-content">
        <span class="card-title">Productname: <?php echo $row["ProductName"]; ?></span>
        <p>Itemnumber: <?php echo $row["ItemNumber"]; ?></p>
        <p>Amount: <?php echo $row["Amount"]; ?></p>
        <p>Single Price: $<?php echo $row["Price"]; ?></p>
        <p>Price: $<?php echo $row["Price"] * $row["Amount"]; ?></p>
      </div>
      <div class="card-action">
        <a href="product.php?item=<?php echo $row["ItemNumber"]; ?>">View product</a>
      </div>
    </div>
    <?php
		$totalPrice = $totalPrice + $row["Price"] * $row["Amount"];
    }
    ?>
		<div class="card col s12">
      <div class="card-content">
        <span class="card-title left">Total price:</span><span class="card-title right">$<?php echo $totalPrice; ?></span>
			</div>
		</div>
  </div>
</div>
<?php
}
require_once("../includes/footer.php");
?>