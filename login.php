<?php require_once('includes/header.php');
// check if customer is logged in, if logged in, redirect to checkout page
?>
<div class="container">
  <div class="row">
    <form class="col s12 m6" action="shipping.php">
      <h5>Create Customer</h5>
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
          <label for="first_name">Email</label>
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
          <input id="password2" type="password" class="validate">
          <label for="password">Repeat password</label>
        </div>
      </div>
      <input class="waves-effect waves-light btn" type="submit" name="create" value="Create">
    </form>

    <form class="col s12 m6" action="shipping.php">
      <h5>Already a customer?</h5>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate">
          <label for="first_name">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      <input class="waves-effect waves-light btn" type="submit" name="login" value="Login">
    </form>
  </div>
</div>
<?php require_once('includes/footer.php'); ?>
