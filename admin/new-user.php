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
$users = new Admin($connection);
?>
<div class="container">
	<div class="card">
	  <div class="card-content">
	    <span class="card-title">Create new user</span>
			<form class="col s12" action="manage-user.php?newuser=create" method="post">
	      <div class="row">
	        <div class="input-field col s6">
	          <input id="first_name" type="text" class="validate">
	          <label for="first_name">First Name</label>
	        </div>
	        <div class="input-field col s6">
	          <input id="last_name" type="text" class="validate">
	          <label for="last_name">Last Name</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="email" type="email" class="validate">
	          <label for="email">Email</label>
	        </div>
	      </div>
        <div class="row">
	        <div class="input-field col s6">
	          <input id="pass" type="password" class="validate">
	          <label for="pass">Password</label>
	        </div>
	        <div class="input-field col s6">
	          <input id="passrepeat" type="password" class="validate">
	          <label for="passrepeat">Repeat password</label>
	        </div>
	      </div>
				<input class="waves-effect waves-light btn grey darken-4 black" type="submit" name="submit" value="Create">
    	</form>
	  </div>
	</div>
</div>
<?php require_once("../admin/includes/footer.php"); ?>
