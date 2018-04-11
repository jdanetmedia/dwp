<?php require_once('../includes/header.php'); ?>
<div class="container">
  <div class="row">
    <form class="col s12 m12" action="">
      <h5>Payment</h5>
      <div class="row col s12 m6">
        <div class="row col s12 m12">
          <div class="input-field col s12">
            <input id="cardnumber" type="text" class="validate">
            <label for="cardnumber">Card Number</label>
          </div>
          <div class="input-field col s6">
            <input id="month" type="number" class="validate">
            <label for="month">Month</label>
          </div>
          <div class="input-field col s6">
            <input id="year" type="number" class="validate">
            <label for="year">Year</label>
          </div>
        </div>
        <div class="row col s12 m12">
          <div class="input-field col s6">
            <input id="cvc" type="number" class="validate">
            <label for="cvc">CCV / CVC</label>
          </div>
        </div>
      </div>
      <div class="row col s12 m6">
        <div class="col s12 m12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Order Message (Optional)</span>
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
              <div class="input-field">
                <textarea id="ordermessage" class="materialize-textarea"></textarea>
                <label for="ordermessage">Message</label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clear"></div>
      <input class="waves-effect waves-light btn" type="submit" name="create" value="Pay!">
    </form>
  </div>
</div>
<?php require_once('../includes/footer.php'); ?>
