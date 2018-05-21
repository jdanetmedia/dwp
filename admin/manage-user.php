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
$userinfo = $users->GetUserInfo($_SESSION["UserEmail"]);
?>
<div class="container">
	<h1>Manage user</h1>
	<?php
	if ($_SESSION["AccessLevel"] == 1) {
		require_once("../admin/includes/partials/edit-superadmin.php");
	}
	?>
	<div class="card">
	  <div class="card-content">
	    <span class="card-title">Edit your info</span>
			<form class="col s12" action="manage-user.php?update=<?php echo $_SESSION["UserEmail"]; ?>" method="post">
	      <div class="row">
	        <div class="input-field col s6">
	          <input id="first_name" type="text" name="firstname" class="validate" value="<?php echo $userinfo[0]["FirstName"]; ?>">
	          <label for="first_name">First Name</label>
	        </div>
	        <div class="input-field col s6">
	          <input id="last_name" type="text" name="lastname" class="validate" value="<?php echo $userinfo[0]["LastName"]; ?>">
	          <label for="last_name">Last Name</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="email" type="email" name="email" class="validate" value="<?php echo $userinfo[0]["UserEmail"]; ?>">
	          <label for="email">Email</label>
	        </div>
	      </div>
				<input class="waves-effect waves-light btn grey darken-4 black" type="submit" name="submitupdateinfo" value="Save">
    	</form>
	  </div>
	</div>
	<div class="card">
	  <div class="card-content">
	    <span class="card-title">Change your password</span>
			<form class="col s12" action="" method="post">
				<div class="row">
	        <div class="input-field col s12">
	          <input id="passold" name="oldpass" type="password" class="validate">
	          <label for="passold">Old Password</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s6">
	          <input id="pass" name="newpass" type="password" class="validate">
	          <label for="pass">New password</label>
	        </div>
	        <div class="input-field col s6">
	          <input id="passrepeat" name="repeatnewpass" type="password" class="validate">
	          <label for="passrepeat">Repeat new password</label>
	        </div>
	      </div>
				<input class="waves-effect waves-light btn grey darken-4 black" type="submit" name="submitupdatepass" value="Save">
    	</form>
	  </div>
	</div>
</div>
<?php require_once("../admin/includes/footer.php"); ?>
