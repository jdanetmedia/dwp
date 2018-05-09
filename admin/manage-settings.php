<?php
require_once("../includes/sessionstart.php");
require_once("../admin/includes/header.php");

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
	<div class="row">
    <div class="col s12 m12">
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
				<div id="company" class="col s12 settings-content">Test 1</div>
				<div id="payment" class="col s12 settings-content">Test 2</div>
				<div id="shipping" class="col s12 settings-content">Test 3</div>
				<div id="seo" class="col s12 settings-content">Test 4</div>
      </div>
    </div>
  </div>
</div>
<?php require_once("../admin/includes/footer.php"); ?>
