<?php require_once("../admin/includes/header.php");
spl_autoload_register(function($class) {
  include "class/".$class.".php";
});
$order = new Order();
$orderdetails = $order->getOrder($_GET["order"]);
?>
<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Order</span>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once("../admin/includes/footer.php"); ?>
