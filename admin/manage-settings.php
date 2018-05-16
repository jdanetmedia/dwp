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

if(isset($_POST["saveNewHours"])) {
	$BasicPageInfo->addHours($_POST);
	$tab = "hours";
}

if(isset($_POST["updateHours"])) {
	$BasicPageInfo->updateHours($_POST, $_POST["hoursID"]);
	$tab = "hours";
}

if(isset($_POST["deleteHours"])) {
	$BasicPageInfo->deleteHours($_POST["hoursID"]);
	$tab = "hours";
}

if(isset($_POST["saveNewShipping"])) {
	$BasicPageInfo->addShippingMethod($_POST);
	$tab = "shipping";
}

if(isset($_POST["updateShipping"])) {
	$BasicPageInfo->updateShippingMethod($_POST, $_POST["shippingID"]);
	$tab = "shipping";
}

if(isset($_POST["deleteShipping"])) {
	$BasicPageInfo->deleteShippingMethod($_POST["shippingID"]);
	$tab = "shipping";
}

$info = $BasicPageInfo->getBasicPageInfo();
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
						<li class="tab col s2"><a <?php if(!isset($tab)) echo "class='active'"; ?> href="#company">Company details</a></li>
						<li class="tab col s2"><a <?php if(isset($tab) && $tab == "hours") echo "class='active'"; ?> href="#hours">Hours</a></li>
						<li class="tab col s2"><a <?php if(isset($tab) && $tab == "payment") echo "class='active'"; ?> href="#payment">Payment</a></li>
						<li class="tab col s2"><a <?php if(isset($tab) && $tab == "shipping") echo "class='active'"; ?> href="#shipping">Shipping</a></li>
						<li class="tab col s2"><a <?php if(isset($tab) && $tab == "seo") echo "class='active'"; ?> href="#seo">SEO</a></li>
					</ul>
					<div id="company" class="col s12 settings-content">
						<?php include("includes/partials/company-details.php"); ?>
					</div>
					<div id="hours" class="col s12 settings-content">
						<?php include("includes/partials/hours-settings.php"); ?>
					</div>
					<div id="payment" class="col s12 settings-content">
						<?php include("includes/partials/payment-settings.php"); ?>
					</div>
					<div id="shipping" class="col s12 settings-content">
						<?php include("includes/partials/shipping-methods.php"); ?>
					</div>
					<div id="seo" class="col s12 settings-content">
						<?php include("includes/partials/seo-settings.php"); ?>
					</div>
					<input class="waves-effect waves-light btn grey darken-4" type="submit" name="submit" value="Update settings">
	      </div>
      </form>
    </div>
  </div>
</div>
<?php require_once("../admin/includes/footer.php"); ?>
