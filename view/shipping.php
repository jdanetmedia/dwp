<?php
require_once("../includes/sessionstart.php");
require_once('../includes/header.php');
  $deliveryResult = mysqli_query($connection, "SELECT * FROM `DeliveryMethod`");
	if (!logged_in()) {
?>
<script type="text/javascript">
	window.location.href = 'login.php?goto=shipping';
</script>
<?php
	//redirect_to("index.php");
	}
?>
<div class="container">
  <form class="col s12 m12" action="payment.php" method="post">
  <div class="row">
      <h5>Shipping information</h5>
      <div class="row col s12 m6">
        <div class="row col s12 m12">
          <div class="input-field col s12">
            <input id="first_name" type="text" name="street" class="validate">
            <label for="first_name">Streetname</label>
          </div>
          <div class="input-field col s6">
            <input id="last_name" type="text" name="house" class="validate">
            <label for="last_name">Housenumber</label>
          </div>
        </div>
        <div class="row col s12 m12">
          <div class="input-field col s6">
            <input id="first_name" type="number" name="zipcode" class="validate">
            <label for="first_name">Zipcode</label>
          </div>
          <div class="input-field col s6">
            <input id="last_name" type="text" name="city" class="validate">
            <label for="last_name">City</label>
          </div>
        </div>
        <p>
          <input type="checkbox" name="saveaddress" value="true" class="filled-in" id="filled-in-box" />
          <label for="filled-in-box">Set this address as your new address?</label>
        </p>
      </div>

      <div class="row col s12 m6">
        <?php
          while ($row = mysqli_fetch_array($deliveryResult)) {
        ?>
        <div class="col s12 m12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">
                <input name="shippingoption" type="radio" id="<?php echo $row["DeliveryMethodID"]; ?>">
                <label for="<?php echo $row["DeliveryMethodID"]; ?>"><?php echo $row["Method"]; ?> + $<?php echo $row["DeliveryPrice"]; ?></label>
              </span>
              <p><?php echo $row["MethodDescription"]; ?></p>
            </div>
          </div>
        </div>
        <?php
          }
        ?>
      </div>
      <div class="clear"></div>
  </div>
  <div class="row col s12 m6">
    <div class="col s12 m12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Order Message (Optional)</span>
          <p>I am a very simple card. I am good at containing small bits of information.
          I am convenient because I require little markup to use effectively.</p>
          <div class="input-field">
            <textarea id="ordermessage" name="ordermessage" class="materialize-textarea"></textarea>
            <label for="ordermessage">Message</label>
          </div>
        </div>
      </div>
    </div>
  </div>
  <input class="waves-effect waves-light btn" type="submit" name="submitshipping" value="Go to payment">
</form>
</div>
<?php require_once('../includes/footer.php'); ?>
