<?php require_once("includes/header.php"); ?>
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
          <span class="card-title">Login</span>
					<form class="col s12" action="" method="post">
						<div class="row">
							<div class="input-field col s12">
								<input id="email" type="email" name="email" maxlength="100" value="" class="validate">
								<label for="first_name">Email</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="password" type="password" name="pass" maxlength="30" value="" class="validate">
								<label for="password">Password</label>
							</div>
						</div>
						<input class="waves-effect waves-light btn" type="submit" name="submitlogin" value="Login">
						<a class="waves-effect waves-light btn right" href="newuser.php">Create a new user</a>
					</form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($connection)){mysqli_close($connection);}
require_once("includes/footer.php");
?>
