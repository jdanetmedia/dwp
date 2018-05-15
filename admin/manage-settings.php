<?php
require_once("../includes/sessionstart.php");
require_once("includes/redirect.php");
require_once("../admin/includes/header.php");


if (!logged_in()) {
?>
<script type="text/javascript">
	window.location.href = 'login.php';
</script>
<?php
	//redirect_to("login.php");
}

$BasicPageInfo = new Settings();

if(isset($_POST["submit"])) {
	$BasicPageInfo->saveBasicPageInfo($_POST);
}

if(isset($_POST["saveNewShipping"])) {
	$BasicPageInfo->addShippingMethod($_POST);
}

if(isset($_POST["updateShipping"])) {
	$BasicPageInfo->updateShippingMethod($_POST, $_POST["shippingID"]);
}

if(isset($_POST["deleteShipping"])) {
	$BasicPageInfo->deleteShippingMethod($_POST["shippingID"]);
}

$infoArray = $BasicPageInfo->getBasicPageInfo();
$info = $infoArray[0];
?>

<div class="container">
	<div class="row">
    <div class="col s12 m12">
      <form method="post">
				<div class="card">
	        <div class="card-content">
	          <span class="card-title">Manage settings</span>
	        </div>
					<ul class="tabs">
						<li class="tab col s3"><a class="active" href="#company">Company details</a></li>
						<li class="tab col s3"><a href="#payment">Payment</a></li>
						<li class="tab col s3"><a href="#shipping">Shipping</a></li>
						<li class="tab col s3"><a href="#seo">SEO</a></li>
					</ul>
					<div id="company" class="col s12 settings-content">
						<?php include("includes/partials/company-details.php"); ?>
					</div>
					<div id="payment" class="col s12 settings-content">Test 2</div>
					<div id="shipping" class="col s12 settings-content">
						<?php include("includes/partials/shipping-methods.php"); ?>
					</div>
					<div id="seo" class="col s12 settings-content">Test 4</div>
					<input class="waves-effect waves-light btn grey darken-4" type="submit" name="submit" value="Update settings">
	      </div>
      </form>
    </div>
  </div>
</div>
<?php require_once("../admin/includes/footer.php"); ?>
