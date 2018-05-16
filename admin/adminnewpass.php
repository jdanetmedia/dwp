<?php
require_once("includes/sessionstart.php");
require_once("includes/header.php");
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
	<?php if (!empty($message)) {echo "<p>" . $message . "</p>";}?>
	<div class="row">
    <div class="col s12 m8 push-m2">
      <div class="card medium">
        <div class="card-content">
          <span class="card-title">Create your new password</span>
					<form class="col s12" action="index.php" method="post">
            <div class="row">
							<div class="input-field col s12">
								<input id="password" type="password" name="pass" maxlength="30" value="" class="validate">
								<label for="password">New password</label>
							</div>
						</div>
            <div class="row">
							<div class="input-field col s12">
								<input id="password2" type="password" name="pass2" maxlength="30" value="" class="validate">
								<label for="password2">Repeat new password</label>
							</div>
						</div>
						<input class="waves-effect waves-light btn" type="submit" name="submitadminnewpass" value="Create">
					</form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
require_once("includes/footer.php");
?>
