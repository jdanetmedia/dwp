<?php
require_once("../includes/sessionstart.php");
require_once("../includes/header.php");
require_once("../model/ordersDAO.php");
require_once("../model/cartDAO.php");
$orderNumber = $_GET["order"];
$orderProductsAndPrice = getOrder($orderNumber);
if (!logged_in()) {
?>
<script type="text/javascript">
	window.location.href = 'login.php';
</script>
<?php
	//redirect_to("login.php");
}
if ($orderProductsAndPrice["OrderInfo"]["CustomerEmail"] != $_SESSION["CustomerEmail"]) {
  ?>
  <div class="container">
    <h2>This isn't your order!</h2>
  </div>
  <?php
} else {
	$totalPrice = 0;
?>
<div class="container">
  <div class="row">
    <h2>Order info</h2>
    <div class="card col s12 m6">
      <div class="card-content">
        <span class="card-title">Ordernumber #<?php echo $orderProductsAndPrice["OrderInfo"]["OrderNumber"]; ?></span>
        <p>Order comment: </p>
        <p><?php echo $orderProductsAndPrice["OrderInfo"]["Comment"]; ?></p>
        <br>
        <p>Date: <?php echo $orderProductsAndPrice["OrderInfo"]["OrderDate"]; ?></p>
        <br>
        <p>Status: <?php echo $orderProductsAndPrice["OrderInfo"]["Status"]; ?></p>
      </div>
    </div>
    <div class="card col s12 m6">
      <div class="card-content">
        <span class="card-title">Shipping Info</span>
        <p><?php echo $orderProductsAndPrice["OrderInfo"]["ShippingStreet"] . " " . $orderProductsAndPrice["OrderInfo"]["ShippingHouseNumber"]; ?></p>
        <p><?php echo $orderProductsAndPrice["OrderInfo"]["ZipCode"] . " " . $orderProductsAndPrice["OrderInfo"]["City"]; ?></p>
        <br>
        <p><b>Delivery Method:</b></p>
        <p><?php echo $orderProductsAndPrice["OrderInfo"]["Method"]; ?></p>
        <p>Delivery cost: $<?php echo $orderProductsAndPrice["OrderInfo"]["DeliveryPrice"]; ?></p>
      </div>
    </div>
  </div>
	<?php
		if (isset($orderProductsAndPrice["OrderInfo"]["PromoCode"])) {
			$promocodeInfo = checkForPromoCode($orderProductsAndPrice["OrderInfo"]["PromoCode"]);
	?>
	<div class="card col s12">
		<div class="card-content">
			<span class="card-title">Promocode</span>
			<p>Promocode used: <?php echo $promocodeInfo[0]["PromoCode"]; ?></p>
			<p>Discount given: <?php echo $promocodeInfo[0]["DiscountAmount"]; ?>%</p>
		</div>
	</div>
	<?php
		}
	?>
  <div class="row">
    <h2>Products</h2>
    <?php
		foreach($orderProductsAndPrice["Products"] as $products) {
		?>
		<div class="card col s12">
			<div class="card-content">
				<span class="card-title">Productname: <?php echo $products["ProductName"]; ?></span>
				<p>Itemnumber: <?php echo $products["ItemNumber"]; ?></p>
				<p>Amount: <?php echo $products["Amount"]; ?></p>
				<p>Single Price: $<?php echo $products["FinalPrice"]; ?></p>
				<p>Price: $<?php echo $products["FinalPrice"] * $products["Amount"]; ?></p>
			</div>
			<div class="card-action">
				<a href="product.php?item=<?php echo $products["ItemNumber"]; ?>">View product</a>
			</div>
		</div>
		<?php
		}
    ?>
		<div class="card col s12">
      <div class="card-content">
				<?php
					if ($orderProductsAndPrice["BeforeDiscount"] != NULL) {
				?>
				<div class="row">
					<span class="card-title left">Before Discount:</span><span class="card-title right"><strike>$<?php echo $orderProductsAndPrice["BeforeDiscount"]; ?></strike></span>
				</div>
				<div class="row">
					<span class="card-title left">Total price:</span><span class="card-title right">$<?php echo $orderProductsAndPrice["Total"]; ?></span>
				</div>
				<div class="row">
					<span class="card-title left">With shipping:</span><span class="card-title right">$<?php echo $orderProductsAndPrice["Total"] + $orderProductsAndPrice["OrderInfo"]["DeliveryPrice"]; ?></span>
				</div>
				<?php
				} else {
				?>
					<div class="row">
						<span class="card-title left">Total price:</span><span class="card-title right">$<?php echo $orderProductsAndPrice["Total"]; ?></span>
					</div>
					<div class="row">
						<span class="card-title left">With shipping:</span><span class="card-title right">$<?php echo $orderProductsAndPrice["Total"] + $orderProductsAndPrice["OrderInfo"]["DeliveryPrice"]; ?></span>
					</div>
				<?php
				}
				?>
			</div>
		</div>
  </div>
</div>
<?php
}
require_once("../includes/footer.php");
?>
