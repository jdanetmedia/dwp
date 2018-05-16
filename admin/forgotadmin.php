<?php
require_once("../includes/sessionstart.php");
require_once("includes/header.php"); ?>
<?php
	if (logged_in()) {
?>
<script type="text/javascript">
	window.location.href = 'index.php';
</script>
<?php
	//redirect_to("index.php");
	}
?>
<div class="container">
	<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
	<div class="row">
    <div class="col s12 m8 push-m2">
      <div class="card medium">
        <div class="card-content">
          <span class="card-title">Forgot password</span>
					<form class="col s12" action="index.php" method="post">
						<div class="row">
							<div class="input-field col s12">
								<input id="email" type="email" name="forgotemail" maxlength="100" value="" class="validate">
								<label for="first_name">Email</label>
							</div>
						</div>
						<input class="waves-effect waves-light btn black" type="submit" name="submitadminforgot" value="Send">
					</form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
require_once("includes/footer.php");
?>
