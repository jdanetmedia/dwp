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
$users = new Admin();
?>
<div class="container">
	<div class="card">
	  <div class="card-content">
	    <span class="card-title">Create new user</span>
			<form class="col s12" action="manage-user.php" method="post">
	      <div class="row">
	        <div class="input-field col s6">
	          <input id="first_name" name="newname" type="text" class="validate" required="" aria-required="true">
	          <label for="first_name">First Name</label>
	        </div>
	        <div class="input-field col s6">
	          <input id="last_name" name="newlname" type="text" class="validate" required="" aria-required="true">
	          <label for="last_name">Last Name</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="email" name="newmail" type="email" class="validate" required="" aria-required="true">
	          <label for="email">Email</label>
	        </div>
	      </div>
        <div class="row">
	        <div class="input-field col s6">
	          <input id="pass" name="newpass" type="password" class="validate" required="" aria-required="true">
	          <label for="pass">Password</label>
	        </div>
	        <div class="input-field col s6">
	          <input id="passrepeat" name="newrpass" type="password" class="validate" required="" aria-required="true">
	          <label for="passrepeat">Repeat password</label>
	        </div>
	      </div>
				<input class="waves-effect waves-light btn grey darken-4 black" type="submit" name="submitnewuser" value="Create">
    	</form>
	  </div>
	</div>
</div>
<?php require_once("../admin/includes/footer.php"); ?>
