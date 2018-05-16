<div class="row">
  <div class="input-field col s12">
    <input id="StripeToken" type="text" name="StripeToken" class="validate" <?php if(isset($info["StripeToken"])) echo "value='" . $info["StripeToken"] . "'"; ?>>
    <label for="StripeToken">Stripe token</label>
  </div>
</div>
