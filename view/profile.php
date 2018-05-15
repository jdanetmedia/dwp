<?php
require_once("../includes/sessionstart.php");
require_once("../includes/header.php");
//$Customerinfo = getCustomerInfo($_SESSION["CustomerEmail"]);

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
  <h1>Profile</h1>
  <div class="row">
    <form class="col s12" action="" method="post">
      <div class="row">
        <div class="input-field col s6">
          <input value="Name" id="first_name" type="text" class="validate">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input value="Name" id="last_name" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="email" type="email" class="validate">
          <label for="email">Email</label>
        </div>
				<div class="input-field col s6">
          <input id="phone" type="email" class="validate">
          <label for="phone">Phone</label>
        </div>
      </div>
			<div class="row">
        <div class="input-field col s6">
          <input id="street" type="text" class="validate">
          <label for="street">Street</label>
        </div>
				<div class="input-field col s6">
          <input id="house" type="text" class="validate">
          <label for="house">Housenumber</label>
        </div>
      </div>
			<div class="row">
        <div class="input-field col s6">
          <input id="zipcode" type="text" class="validate">
          <label for="zipcode">ZipCode</label>
        </div>
				<div class="input-field col s6">
          <input id="city" type="text" class="validate">
          <label for="city">City</label>
        </div>
      </div>
			<input class="waves-effect waves-light btn cart-btt right" type="submit" name="updateprofile" value="Update">
    </form>
		<form>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate">
          <label for="password">Old password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate">
          <label for="password">Repeat password</label>
        </div>
      </div>
			<input class="waves-effect waves-light btn cart-btt right" type="submit" name="updatepassword" value="Update">
    </form>
  </div>
</div>
<?php
require_once("../includes/footer.php");
?>
