<?php
require_once("../includes/sessionstart.php");
require_once("../includes/header.php");
require_once('../model/cartDAO.php');
$customerinfo = getCustomerInfo($_SESSION["CustomerEmail"]);
$city = getCityName($customerinfo[0]["ZipCode"]);

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
	<div class="card">
		<div class="card-content">
			<span class="card-title">Update personal info</span>
			<form class="col s12" action="" method="post">
	      <div class="row">
	        <div class="input-field col s6">
	          <input value="<?php echo $customerinfo[0]["FirstName"]; ?>" name="firstname" id="first_name" type="text" class="validate">
	          <label for="first_name">First Name</label>
	        </div>
	        <div class="input-field col s6">
	          <input value="<?php echo $customerinfo[0]["LastName"]; ?>" name="lastname" id="last_name" type="text" class="validate">
	          <label for="last_name">Last Name</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12 m6">
	          <input value="<?php echo $customerinfo[0]["CustomerEmail"]; ?>" name="customeremail" id="email" type="email" class="validate">
	          <label for="email">Email</label>
	        </div>
					<div class="input-field col s6">
	          <input value="<?php echo $customerinfo[0]["Phone"]; ?>" name="phone" id="phone" type="number" class="validate">
	          <label for="phone">Phone</label>
	        </div>
	      </div>
				<div class="row">
	        <div class="input-field col s6">
	          <input value="<?php echo $customerinfo[0]["Street"]; ?>" name="street" id="street" type="text" class="validate">
	          <label for="street">Street</label>
	        </div>
					<div class="input-field col s6">
	          <input value="<?php echo $customerinfo[0]["HouseNumber"]; ?>" name="housenumber" id="house" type="text" class="validate">
	          <label for="house">Housenumber</label>
	        </div>
	      </div>
				<div class="row">
	        <div class="input-field col s6">
	          <input value="<?php echo $customerinfo[0]["ZipCode"]; ?>" name="zipcode" id="zipcode" type="text" onchange="showUser(this.value)" class="validate">
	          <label for="zipcode">ZipCode</label>
	        </div>
					<div class="input-field col s6">
	          <input disabled value="<?php if(isset($city[0]["City"])) { echo $city[0]["City"];} ?>" name="city" id="city" type="text" class="validate txtHint">
	          <label for="city">City</label>
	        </div>
	      </div>
				<input class="waves-effect waves-light btn cart-btt" type="submit" name="updateprofile" value="Update">
	    </form>
		</div>
	</div>
	<div class="card">
		<div class="card-content">
			<span class="card-title">Change password</span>
			<form class="col s12" action="" method="post">
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="oldpassword" name="old" type="password" class="validate">
	          <label for="oldpassword">Old password</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="password" name="new" type="password" class="validate">
	          <label for="password">Password</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="password2" name="repeatnew" type="password" class="validate">
	          <label for="password2">Repeat password</label>
	        </div>
	      </div>
				<input class="waves-effect waves-light btn cart-btt" type="submit" name="updatepassword" value="Update">
	    </form>
		</div>
	</div>
</div>
<?php
require_once("../includes/footer.php");
?>
