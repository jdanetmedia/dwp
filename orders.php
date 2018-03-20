<?php
require_once("includes/header.php");
require_once("includes/ordersDAO.php");
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
              <span class="card-title"><?php echo $row["OrderNumber"]; ?> Ordernumber</span>
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="#">This is a link</a>
              <a href="#">This is a link</a>
            </div>
          </div>
        </div>
      </div>
  <?php
  }
  ?>
</div>
<?php
require_once("includes/footer.php");
?>
